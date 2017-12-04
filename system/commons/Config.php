<?php
namespace App\commons;

class Config{

    private static $config = [
        'host'  => 'localhost',
        'user'  => 'colmena',
        'password'  => 'secret',
        'database'  => 'colmenatest',
    ];

    private static function getConfig(){
        return self::$config;
    }
}
