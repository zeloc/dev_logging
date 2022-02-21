<?php

namespace Zeloc\LogData\Model;

class LogData
{
    public static function log($data, $logFileName = 'zdebug.log')
    {
        $path = '/var/log/' . $logFileName;
        $writer = new \Zend\Log\Writer\Stream(BP . $path);
        $log = new \Laminas\Log\Logger();
        $log->addWriter($writer);
        if(is_string($data)){
            $log->info($data);
        }else{
            $log->info(print_r($data, true));
        }
    }

    public static function logClass($object, $ref='object')
    {
        if(is_object($object)){
            $class = get_class($object);
            self::log(sprintf('%s class name = %s', $ref, $class));
        }else{
            $type = gettype($object);
            self::log(sprintf('Variable is object, is type: %s', $type));
        }

    }
}