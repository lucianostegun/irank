<?php

class LogException extends Exception 
{
    public function __construct ( $msg, $app = '', $severity = 4) {
        parent::__construct( $msg, $severity );

        $message = 'File: ' . $this->getFile() . " \n";
        $message.= 'Line: ' . $this->getLine() . " \n";
        $message.= 'Message: ' . $this->getMessage();
        
        Log::doLog( $message, $app, $severity );
    }
} // LogException
?>