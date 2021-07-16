<?php
class prodEntd {
    private $IdProd;
    private $Codigo;
    private $Descripcion;
    private $Marca;
    private $Modelo;
    private $PrecioU;
    private $Existencia;
    private $IdSubCat;
    private $IdDts;
    private $Imagen;

    public function __GET($k){ return $this->$k; }
    public function __SET($k, $v){ return $this->$k = $v; }
}