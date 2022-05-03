<?php

namespace Zeloc\LogData\Model;

class LogData
{
    public static function log($data, $logFileName = 'zdebug.log')
    {
        if(class_exists(\Zend\Log\Writer\Stream::class) && class_exists(\Laminas\Log\Logger::class)){
            $path = '/var/log/' . $logFileName;
            $writer = new \Zend\Log\Writer\Stream(BP . $path);
            $log = new \Laminas\Log\Logger();
            $log->addWriter($writer);
            if(is_string($data)){
                $log->info($data);
            }else{
                $log->info(print_r($data, true));
            }
            return true;
        }
        if(class_exists(\Dev\LogFile::class)){
            \Dev\LogFile::$config = [
                'base_path' => BP . '/',
                'log_file' => $logFileName
            ];
            \Dev\LogFile::logFile($data);
            return true;
        }
        $file = BP . '/var/log/' . $logFileName;
        file_put_contents($file, 'Error: Unable to log data check config', FILE_APPEND);

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