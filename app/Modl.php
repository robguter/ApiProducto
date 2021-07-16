<?php

class Modl {

    protected $_db;
    function __construct() {
        try {
            $this->_db = new Database;
            $this->CreaTbl();
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }
    
    protected function loadEntd($entd) {
        $entd = $entd . 'Entd';
        $rutaEntd = ROOT . 'entds' . DS . $entd . '.php';
        if (is_readable($rutaEntd) ) {
            require_once $rutaEntd;
            $entd = new $entd;
            return $entd;
        }else{
            throw new Exception('Error de Entidad');
        }
    }
    private function CreaTbl() {
        
        /************* Cuentas de Usuarios**************** */
        $rsltk = $this->_db->prepare("
            CREATE TABLE `CuentasUsrs` (
                `IdDts`     int(11) unsigned PRIMARY KEY,
                `Email`     varchar(250) COLLATE utf8_unicode_ci NOT NULL,
                `DNIoNRE`   varchar(20) COLLATE utf8_unicode_ci NULL,
                `Estatus`   varchar(20) COLLATE utf8_unicode_ci NOT NULL,
                `IdNusr`    int(4) unsigned NOT NULL,
                `Fecha`     datetime NOT NULL,
                `Vendedor`  varchar(1) COLLATE utf8_unicode_ci DEFAULT 'N',
                `Comprador` varchar(1) COLLATE utf8_unicode_ci DEFAULT 'N',
                `Membresia` varchar(1) COLLATE utf8_unicode_ci DEFAULT 'N',
                `Foto`      varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
        $rsltk->execute();
        /************* Datos Personales **************** */
        $rsltl = $this->_db->prepare("
            CREATE TABLE `DatosPersonales` (
                `IdDts`     int(11) unsigned AUTO_INCREMENT PRIMARY KEY,
                `Nombre`    varchar(70) COLLATE utf8_unicode_ci NOT NULL,
                `Apellido`  varchar(70) COLLATE utf8_unicode_ci NOT NULL,
                `Email`     varchar(250) COLLATE utf8_unicode_ci NOT NULL,
                `Empresa`   varchar(70) COLLATE utf8_unicode_ci NULL,
                `Pais`      varchar(30) COLLATE utf8_unicode_ci NOT NULL,
                `Ciudad`    varchar(70) COLLATE utf8_unicode_ci NOT NULL,
                `Direccion` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
                `Estado`    varchar(70) COLLATE utf8_unicode_ci NOT NULL,
                `Zipcode`   varchar(7) COLLATE utf8_unicode_ci NOT NULL,
                `Telefono`  varchar(13) COLLATE utf8_unicode_ci NOT NULL,
                `Clave`     varchar(250) COLLATE utf8_unicode_ci NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
        $rsltl->execute();
            /************* ProdServ **************** */
            $rsltm = $this->_db->prepare("
            CREATE TABLE IF NOT EXISTS `Productos` (
                `IdProd`      int(10) unsigned AUTO_INCREMENT PRIMARY KEY,
                `Codigo`      varchar(20) NOT NULL COLLATE utf8_unicode_ci,
                `Descripcion` varchar(70) NOT NULL COLLATE utf8_unicode_ci,
                `Marca`       varchar(30) DEFAULT NULL COLLATE utf8_unicode_ci,
                `Modelo`      varchar(30) DEFAULT NULL COLLATE utf8_unicode_ci,
                `PrecioU`     numeric(10, 2) NOT NULL,
                `Existencia`  int(10) NOT NULL,
                `Imagen`      varchar(155) DEFAULT NULL COLLATE utf8_unicode_ci
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
        $rsltm->execute();
        /************* Lineas **************** */
        $rsltr = $this->_db->prepare("
            CREATE TABLE IF NOT EXISTS `Lineas` (
                `IdLinea` int(10) unsigned AUTO_INCREMENT PRIMARY KEY,
                `Linea` varchar(70) NOT NULL COLLATE utf8_unicode_ci
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
        $rsltr->execute();
        /************* Categorias **************** */
        $rslts = $this->_db->prepare("
            CREATE TABLE IF NOT EXISTS `Categorias` (
                `IdCate` int(10) unsigned AUTO_INCREMENT PRIMARY KEY,
                `IdLinea` int(10) DEFAULT NULL,
                `Categoria` varchar(70) NOT NULL COLLATE utf8_unicode_ci
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
        $rslts->execute();
        /************* SubCategorias **************** */
        $rsltt = $this->_db->prepare("
            CREATE TABLE IF NOT EXISTS `SubCategorias` (
                `IdSubCat` int(10) unsigned AUTO_INCREMENT PRIMARY KEY,
                `IdCate` int(10) DEFAULT NULL,
                `Subcategoria` varchar(70) NOT NULL COLLATE utf8_unicode_ci
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
        $rsltt->execute();
        
        
        //************ Niveles de Usuario **********/
        $rslt8 = $this->_db->prepare("
            CREATE TABLE IF NOT EXISTS `Niveles_usr` (
                `IdNusr` int(4) unsigned AUTO_INCREMENT PRIMARY KEY,
                `Tipo` varchar(100) COLLATE utf8_unicode_ci NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
        $rslt8->execute();
        //************ Accesos **********/
        $rslt9 = $this->_db->prepare("
            CREATE TABLE IF NOT EXISTS `Accesos` (
                `IdAcs` int(4) AUTO_INCREMENT PRIMARY KEY,
                `Acceso` varchar(150) COLLATE utf8_unicode_ci NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
        $rslt9->execute();
        //************ Accesos de Usuarios **********/
        $rslt0 = $this->_db->prepare("
            CREATE TABLE IF NOT EXISTS `Acceso_usrs` (
                `IdNusr` int(4) NOT NULL,
                `IdAcs` int(4) NOT NULL,
                `Valor` enum('Permitido','Bloqueado')
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
        $rslt0->execute();
    }

    private function MantenTbl($e) {
        $sql = 'TRUNCATE TABLE ' . $e;
        $stat = $this->_db->prepare($sql);
        $stat->execute();

        $sql = 'ANALYZE TABLE ' . $e;
        $stat1 = $this->_db->prepare($sql);
        $stat1->execute();
        
        $sql = 'CHECK TABLE ' . $e;
        $stat2 = $this->_db->prepare($sql);
        $stat2->execute();
        
        $sql = 'ALTER TABLE ' . $e . ' ENGINE = InnoDB';
        $stat3 = $this->_db->prepare($sql);
        $stat3->execute();
        
        $sql = 'FLUSH TABLE ' . $e;
        $stat4 = $this->_db->prepare($sql);
        $stat4->execute();
        
        $sql = 'OPTIMIZE TABLE ' . $e;
        $stat5 = $this->_db->prepare($sql);
        $stat5->execute();
    }
    
}