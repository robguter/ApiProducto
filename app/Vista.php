<?php
//require_once ROOT . 'librerias' . DS . 'smarty' . DS . 'libs' . DS . 'Smarty.class.php';
class Vista {
    
    public $_control;
    private $_js;
    private $_jsg;
    private $_svg;
    
    function __construct(Requerido $peticion) {
        $this->_control = $peticion->getControl();
        $this->_argumn = $peticion->getArgs();
        $this->_js = array();
        $this->_jsg = array();
        $this->_svg = new Svg();
    }
    
    public function renderizar($vista, $item = false) {
        
        $menup = array(
            array(
                "id" => "contact",
                "titulo" => " Contacto",
                "enlace" => BASE_URL . 'contact',
                "icono"  => "fa fa-envelope"
            )
        );
        if (Session::get('autenticado')) {
            $menup[] = array(
                "id" => "market",
                "titulo" => " Mercado",
                "enlace" => BASE_URL . "market",
                "icono"  => "fa fa-shopping-basket"
            );
            
            $menu = array(
                array(
                    "id" => "myorders",
                    "titulo" => " Pedidos",
                    "enlace" => BASE_URL . "myorders",
                    "icono"  => "fa fa-history"
                ),
                array(
                    "id" => "singout",
                    "titulo" => " Cerrar Sesión",
                    "enlace" => BASE_URL . "login/cerrar",
                    "icono"  => "fa fa-sign-out"
                ),
                array(
                    "id" => "checkout",
                    "titulo" => " Salir",
                    "enlace" => BASE_URL . "checkout",
                    "icono"  => "fa fa-shopping-cart"
                )
            );
        }else{
            $menu = array(
                array(
                    "id" => "login",
                    "titulo" => " Iniciar sesión",
                    "enlace" => BASE_URL . 'Login',
                    "icono"  => "fa fa-lock"
                ),
                array(
                    "id" => "checkin",
                    "titulo" => " Registrarse",
                    "enlace" => BASE_URL . "prod",
                    "icono"  => "fa fa-sign-in"
                )
            );
        }
        
        $js = array();
        if (count($this->_js)){
            $js = $this->_js;
        }
        
        $jsg = array();
        if (count($this->_jsg)){
            $jsg = $this->_jsg;
        }
        
        $Edir=PUBLIC_URL."Fondo/Thumbs";
        $pide = new Requerido();
        $Ctrl = $pide->getMetodo();
        if ($Ctrl != 'index') {
            $ElDir='../' . PUBLIC_URL."Fondo/Thumbs";
        }else{
            $ElDir=$Edir;
        }
        $ElDir = BASE_URL . 'pubs/Fondo/Thumbs';
        $dirint = dir($Edir);
        $n=0;
        $vinculo = array();
        while (($archivo = $dirint->read()) !== false) {
            if (preg_match("/jpg/", $archivo) || preg_match("/JPG/", $archivo)){
                $Matrz = explode( '.', $archivo );
                list($Nombre, $Extn) = $Matrz;
                $vinculo[$n]=$ElDir . "/" . $archivo;
                $n++;
            }
        }
        $dirint->close();
        
        $_Params = array(
            'ruta_css' => BASE_URL . 'pubs/css/',
            'ruta_img' => BASE_URL . 'pubs/img/',
            'ruta_fds' => BASE_URL . 'pubs/Fondo/',
            'ruta_js' => BASE_URL . 'pubs/js/',
            'ruta_svg' => BASE_URL . 'pubs/Svg/',
            'menup' => $menup,
            'menu' => $menu,
            'item' => $item,
            "js" => $js,
            "jsg" => $jsg,
            "foto" => $vinculo,
            "root" => BASE_URL,
            "configs" => array(
                'app_name' => APP_NAME,
                'app_slogan' => APP_SLOGAN,
                'app_company' => APP_COMPANY
            )
        );
        $this->_svg=$this->_svg;
        $rutaVista = ROOT . 'vistas' . DS . $this->_control . DS . $vista . '.phtml';//.tpl'
        if ($this->_control=="producto") {
            include_once $rutaVista;
        }else{
            if (is_readable($rutaVista) ) {
                include_once ROOT . 'vistas' . DS . 'disenos' . DS . DISENO_PRED . DS . 'encabezado.php';
                include_once $rutaVista;
                include_once ROOT . 'vistas' . DS . 'disenos' . DS . DISENO_PRED . DS . 'pie.php';
            }else{
                throw new Exception('Error de vista '.$rutaVista);
            }
        }
    }
    public function setJs($jsU) {
        $Burl = BASE_URL . "pubs";
        if (is_array($jsU) && count($jsU) ) {
            for ($i=0; $i < count($jsU); $i++) {
                $this->_js[]  = $Burl . '/js/' . $jsU[$i] . '.js';
            }
        } else {
            throw new Exception('Error de JS');
        }
    }
    public function setJsA($jsU) {
        $Burl = BASE_URL . "vistas/" . $this->_control;
        if (is_array($jsU) && count($jsU) ) {
            for ($i=0; $i < count($jsU); $i++) {
                $this->_jsg[] = $Burl . '/js/' . $jsU[$i] . '.js';
            }
        } else {
            throw new Exception('Error de JS');
        }
    }
    Public function CargaImgns(){
        $Edir=PUBLIC_URL."Fondo";
        $dirint = dir($Edir);
        $n=0;
        $vinculo = array();
        while (($archivo = $dirint->read()) !== false) {
            if (preg_match("/jpg/", $archivo) || preg_match("/JPG/", $archivo)){
                $Matrz = explode( '.', $archivo );
                list($Nombre, $Extn) = $Matrz;
                $vinculo[$n]=$Edir . "/" . $archivo;
                $n++;
            }
        }
        $dirint->close();
        return $vinculo;
    }
}