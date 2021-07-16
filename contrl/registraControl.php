<?php

class registraControl extends Controlador {

    private $_registra;
    public $_ajax;
    function __construct() {
        parent::__construct();
        $this->_registra = $this->loadModl('registra');
        $this->_ajax = "registra/js/ajax.js";
        $this->_vista->setJsA(array(
            'ajax'
            )
        );
        $this->_vista->setJs(array(
            'jquery',
            'jquery-ui.min',
            'jquery.validate'
            )
        );
    }
    public function index() {
        if (Session::get('autenticado'))
            $this->redireccionar ();
        $this->_vista->titulo = 'Registro';
        $this->_vista->renderizar('index','registra');
    }
    
    public function TomaFoto() {
        /*
            Tomar una API y guardarla en un archivo
            @date 2017-11-22
            @author parzibyte
            @web parzibyte.me/blog
        */

        $imagenCodificada = file_get_contents("php://input"); //Obtener la imagen
        if(strlen($imagenCodificada) <= 0) exit("No se recibió ninguna imagen");
        //La imagen traerá al inicio data:image/png;base64, cosa que debemos remover
        $imagenCodificadaLimpia = str_replace("data:image/png;base64,", "", urldecode($imagenCodificada));
        
        //Venía en base64 pero sólo la codificamos así para que viajara por la red, ahora la decodificamos y
        //todo el contenido lo guardamos en un archivo
        $imagenDecodificada = base64_decode($imagenCodificadaLimpia);
        
        //Calcular un nombre único
        $nombreImagenGuardada = "foto_" . uniqid() . ".png";
        
        //Escribir el archivo
        file_put_contents($nombreImagenGuardada, $imagenDecodificada);
        
        //Terminar y regresar el nombre de la foto
        exit($nombreImagenGuardada);
    }
    public function ProcUsr() {
        sleep(1);
        if (Session::get('autenticado')) {
            $this->_vista->_error = "You're already signed in";
            $this->redireccionar ();
        }
        $this->_vista->titulo = 'Registro';
        
        $this->_vista->datos = $_POST;
        if (!$this->getSql('Nomb')){
            $this->_vista->_error = "Your name is required";
            $this->_vista->renderizar('index','registra');
            exit();
        }
        if (!$this->getSql('Apel')){
            $this->_vista->_error = "Your last name is required";
            $this->_vista->renderizar('index','registra');
            exit();
        }
        if (!$this->obtPstPrm('Emai')){
            $this->_vista->_error = "Your email is required";
            $this->_vista->renderizar('index','registra');
            exit();
        }
        if (!$this->getSql('Pais')){
            $this->_vista->_error = "Your country is required";
            $this->_vista->renderizar('index','registra');
            exit();
        }
        if (!$this->getSql('Ciud')){
            $this->_vista->_error = "Your city is required";
            $this->_vista->renderizar('index','registra');
            exit();
        }
        if (!$this->obtPstPrm('Dire')){
            $this->_vista->_error = "Your address is required";
            $this->_vista->renderizar('index','registra');
            exit();
        }
        if (!$this->getSql('Esta')){
            $this->_vista->_error = "Your state is required";
            $this->_vista->renderizar('index','registra');
            exit();
        }
        if (!$this->obtPstPrm('Zipc')){
            $this->_vista->_error = "Your email is required Direccion";
            $this->_vista->renderizar('index','registra');
            exit();
        }
        if (!$this->obtPstPrm('Tele')){
            $this->_vista->_error = "Your telephone is required";
            $this->_vista->renderizar('index','registra');
            exit();
        }
        if (!$this->getSql('Clav')){
            $this->_vista->_error = "Your password is required";
            $this->_vista->renderizar('index','registra');
            exit();
        }
        $this->getLibs('class.phpmailer');
        $mail = new PHPMailer();
        $Ultimo = $this->_registra->regUsr(
            $this->getSql('Nomb'),
            $this->getSql('Apel'),
            $this->obtPstPrm('Emai'),
            $this->obtPstPrm('Empr'),
            $this->getSql('Pais'),
            $this->getSql('Ciud'),
            $this->obtPstPrm('Dire'),
            $this->obtAlfNm('Esta'),
            $this->obtAlfNm('Zipc'),
            $this->obtPstPrm('Tele'),
            $this->getSql('Clav')
        );
        $usuario = $this->_registra->vrfcaUsr(
            $Ultimo
        );
        if (!$usuario) {
            $this->_vista->_error = "Error al registrar usuario";
            $this->_vista->renderizar('index','registra');
            exit();
        }
        $mail->From = 'robertgutierrez6@yahoo.com';
        $mail->FromName = utf8_decode('Robert Gutiérrez');
        $mail->Subject = utf8_decode('Activación de cuenta de usuario');
        $mail->Body = 'Hola <strong>' . utf8_decode( $usuario['Nombre'] )
                . '</strong>,'
                . '<p>Se ha registrado en Robert Gutiérrez para activar '
                . 'su cuenta haga clic sobre el enlace siguiente: <br>'
                . '<a href=' . BASE_URL . 'registra/activar/'
                . $usuario['IdDts'] . '/' . $usuario['Nombre'] . '>'
                . 'Activar Registro</a>';

        $mail->AltBody = 'Su servidor de correo no soporta html';
        $mail->addAddress($this->obtPstPrm('Emai'));
        $mail->send();
        $this->_vista->_mensaje = "Registro ingresado satisfactoriamente";
        echo json_encode(
            $this->_registra->obtUsrs()
        );
        
    }
    public function DtsPrd() {
        echo json_encode(
            $this->_registra->obtDtsPrd(
                $this->getInt('Id')
            )
        );
    }
    public function VrfcUsr() {
        echo json_encode(
            $this->_registra->vrfcaUsr(
                $this->obtAlfNm('Usua')
            )
        );
    }
    public function VrfcEmail() {
        echo json_encode(
            $this->_registra->vrfcEmail(
                $this->obtPstPrm('Emai')
            )
        );
    }
    private function obtRoleNum($param) {
        switch ($param) {
            case 1:
                return 'admin';
                break;
            case 2:
                return 'especial';
                break;
            case 3:
                return 'usuario';
                break;
            default:
                return 'usuario';
                break;
        }
    }
    public function activar($id,$usuario) {
        sleep(1);
        if (!$id || !$usuario) {
            $this->_vista->_error = "Estos datos no existen";
            $this->_vista->renderizar('activar','registra');
            exit();
        }
        $fila = $this->_registra->obtUsr(
            $id,
            $usuario
        );
        if (!$fila) {
            $this->_vista->_error = "Esta cuenta de $usuario no existe";
            $this->_vista->renderizar('activar','registra');
            exit();
        }
        if ($fila['Estatus'] == 'Activo') {
            $this->_vista->_error = "Esta cuenta ya ha sido activada";
            $this->_vista->renderizar('activar','registra');
            exit();
        }
        $fila = $this->_registra->actUsr(
            $id,
            $usuario
        );
        $fila = $this->_registra->obtUsr(
            $id,
            $usuario
        );
        if ($fila['Estatus'] == 'Inactivo') {
            $this->_vista->_error = "Error al activar la cuenta, por favor intente mas tarde";
            $this->_vista->renderizar('activar','registra');
            exit();
        }
        $this->_vista->_mensaje = "Su cuenta ha sido activada";
        $this->_vista->renderizar('activar','registra');
    }
}