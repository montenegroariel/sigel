<?php
require_once 'configuracion.php';
require_once PER . DIRECTORY_SEPARATOR . 'ModuloPersistencia.php';

class Modulo
{
    private $_id; 
    private $_detalle; 
    private $_idpadre;
    private $_icono;
    
    public function __construct($id = "", $detalle = "", $idpadre = "",$icono = "") 
    {
        $this->_id = $id; 
        $this->_detalle = $detalle; 
        $this->_idpadre = $idpadre;
        $this->_icono = $icono;
    }

    public function getDetalleModulo($id)
    {
        $moduloPersistencia = new ModuloPersistencia(); 
        $datos_array = $moduloPersistencia->getModulo($id);
        foreach($datos_array as $modulos_array){ 
            $modulo = new Modulo(
            $modulos_array['id'], 
            $modulos_array['detalle'], 
            $modulos_array['id_padre'], 
            $modulos_array['icono']);
        }
        return $modulo->_detalle;
    }
    
    public static function getModulo($id)
    {
        $moduloPersistencia = new ModuloPersistencia(); 
        $datos_array = $moduloPersistencia->getModulo($id);
        foreach($datos_array as $modulos_array){ 
            $modulo = new Modulo(
            $modulos_array['id'], 
            $modulos_array['detalle'], 
            $modulos_array['id_padre'], 
            $modulos_array['icono']);
        }
        return $modulo;
    }
    
    public static function getModulos()
    {
        $moduloPersistencia = new ModuloPersistencia(); 
        $datos_array = $moduloPersistencia->getModulos(); 
        foreach($datos_array as $modulos_array){
            $modulos[] = new Modulo(
            $modulos_array['id'], 
            $modulos_array['detalle'], 
            $modulos_array['id_padre'], 
            $modulos_array['icono']);
        } 
        return $modulos;
    }
    
    public static function getSubModulos($id)
    {
        $modulos = array();
        $moduloPersistencia = new ModuloPersistencia(); 
        $datos_array = $moduloPersistencia->getSubModulos($id);
        foreach($datos_array as $modulos_array){ 
            $modulos[] = new Modulo(
            $modulos_array['id'], 
            $modulos_array['detalle'], 
            $modulos_array['id_padre'], 
            $modulos_array['icono']);
        }
        return $modulos;
    }
    
    
   
    public function getId()
    { 
        return $this->_id; 
    }
    
    public function getDetalle() 
    {
        return $this->_detalle;
    }
    
    public function getPadre() 
    { 
        return $this->_idpadre; 
    }
    public function getIcono() 
    { 
        return $this->_icono; 
    }

   
    public function __toString() 
    { 
        return $this->_detalle;
    }
}