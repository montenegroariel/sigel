<?php
require_once 'configuracion.php';
require_once PER . DIRECTORY_SEPARATOR . 'PerfilPersistencia.php';

class Perfil
{
    private $_id; 
    private $_detalle;
    
    public function __construct($id ="", $detalle = "") 
    {
        $this->_id = $id; 
        $this->_detalle = $detalle; 
    }
    
    public function getId()
    {
        return $this->_id;
    }

    public function getDetalle()
    {
        return $this->_detalle;
    }

    public static function getPerfil($id)
    {
        $perfilPersistencia = new PerfilPersistencia();
        $datos_array = $perfilPersistencia->getPerfil($id); 
        foreach($datos_array as $perfil_array){ 
        $perfil = new Perfil(
        $perfil_array['id'],
        $perfil_array['detalle']);
        }
        return $perfil;
    }  
    
    public static function getPerfiles()
    {
        $perfilPersistencia = new PerfilPersistencia(); 
        $datos_array = $perfilPersistencia->getPerfiles();
        foreach($datos_array as $perfil_array){ 
        $perfiles[] = new Perfil(
        $perfil_array['id'],
        $perfil_array['detalle']);
        }
        return $perfiles;
    }
    
    
    public function guardarPerfil() 
    { 
       $perfilPersistencia = new PerfilPersistencia(); 
       $guardo = $perfilPersistencia->guardarPerfil($this->_id,$this->_detalle);
       return $guardo;
    }
    
    public function guardarPerfilModificado() 
    { 
       $perfilPersistencia = new PerfilPersistencia(); 
       $guardo = $perfilPersistencia->modificarPerfil($this->_id,$this->_detalle);
       return $guardo;
    }
    
    
    public function eliminarPerfil($id){
        $perfilPersistencia = new PerfilPersistencia();
        $datos = $perfilPersistencia->eliminarPerfil($id);
        return $datos;
    }
    
    
    public function getDetallePerfil($id)
    {
        $perfilPersistencia = new PerfilPersistencia();
        $datos_array = $perfilPersistencia->getPerfil($id); 
        foreach($datos_array as $perfil_array){ 
        $perfil = new Perfil(
        $perfil_array['id'],
        $perfil_array['detalle']);
        }
        return $perfil->_detalle;
    }  
}
    