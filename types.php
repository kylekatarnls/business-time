<?php

include __DIR__.'/vendor/autoload.php';
include __DIR__.'/vendor/cmixin/business-day/src/Types/Generator.php';

final class TypeGenerator extends \Types\Generator
{
    private $skipped = [
        'normalizeDay'        => true,
        'convertOpeningHours' => true,
        'enable'              => true,
    ];

    /**
     * @param class-string $defaultClass
     * @param string       $source
     * @param Closure      $boot
     *
     * @throws ReflectionException
     *
     * @return string
     */
    public function getScheduleDoc($defaultClass, $source, $boot)
    {
        $methods = '';
        $source = str_replace('\\', '/', realpath($source));
        $sourceLength = strlen($source);

        foreach ($this->getMethods($boot) as $name => $closure) {
            if (!$closure || isset($this->skipped[$name])) {
                continue;
            }

            try {
                $function = new ReflectionFunction($closure);
            } catch (ReflectionException $e) {
                continue;
            }

            $file = $function->getFileName();

            if (!isset($files[$file])) {
                $files[$file] = file($file);
            }

            $lines = $files[$file];
            $file = str_replace('\\', '/', $file);

            if (substr($file, 0, $sourceLength + 1) !== "$source/") {
                continue;
            }

            $file = substr($file, $sourceLength + 1);
            $parameters = implode(', ', array_map([$this, 'dumpParameter'], $function->getParameters()));
            $methodDocBlock = trim($function->getDocComment() ?: '');
            $methodDocBlock = str_replace("\r", '', $methodDocBlock);
            $length = $function->getStartLine() - 1;
            $code = array_slice($lines, 0, $length);
            $className = '\\'.str_replace('/', '\\', substr($file, 0, -4));
            $return = 'mixed';

            for ($i = $length - 1; $i >= 0; $i--) {
                if (preg_match('/^\s*(public|protected)\s+function\s+(\S+)\(.*\)(\s*\{)?$/', $code[$i], $match)) {
                    if ($name !== $match[2]) {
                        try {
                            $method = new ReflectionMethod($className, $name);
                        } catch (ReflectionException $e) {
                            $method = new ReflectionMethod($defaultClass, $name);
                        }

                        $methodFile = $method->getFileName();

                        if (!isset($files[$methodFile])) {
                            $files[$methodFile] = file($methodFile);
                        }

                        $length = $method->getEndLine() - 1;
                        $lines = $files[$methodFile];

                        if ($length > 3 && preg_match('/^\s*\*+\/\s*$/', $lines[$length - 2])) {
                            $doc = '';

                            for ($i = $length - 2; $i >= max(0, $length - 42); $i--) {
                                $doc = $lines[$i].$doc;

                                if (preg_match('/\s*\/\*{2,}\s*/', $lines[$i])) {
                                    $methodDocBlock = trim($doc);

                                    break;
                                }
                            }
                        }

                        $code = array_slice($lines, 0, $length);

                        for ($i = $length - 1; $i >= 0; $i--) {
                            if (preg_match('/^\s*(public|protected)\s+function\s+(\S+)\(.*\)(\s*\{)?$/', $code[$i], $match)) {
                                break;
                            }
                        }

                        $code = implode('', array_slice($code, $i));

                        if (preg_match('/(\/\*\*[\s\S]+\*\/)\s+return\s/U', $code, $match)) {
                            $methodDocBlock = $match[1];
                        }
                    }

                    break;
                }
            }

            $methodDocBlock = preg_replace('/\/\*\*\s+(\S[\s\S]*\S)\s+\*\//', '$1', $methodDocBlock);
            $methodDocBlock = preg_replace('/^\s*\*$/m', '', $methodDocBlock);
            $methodDocBlock = preg_replace('/^\s*\*\s([^\n]*)$/m', '$1', $methodDocBlock);

            if (preg_match('/^@return\s+(\S+)(?:\s.*)?$/m', $methodDocBlock, $match)) {
                $return = $match[1];
            }

            $methodDocBlock = trim(preg_replace('/^(@|\s{6}).*$/m', '', $methodDocBlock));

            if (!empty($parameters)) {
                $parameters = ', '.$parameters;
            }

            $start = " * @method $return $name(CarbonInterface \$date$parameters) ";
            $methodDocBlock = strtr($methodDocBlock, ["\n" => "\n *".str_repeat(' ', strlen($start) - 2)]);
            $methods .= "$start$methodDocBlock\n";
        }

        return $methods;
    }
}

$generator = new TypeGenerator();
$boot = static function () {
    \Cmixin\BusinessTime::enable(\Carbon\Carbon::class);
};
$generator->writeHelpers(\Cmixin\BusinessTime::class, __DIR__.'/src', __DIR__.'/types', '_ide_business_time', $boot);
$scheduleFile = __DIR__.'/src/BusinessTime/Schedule.php';
$contents = file_get_contents($scheduleFile);
$contents = preg_replace('/(<autodoc>)([\s\S]*)(<\/autodoc>)/', "<autodoc>\n{{AUTODOC-CONTENT}}\n *</autodoc>", $contents);
$contents = strtr($contents, [
    '{{AUTODOC-CONTENT}}' => $generator->getScheduleDoc(\Cmixin\BusinessTime::class, __DIR__.'/src', $boot),
]);
file_put_contents($scheduleFile, $contents);
