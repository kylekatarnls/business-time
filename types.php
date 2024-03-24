<?php

use Carbon\Carbon;
use Cmixin\BusinessTime;

include __DIR__.'/vendor/autoload.php';
include __DIR__.'/vendor/cmixin/business-day/src/Types/Generator.php';

final class TypeGenerator extends \Types\Generator
{
    private $skipped = [
        'normalizeDay'             => true,
        'convertOpeningHours'      => true,
        'enable'                   => true,
        'initializeHolidaysRegion' => true,
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
        $methods = [];
        $source = str_replace('\\', '/', realpath($source));
        $sourceLength = strlen($source);
        $businessDaySource = str_replace('\\', '/', realpath(dirname($source).'/vendor/cmixin/business-day/src'));
        $businessDaySourceLength = strlen($businessDaySource);

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

            if (substr($file, 0, $sourceLength + 1) !== "$source/" &&
                substr($file, 0, $businessDaySourceLength + 1) !== "$businessDaySource/"
            ) {
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

            $methodDocBlock = $this->parseMethodDoc($name, $length, $className, $defaultClass, $code, $files)
                ?: $methodDocBlock;

            $methodDocBlock = preg_replace('/\/\*\*\s+(\S[\s\S]*\S)\s+\*\//', '$1', $methodDocBlock);
            $methodDocBlock = preg_replace('/^\s*\*$/m', '', $methodDocBlock);
            $methodDocBlock = preg_replace('/^\s*\*\s([^\n]*)$/m', '$1', $methodDocBlock);

            if (preg_match('/^@return\s+(\S+)(?:\s.*)?$/m', $methodDocBlock, $match)) {
                $return = $match[1];
            }

            $methodDocBlock = trim(preg_replace('/^(@|\s{6}).*$/m', '', $methodDocBlock));
            $first = in_array($name, ['isOpenOn', 'isClosedOn']) ? '' : 'CarbonInterface $date';

            if ($first !== '' && !empty($parameters)) {
                $first .= ', ';
            }

            $start = "$name($first$parameters) ";
            $methods[] = [$return, $start, rtrim($methodDocBlock, " \n\r\t\v\0*")];
        }

        $maxReturn = max(array_map(static function ($data) {
            return mb_strlen($data[0]);
        }, $methods));
        $maxStart = max(array_map(static function ($data) {
            return mb_strlen($data[1]);
        }, $methods));
        $newLine = "\n *".str_repeat(' ', $maxStart + $maxReturn + 10);

        $docChunk = implode('', array_map(static function ($data) use ($maxReturn, $maxStart, $newLine) {
            [$return, $start, $methodDocBlock] = $data;

            return "\n * @method ".str_pad($return, $maxReturn + 1).str_pad($start, $maxStart).
                strtr($methodDocBlock, [
                    '('  => '（',
                    ')'  => '）',
                    "\n" => $newLine,
                ]);
        }, $methods));

        return preg_replace('/^(\s*\*)\s+\n/m', '', $docChunk);
    }

    private function parseMethodDoc(
        string $name,
        int $length,
        string $className,
        string $defaultClass,
        array $code,
        array &$files
    ): ?string {
        $methodDocBlock = null;

        for ($i = $length - 1; $i >= 0; $i--) {
            if (preg_match('/^(public|protected)\s+function\s+(\S+)\(.*\)(\s*\{)?$/', trim($code[$i]), $match)) {
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
                                $methodDocBlock = trim($doc) ?: $methodDocBlock;

                                break;
                            }
                        }
                    }

                    $code = array_slice($lines, 0, $length);

                    for ($i = $length - 1; $i >= 0; $i--) {
                        if (preg_match('/^(public|protected)\s+function\s+(\S+)\(.*\)(\s*\{)?$/', trim($code[$i]), $match)) {
                            break;
                        }
                    }

                    $code = implode('', array_slice($code, $i));

                    if (preg_match('/(\/\*\*[\s\S]+\*\/)\s+return\s/U', $code, $match)) {
                        $methodDocBlock = trim($match[1]) ?: $methodDocBlock;
                    }
                }

                break;
            }
        }

        return $methodDocBlock;
    }
}

$generator = new TypeGenerator();
$boot = static function () {
    BusinessTime::enable(Carbon::class);
};
$generator->writeHelpers(BusinessTime::class, __DIR__.'/src', __DIR__.'/types', '_ide_business_time', $boot);
$scheduleFile = __DIR__.'/src/BusinessTime/Schedule.php';
$contents = file_get_contents($scheduleFile);
$contents = preg_replace('/(<autodoc([^>]*>))([\s\S]*)(<\/autodoc>)/', "$1\n *{{AUTODOC-CONTENT}}\n *</autodoc>", $contents);
$contents = strtr($contents, [
    '{{AUTODOC-CONTENT}}' => $generator->getScheduleDoc(BusinessTime::class, __DIR__.'/src', $boot),
]);
file_put_contents($scheduleFile, $contents);
