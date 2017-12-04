<?php
namespace App\commons;
use Logs;

class Errors
{
    private $trace;
    private $class;
    private $line;
    private $file;
    private $message;
    private $code;

    public function __construct()
    {
        $this->class = " Clase desconocida ";
        $this->line  = 0;
        $this->file  = " Archivo desconocido ";
    }
    public function handle(\Exception $error)
    {
        self::complete($error);

        self::setClass();
        self::setFile();
        self::setLine();

        self::createLog();
        self::setLog();
    }

    private function complete($error)
    {
        $this->trace = $error->getTrace();
        $this->message = $error->getMessage();
        $this->code = $error->getCode();
    }

    private function setClass()
    {
        if( isset($this->trace[0]["class"])) {
            $this->class = $this->trace[0]["class"];
        }
    }
    private function setFile()
    {
        if(isset($this->trace[0]["file"])){
            $file = $this->trace[0]["file"];
        }
    }
    private function setLine()
    {
        if(isset($this->trace[0]["line"])){
            $line = $this->trace[0]["line"];
        }
    }
    private function createLog()
    {
        $this->log = array(
            "classType"   => $this->class,
            "method"  => $this->trace[0]["function"],
            "file" => $this->file,
            "lines"   => $this->line,
            "message" => $this->message,
            "code"  => $this->code,
        );
    }
    private function setLog()
    {
        $message = "\n Type: " . $class . "[" . $this->log['codigo'] . "]; \n Message: ".$this->log['message'] ." \n File: " . $this->log['file'] . "Line: " . $this->log['line'] . "\n-------------------------------";
        self::generateLog($message);
    }
    private function generateLog($message)
    {
        self::write($message);
        self::save();
    }
    private function write($message)
    {
        file_put_contents( "../logs/logs.txt", $message , FILE_APPEND | LOCK_EX );
    }
    private function save()
    {
        $table = "logs";
        Logs::viaAjax($this->log, $table);
    }
}
