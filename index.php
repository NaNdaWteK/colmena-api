<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if( !isset($_SESSION["_token"]) ){
    $_SESSION['_token'] = bin2hex(openssl_random_pseudo_bytes(16));
}
require_once('./vendor/autoload.php');
require_once './system/routes/Router.php';
require_once './routes.php';
