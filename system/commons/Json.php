<?php
namespace App\commons;

class Json
{
    public function response($data, $status = "success", $message = ""){
        $json = array(
            "data"    => $data,
            "status"  => $status,
            "message" => $message
        );
        echo json_encode($json);
        exit();
    }
}
