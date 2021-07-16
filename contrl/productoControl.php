<?php
class productoControl extends Controlador {
    private $_producto;
    public $_ajax;
    public $alm;
    public $_alm;
    public $_argu;
    
    function __construct() {
        parent::__construct();
        $this->_producto = $this->loadModl('producto');
        $_argu = $this->_vista->_argumn;
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
        $this->_vista->_alm = $this->_producto->Listar();
        
        print_r($this->_vista->_alm);
        echo "<br> <p></p><div>Formato JSON<div>";
        echo json_encode( $this->_vista->_alm );
        $this->_vista->renderizar('index','producto');
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
            $this->_producto->Obtiene()
        );
    }
    public function Listar() {
        echo json_decode( $this->_vista->_alm = $this->_producto->Listar() );
    }
    public function Obtener() {
        sleep(1);
        $this->_vista->_alm = $this->_producto->Obtener($this->_vista->_argumn[0]);
        /*print_r($this->_vista->_alm);
        echo "<br> <p></p><div>Formato JSON<div>";*/
        echo json_encode( $this->_vista->_alm );
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

        $this->_producto->Actualizar($this->alm);
        $this->_vista->_mensaje = "Registro Actualizado satisfactoriamente";
        $this->_vista->_alm = $this->_producto->Listar();
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

        $Ult = $this->_producto->Registrar($this->alm);
        $this->_vista->datos = $this->_producto->Obtener($Ult);
        $this->_vista->_mensaje = "Registro ingresado satisfactoriamente";
    }
    public function Eliminar() {
        sleep(1);
        $this->_producto->Eliminar($this->getInt('IdPr'));
        echo json_encode(
            $this->_producto->Obtiene()
        );
    }
    
}