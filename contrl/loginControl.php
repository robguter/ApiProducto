<?php

class loginControl extends Controlador {

    private  $_login;
    function __construct() {
        parent::__construct();
        $this->_login = $this->loadModl('login');
        $this->_vista->setJs(array('jquery','jquery-ui.min','jquery.validate'),1);
        if ($this->_vista->_argumn)
            $this->_vista->_id = $this->_vista->_argumn[0];
        //$this->_vista->setJs(array('nuevo'),0);
    }
    public function index() {
        if (Session::get('autenticado')) {
            $this->redireccionar();
        }
        $this->_vista->titulo = "Iniciar Sesión";
        if ($this->getInt('enviar') == 1) {
            $this->_vista->datos = $_POST;
            
            if (!$this->obtPstPrm('Email')){
                $this->_vista->_error = "Your Email is required";
                $this->_vista->renderizar('index','login');
                exit();
            }
            if (!$this->getSql('Clave')){
                $this->_vista->_error = "Your Password is required";
                $this->_vista->renderizar('index','login');
                exit();
            }
            
            $fila = $this->_login->obtUsr(
                $this->obtPstPrm('Email'),
                $this->getSql('Clave')
            );
            if (!$fila) {
                $this->_vista->_error = "Usuario y/o password errado";
                $this->_vista->renderizar('index','login');
                exit();
            }
            if ($fila['Estatus'] != 'Activo') {
                $this->_vista->_error = "Este Usuario no está habilitado";
                $this->_vista->renderizar('index','login');
                exit();
            }
            
            Session::set('autenticado', true);
            Session::set('level', $fila['IdNusr']);
            Session::set('email', $fila['Email']);
            Session::set('id_usuario', $fila['IdDts']);
            Session::set('usuario', $fila['Nombre']);
            Session::set('tiempo', time());
            if ($fila['IdNusr'] == 1) {
                $this->redireccionar('dashboard');
                exit();
            }
            $this->redireccionar();
        }
        $this->_vista->renderizar('index','login');
    }
    public function forgot() {
        sleep(1);
        $this->_vista->titulo = "Forgot Password";
        
        if ($this->getInt('enviar') == 1) {
            $this->_vista->datos = $_POST;
            
            if (!$this->obtPstPrm('Email')){
                $this->_vista->_error = "Your Email is required";
                $this->_vista->renderizar('forgot','login');
                exit();
            }
            
            $this->getLibs('class.phpmailer');
            $mail = new PHPMailer();
            
            $usuario = $this->_login->ElIdUsr(
                $this->obtPstPrm('Email')
            );
            if (!$usuario) {
                $this->_vista->_error = "User not found";
                $this->_vista->renderizar('forgot','login');
                exit();
            }
            $mail->From = 'robertgutierrez6@yahoo.com';
            $mail->FromName = utf8_decode('Robert Gutiérrez');
            $mail->Subject = utf8_decode('Activación de cuenta de usuario');
            $mail->Body = 'Hello <strong>' . utf8_decode( $usuario['Nombre'] )
                    . '</strong>,'
                    . '<p>To change your password click on the following link: <br>'
                    . '<a href=' . BASE_URL . 'login/reset/'
                    . $usuario['IdDts'] . '>'
                    . 'Reset Password</a>';

            $mail->AltBody = 'Su servidor de correo no soporta html';
            $mail->addAddress($this->obtPstPrm('Email'));
            $mail->send();
            $this->_vista->_mensaje = "A link has been sent to your Email.
                    Please select it to create your new password.";
            
            $this->redireccionar();
        }else{
            $this->_vista->renderizar('forgot','login');
        }
    }
    public function reset() {
        $this->_vista->titulo = "Reset Password";
        if ($this->getInt('enviar') > 0) {
            $this->_vista->datos = $_POST;
            
            if (!$this->getSql('Clave')){
                $this->_vista->_error = "Your Password is required";
                $this->_vista->renderizar('reset','login');
                exit();
            }
            $fila = $this->_login->ActualPssw(
                $this->getInt('enviar'),
                $this->getSql('Clave')
            );
            if (!$fila) {
                $this->_vista->_error = "password errado";
                $this->_vista->renderizar('reset','login');
                exit();
            }
            $this->redireccionar();
        }
        $this->_vista->renderizar('reset','login');
    }
    public function cerrar() {
        Session::destroy();
        $this->redireccionar();
    }
}