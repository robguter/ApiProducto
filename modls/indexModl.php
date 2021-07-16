<?php
class indexModl extends Modl {
    function __construct() {
        parent::__construct();
    }
    public function obtDtsPrd($e) {
        $rslt = $this->_db->prepare("
            SELECT a.*, b.`Pais`, b.`Ciudad` 
            FROM `ProdServ` a INNER JOIN `DatosPersonales` b 
            ON a.`IdDts` = b.`IdDts` 
            WHERE a.`IdProdServ` = $e 
            ");
        $rslt->execute();
        $rslt->setFetchMode(PDO::FETCH_ASSOC);
        return $rslt->fetchAll();
    }
    public function obtImgnsM() {
        $rslt = $this->_db->prepare("
            SELECT c.`IdProdServ`, c.`Imagen`, a.*, 
            e.`Pais`, e.`Ciudad`, b.`IdDts` 
            FROM `ProdServ` a INNER JOIN `CuentasUsrs` b 
            ON a.`IdDts` = b.`IdDts` 
            INNER JOIN `Fotos` c 
            ON a.`IdProdServ` = c.`IdProdServ` 
            INNER JOIN `MembresiaVnds` d 
            ON b.`IdDts` = d.`IdDts` 
            INNER JOIN `DatosPersonales` e 
            ON b.`IdDts` = e.`IdDts` 
            WHERE b.`Membresia`='S' 
            ORDER BY d.`Costo` DESC
            ");
        $rslt->execute();
        $rslt->setFetchMode(PDO::FETCH_ASSOC);
        return $rslt->fetchAll();
    }
    public function obtImgns() {
        $rslt = $this->_db->prepare("
            SELECT c.`IdProdServ`, c.`Imagen`, a.*, 
            e.`Pais`, e.`Ciudad`, b.`IdDts` 
            FROM `ProdServ` a INNER JOIN `CuentasUsrs` b 
            ON a.`IdDts` = b.`IdDts` 
            INNER JOIN `Fotos` c 
            ON a.`IdProdServ` = c.`IdProdServ` 
            INNER JOIN `DatosPersonales` e 
            ON b.`IdDts` = e.`IdDts` 
            WHERE b.`Membresia`='N'
            ");
        $rslt->execute();
        $rslt->setFetchMode(PDO::FETCH_ASSOC);
        return $rslt->fetchAll();
    }
}