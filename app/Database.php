<?php

class Database extends PDO {
    protected $pdo;
    public function __construct() {
        try {
            /*ini_set('mysql.connect_timeout',  30000000);
            ini_set('default_socket_timeout', 30000000);*/
            parent::__construct(
                "mysql:host=" . DB_HOST .
                ";dbname=" . DB_NAME,
                DB_USER,
                DB_PASS,
                array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . DB_CHAR
                )
            );
        } catch (Exception $ex) {
            //echo DB_HOST . ", " . DB_USER . ", " . DB_PASS;
            if( $this->pdo = new PDO("mysql:host=".DB_HOST.";", DB_USER, DB_PASS) ){
                try{
                    $crear_db = $this->pdo->prepare("CREATE DATABASE IF NOT EXISTS ".DB_NAME." COLLATE utf8_spanish_ci");   
                    $crear_db->execute();
                    $this->pdo->close();
                }catch(Exception $e){
                    $this->Msg($e->getMessage());
                    exit();
                }
            }
            parent::__construct(
                "mysql:host=" . DB_HOST .
                ";dbname=" . DB_NAME,
                DB_USER,
                DB_PASS,
                array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . DB_CHAR
                )
            );
        }
    }
    
}