<?php

namespace BusinessTime;

use BusinessTime\Exceptions\InvalidArgumentException;
use Carbon\CarbonInterface;
use Carbon\CarbonInterval;
use Cmixin\BusinessTime;
use DateInterval;
use Spatie\OpeningHours\OpeningHours;

class Calculator
{
    /**
     * @var CarbonInterface
     */
    protected $date;

    /**
     * @var CarbonInterval
     */
    protected $interval;

    /**
     * @var bool
     */
    protected $open;

    /**
     * @var bool
     */
    protected $holidaysAreClosed;

    /**
     * @var bool
     */
    protected $past;

    /**
     * @var OpeningHours
     */
    protected $openingHours;

    public function __construct(CarbonInterface $date, CarbonInterval $interval, bool $open, bool $holidaysAreClosed)
    {
        $this->date = $date;

        try {
            $this->openingHours = $date->getOpeningHours(BusinessTime::LOCAL_MODE);
        } catch (InvalidArgumentException $e) {
            $this->openingHours = null;
        }

        $this->interval = $interval;
        $this->open = $open;
        $this->holidaysAreClosed = $holidaysAreClosed;
    }

    public function calculate($maximum = INF): CarbonInterface
    {
        $remainingInterval = $this->interval;
        $resultCandidate = $this->completeDate(
            $this->date->copy()->add($remainingInterval)
        );
        $this->past = $resultCandidate < $this->date;
        $base = $this->getStartDate($this->date);

        for ($i = 0; $i < $maximum; $i++) {
            [$next, $resultCandidate] = $this->getNextAndCandidate($base, $remainingInterval);

            if ($this->isInLimit($resultCandidate, $next)) {
                return $this->completeDate(
                    $this->date->setDateTimeFrom($resultCandidate)
                );
            }

            $remainingInterval = $next->diff($resultCandidate, false);
            $base = $this->getNextInTakenState($next);
        }

        throw new InvalidArgumentException('Maximum iteration ('.$maximum.') has been reached.');
    }

    protected function isInExpectedState(CarbonInterface $date): bool
    {
        $methodPrefix = 'is';

        if ($this->holidaysAreClosed) {
            $methodPrefix .= 'Business';
        }

        return $date->{$methodPrefix.($this->open ? 'Open' : 'Closed')}();
    }

    protected function getNextInTakenState(CarbonInterface $date): CarbonInterface
    {
        return $this->getNext($date, $this->open);
    }

    protected function getNext(CarbonInterface $date, bool $openState): CarbonInterface
    {
        $methodPrefix = $this->past ? 'previous' : 'next';

        if ($this->holidaysAreClosed) {
            $methodPrefix .= 'Business';
        }

        return $this->completeDate(
            $this->completeDate($date->copy())
                ->{$methodPrefix.($this->past === $openState ? 'Close' : 'Open')}()
        );
    }

    protected function getNextAndCandidate(CarbonInterface $date, DateInterval $interval): array
    {
        $next = $this->getNextInSkippedState($date);
        $resultCandidate = $date->copy()->add($interval);

        if (!$this->isInExpectedState($date)) {
            $next = $this->getNextInSkippedState($date);
        }

        return [$next, $resultCandidate];
    }

    protected function getNextInSkippedState(CarbonInterface $date): CarbonInterface
    {
        return $this->getNext($date, !$this->open);
    }

    protected function isInLimit(CarbonInterface $possibleResult, CarbonInterface $limitDate): bool
    {
        return $this->past ? $possibleResult >= $limitDate : $possibleResult < $limitDate;
    }

    protected function getStartDate(CarbonInterface $date)
    {
        return $this->isInExpectedState($date) || (
            $this->past && $this->isInExpectedState($date->copy()->subMicrosecond())
        )
            ? $date
            : $this->getNextInTakenState($date);
    }

    protected function completeDate(CarbonInterface $date): CarbonInterface
    {
        if ($this->openingHours) {
            return $date->setOpeningHours($this->openingHours);
        }

        return $date;
    }
}
