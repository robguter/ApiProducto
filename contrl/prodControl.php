<?php
class prodControl extends Controlador {
    private $_prod;
    public $_ajax;
    public $alm;
    
    function __construct() {
        parent::__construct();
        $this->_prod = $this->loadModl('prod');
        $this->Listar();
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
        $rutaEntid = ROOT . 'entds' . DS . 'prodEntd.php';
        require_once $rutaEntid;
        $this->alm = new prodEntd();
    }
    public function index() {
        $this->_vista->titulo = 'Productos';
        $this->_vista->renderizar('index','prod');
    }
    public function ingresa() {
        sleep(1);
        $this->_vista->datos = $_POST;
        $this->_vista->titulo = 'Productos';
        if ($this->getTexto('Envi')) {
            if( $this->getInt('IdPr') > 0 )
            {
                $this->Actualizar();
            }else{
                $this->Registrar();
            }
        }
        echo json_encode(
            $this->_prod->Obtiene()
        );
    }
    public function Listar() {
        $this->_vista->_alm = $this->_prod->Listar();
    }
    public function Obtener() {
        sleep(1);
        echo json_encode(
            $this->_prod->Obtener($this->getInt('IdPr'))
        );
    }
    public function Actualizar() {
        sleep(1);
        $this->alm->__SET('IdProd',       $this->getInt('IdPr'));
        $this->alm->__SET('Codigo',       $this->obtPstPrm('Codi'));
        $this->alm->__SET('Descripcion',  $this->obtPstPrm('Desc'));
        $this->alm->__SET('Marca',        $this->obtPstPrm('Marc'));
        $this->alm->__SET('Modelo',       $this->obtPstPrm('Mode'));
        $this->alm->__SET('PrecioU',      $this->getDbl('Prec'));
        $this->alm->__SET('Existencia',   $this->getInt('Exis'));
        $this->alm->__SET('Imagen',       $this->obtPstPrm('Imag'));

        $this->_prod->Actualizar($this->alm);
        $this->_vista->_mensaje = "Registro Actualizado satisfactoriamente";
        $this->_vista->_alm = $this->_prod->Listar();
    }
    public function Registrar() {
        sleep(1);
        $this->alm->__SET('Codigo',       $this->obtPstPrm('Codi'));
        $this->alm->__SET('Descripcion',  $this->obtPstPrm('Desc'));
        $this->alm->__SET('Marca',        $this->obtPstPrm('Marc'));
        $this->alm->__SET('Modelo',       $this->obtPstPrm('Mode'));
        $this->alm->__SET('PrecioU',      $this->getDbl('Prec'));
        $this->alm->__SET('Existencia',   $this->getInt('Exis'));
        $this->alm->__SET('Imagen',       $this->obtPstPrm('Imag'));

        $Ult = $this->_prod->Registrar($this->alm);
        $this->_vista->datos = $this->_prod->Obtener($Ult);
        $this->_vista->_mensaje = "Registro ingresado satisfactoriamente";
    }
    public function Eliminar() {
        sleep(1);
        $this->_prod->Eliminar($this->getInt('IdPr'));
        echo json_encode(
            $this->_prod->Obtiene()
        );
    }
    
}