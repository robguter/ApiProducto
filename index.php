<?php
    ini_set("display_errors","On");
    error_reporting(E_ALL);
    date_default_timezone_set('America/La_Paz');
    header('Content-Type: text/html; charset=UTF-8');
    
    define("DS", DIRECTORY_SEPARATOR);
    define("ROOT", realpath(dirname(__FILE__)) . "/");
    define("APP_PATH", ROOT . "app" . "/");
    define("APP_SVGS", ROOT . "pubs" . "/" . "Svg" . "/");
    
    try {
        require_once APP_PATH . 'Config.php';
        //require_once APP_PATH . 'Acl.php';
        require_once APP_PATH . 'Requerido.php';
        require_once APP_PATH . 'Bootstrap.php';
        require_once APP_PATH . 'Controlador.php';
        require_once APP_PATH . 'Modl.php';
        require_once APP_PATH . 'Vista.php';
        /*require_once APP_PATH . 'Registro.php';*/
        require_once APP_PATH . 'Database.php';
        require_once APP_PATH . 'Session.php';
        require_once APP_PATH . 'Hash.php';
        require_once APP_PATH . 'Svg.php';
        Session::init();
        Bootstrap::run(new Requerido());
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }