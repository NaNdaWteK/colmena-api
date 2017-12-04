<?php
namespace App\commons;
use Database;
use Json;

use \PDO;

class Logs
{
    const NOT_USER_INFO_SEPARATOR = " || ";

    public static function viaAjax($trace, $tabla)
    {
        $stmt = Database::connect();

        $query = "INSERT INTO $tabla (code, lines, file, classType, method, message) VALUES (:code, :lines, :file, :classType, :method, :message)";
        $stmt = $stmt->prepare($query);

        $stmt->bindParam(":code", $trace["code"], PDO::PARAM_INT);
        $stmt->bindParam(":lines", $trace["lines"], PDO::PARAM_INT);
        $stmt->bindParam(":file", $trace["file"], PDO::PARAM_STR);
        $stmt->bindParam(":classType", $trace["classType"], PDO::PARAM_STR);
        $stmt->bindParam(":method", $trace["method"], PDO::PARAM_STR);
        $stmt->bindParam(":message", $trace["message"], PDO::PARAM_STR);

        $stmt->execute();
        $stmt = null;

        $message = explode(self::NOT_USER_INFO_SEPARATOR, $trace["mensaje"]);
        Json::response("", "error", $message[0]);
    }
}
