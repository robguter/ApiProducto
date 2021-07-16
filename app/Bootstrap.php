<?php

class Bootstrap {
    
    public static function run(Requerido $peticion) {
        $controlador = $peticion->getControl() . 'Control';
        $rutaControl = ROOT . 'contrl' . DS . $controlador . '.php';
        $metodo = $peticion->getMetodo();
        $args = $peticion->getArgs();
        
        if (is_readable($rutaControl) ) {
            require_once $rutaControl;
            
            $controlador = new $controlador;
            
            if (is_callable(array($controlador, $metodo)) ) {
                $metodo = $peticion->getMetodo();
            }else{
                $metodo = 'index';
            }
            
            if ( isset( $args ) ) {
                call_user_func_array(array($controlador,$metodo),$args);
            }else{
                call_user_func(array($controlador,$metodo));
            }
        }else{
            throw new Exception('No encontrado');
        }
    }
}