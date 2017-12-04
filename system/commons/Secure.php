<?php
namespace App\commons;

use Json;

class Secure
{

    public static function notGetRequest()
    {
        if( $_SERVER['REQUEST_METHOD'] !== 'POST' ){
            die('ESTA OPERACION NO ESTÁ PERMITIDA');
            exit();
        }
    }

    public static function validToken(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!isset($token) || ($token !== $_SESSION['_token'])){
                JSON::response('', 'error', 'Invalid token');
            }
        }
    }

    public static function string($string){
        return addslashes( htmlentities( utf8_decode( trim( $string ) ) ) );
    }
}
