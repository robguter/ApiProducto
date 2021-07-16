<?php

class indexControl extends Controlador {

    private $_php;
    public $_ajax;
    function __construct() {
        parent::__construct();
        $this->_php = $this->loadModl('index');
        $this->_ajax = "index/js/ajax.js";
        $this->_vista->setJsA(array(
            'ajax'
            )
        );
        $this->_vista->setJs(array(
            'jquery.min',
            'jquery-ui.min',
            'jquery.validate',
            'bootstrap.min'
            )
        );
    }
    public function index() {
        $this->_vista->titulo = 'Portada';
        //$this->_vista->ventasM = $this->_php->obtImgnsM();
        //$this->_vista->ventas = $this->_php->obtImgns();
        $this->_vista->renderizar('index','inicio');
    }
    public function DtsPrd() {
        echo json_encode(
            $this->_php->obtDtsPrd(
                $this->getInt('Id')
            )
        );
    }
    public function DtsPrdP() {
        if ($this->getInt('Id')) {
            //$this->_vista->ventasM = $this->_php->obtDtsPrd( $this->getInt('Id') );
            //$this->_vista->ventas = $this->_prod->obtImgns();
            header('location:'.BASE_URL. 'prod/index/'.$this->getInt('Id').'/');
        }
    }
}