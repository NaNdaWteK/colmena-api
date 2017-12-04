<?php
namespace App\commons;

use \PDO;
use Config;
use Secure;

class Database
{
    const NOT_USER_INFO_SEPARATOR = " || ";
    private static $connection;

    private function __construct() {
        Secure::validToken();

        self::$connection  = new PDO("mysql:host=" . Config::get("host") . ";dbname=" .  Config::get("database"),  Config::get("user"),  Config::get("password"));
        self::$connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }

    public static function connect() {
        if (!self::$connection) {
            new Database();
        }

        return self::$connection;
    }

    final public function __clone() {
        throw new Exception('Only one instance of the class is possible [ : ( ]' . self::NOT_USER_INFO_SEPARATOR . $e->getMessage());
    }
}
