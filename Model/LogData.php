<?php

namespace Zeloc\LogData\Model;

class LogData
{
    public static function log($data)
    {
        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/zdebug.log');
        $log = new \Zend\Log\Logger();
        $log->addWriter($writer);
        if(is_string($data)){
            $log->info($data);
        }else{
            $log->info(print_r($data, true));
        }

    }
}