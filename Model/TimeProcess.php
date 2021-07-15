<?php
/**
 * Copyright © 2010-2018 Epicor Software Corporation: All Rights Reserved
 */

namespace Zeloc\LogData\Model;

/**
 * Class TimeProcess
 * Creates a new timer object, passes in a reference so
 * it can be identified in the log
 * Starts the timer when the object is created
 * @package Zeloc\LogData\Model
 */
class TimeProcess
{
    private $startTime;
    private $endTime;
    private $reference;

    public function __construct($reference)
    {
        $this->reference= $reference;
        $this->startTimer();
    }

    /**
     * @return void
     */
    public function logEndTimer()
    {
        LogData::log($this->getResult());
    }

    /**
     * @return void
     */
    private function startTimer()
    {
        //Only start timer when its not running
        if (!$this->startTime) {
            $this->startTime = microtime(true);
            LogData::log('Start Timer: ' . $this->reference);
        }
    }

    /**
     * @return void
     */
    private function endTimer()
    {
        if (!$this->endTime) {
            $this->endTime = microtime(true);
        }
    }

    /**
     * @return string
     */
    private function getResult():string
    {
        $this->endTimer();
        if ($this->startTime && $this->endTime) {
            $execution_time = ($this->endTime - $this->startTime);
            return "Time for $this->reference: " . $execution_time . " sec";
        }

        return 'no result time was already set';
    }
}
