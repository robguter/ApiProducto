<?php

class loginModl extends Modl {

    function __construct() {
        parent::__construct();
    }
    public function obtUsr($email,$pass) {
        $pas = Hash::getHash('md5', $pass, HASH_KEY);
        $datos = $this->_db->query(
            "SELECT a.*,b.`Estatus`,b.`IdNusr` 
            FROM `DatosPersonales` a INNER JOIN `CuentasUsrs` b 
            ON a.`IdDts` = a.`IdDts` 
            WHERE a.`Email` = '$email' 
            AND a.`Clave` = '$pas'"
        );
        return $datos->fetch();
    }
    public function ElIdUsr($email) {
        $dato = $this->_db->query(
            "SELECT a.`IdDts`, a.`Nombre` 
            FROM `DatosPersonales` a 
            WHERE a.`Email` = '$email'"
        );
        return $dato->fetch();
    }
    public function ActualPssw($id,$pass) {
        $pas = Hash::getHash('md5', $pass, HASH_KEY);
        $datos = $this->_db->query(
            "UPDATE `DatosPersonales` a 
            SET a.`Clave` = '$pas' 
            WHERE a.`IdDts` = $id"
        );
        return true;
    }
}