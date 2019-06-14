<?php
/**
 * Copyright © 2010-2018 Epicor Software Corporation: All Rights Reserved
 */

namespace Dev\LogData\Model;

class LogData
{
    public static function log($data)
    {
        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/dmdebug.log');
        $log = new \Zend\Log\Logger();
        $log->addWriter($writer);
        if(is_string($data)){
            $log->info($data);
        }else{
            $log->info(print_r($data, true));
        }

    }
}