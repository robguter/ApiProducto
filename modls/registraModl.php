<?php
class registraModl extends Modl {
    function __construct() {
        parent::__construct();
    }
    public function vrfcaUsr($id) {
        $id = $this->_db->query("SELECT a.*,b.`Estatus`,b.`IdNusr`,b.`Fecha` 
            FROM `DatosPersonales` a INNER JOIN `CuentasUsrs` b 
            ON a.`IdDts` = b.`IdDts`
            WHERE a.`IdDts` = $id");
        return $id->fetch();
    }
    public function obtUsr($id) {
        $usuario = $this->_db->query("SELECT * FROM `CuentasUsrs` WHERE IdDts = $id");
        return $usuario->fetch();
    }
    public function vrfcEmail($email) {
        $id = $this->_db->query("SELECT * FROM `DatosPersonales` WHERE Email = '$email'");
        if ($id->fetch())
            return true;
        return false;
    }
    public function regUsr($Nomb,$Apel,$Emai,$Empr,$Pais,$Ciud,$Dire,$Esta,$Zipc,$Tele,$Clav) {
        $date = date('Y-m-d H:i:s');
        $clave = Hash::getHash('md5', $Clav, HASH_KEY);
        $sql="INSERT INTO `DatosPersonales` 
        VALUES(null,'$Nomb','$Apel','$Emai','$Empr','$Pais','$Ciud','$Dire','$Esta','$Zipc','$Tele','$clave')";
        $rslt = $this->_db->prepare($sql);
        $rslt->execute();
        
        if ($rslt) {
            $Ultimo = $this->_db->lastInsertId();
        } else {
            $Ultimo = NULL;
        }
        
        $sql1="INSERT INTO `CuentasUsrs` 
        VALUES($Ultimo,'$Emai',null,'Inactivo',10,'$date','N','N','N',null)";
        $rslt1 = $this->_db->prepare($sql1);
        $rslt1->execute();
        return $Ultimo;
    }
    public function obtUsrs() {
        $usuario = $this->_db->query("
            SELECT a.*,b.`Estatus`,b.`IdNusr`,b.`Fecha` 
            FROM `DatosPersonales` a INNER JOIN `CuentasUsrs` b 
            ON a.`IdDts` = b.`IdDts`
            ORDER BY a.`IdDts`
        ");
        $usuario->setFetchMode(PDO::FETCH_ASSOC);
        return $usuario->fetchAll();
    }
    public function obtVentas() {
        $rslt = $this->_db->prepare("
            SELECT a.`IdDts`, a.`Descripcion` 
            FROM `ProdServ` a INNER JOIN `CuentasUsrs` b 
            ON a.`IdDts` = b.`IdDts` 
            ORDER BY a.`Descripcion`
            ");
        $rslt->execute();
        $rslt->setFetchMode(PDO::FETCH_ASSOC);
        return $rslt->fetchAll();
    }
    public function obtDtsPrd($e) {
        $rslt = $this->_db->prepare("
            SELECT a.`IdProdServ`, a.`PrecioU`, 
            a.`Descripcion`, b.`Pais`, b.`Estado`, b.`Ciudad` 
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
            SELECT c.`IdProdServ`, c.`Imagen`, a.`PrecioU`, 
            a.`Descripcion`, e.`Pais`, e.`Ciudad`, e.`Estado` 
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
            SELECT c.`IdProdServ`, c.`Imagen`, a.`PrecioU`, 
            a.`Descripcion`, e.`Pais`, e.`Ciudad`, e.`Estado` 
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
    public function actUsr($id,$email) {
        $this->_db->query("UPDATE `CuentasUsrs` SET `Estatus` = 'Activo' WHERE IdDts = '$id' AND Email = '$email'");
    }
}