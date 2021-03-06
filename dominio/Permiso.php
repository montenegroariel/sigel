<?php
require_once 'configuracion.php';
require_once PER . DIRECTORY_SEPARATOR . 'PermisoPersistencia.php';

class Permiso
{
    private $_id;
    private $_id_perfil;
    private $_id_modulo; 
    private $_agregar;
    private $_modificar;
    private $_eliminar;

    public function __construct($id = "",$id_perfil = "", $id_modulo = "", $agregar = "", $modificar = "", $eliminar = "") 
    {
        $this->_id = $id;
        $this->_id_perfil = $id_perfil; 
        $this->_id_modulo = $id_modulo; 
        $this->_agregar = $agregar;
        $this->_modificar = $modificar;
        $this->_eliminar = $eliminar;
    }
    
    public function getId()
    {
        return $this->_id;
    }
    
    public function getModulo()
    {
        return $this->_id_modulo;
    }

        public function getModificar()
    {
        
        return $this->_modificar;
    }
    
    public function getEliminar()
    {
        
        return $this->_eliminar;
    }
    
    public function getAgregar()
    {
        
        return $this->_agregar;
    }

    public function guardarPermiso() 
    { 
        $permisoPersistencia = new PermisoPersistencia(); 
        $guardo = $permisoPersistencia->guardarPermiso($this->_id, $this->_id_perfil, 
            $this->_id_modulo, $this->_agregar, $this->_modificar, $this->_eliminar);
        return $guardo;
    }
    
    public function guardarPermisoModificado()
    {
        $permisoPersistencia = new PermisoPersistencia(); 
        $modifico = $permisoPersistencia->modificarPermiso(
        $this->_id,     
        $this->_id_perfil, 
        $this->_id_modulo, 
        $this->_agregar, 
        $this->_modificar, 
        $this->_eliminar);
        return $modifico;

    }

    public function eliminarPermiso($id){
       $permisoPersistencia = new PermisoPersistencia();
       $datos = $permisoPersistencia->eliminarPermiso($id);
       return $datos;
    }

    public static function getPermiso($perfil, $modulo)
    {
        $permisoPersistencia = new PermisoPersistencia();
        $datos_array = $permisoPersistencia->getPermiso($perfil, $modulo); 
        foreach($datos_array as $permiso_array){ 
        $permiso = new Permiso(
        $permiso_array['id'],
        $permiso_array['id_perfil'],
        $permiso_array['id_modulo'],
        $permiso_array['agregar'],
        $permiso_array['modificar'],
        $permiso_array['eliminar']);
        } return $permiso;
    }
    
    public static function getPermisos($perfil)
    {
        $permiso = array();
        $permisoPersistencia = new PermisoPersistencia();
        $datos_array = $permisoPersistencia->getPermisos($perfil); 
        foreach($datos_array as $permiso_array){ 
        $permiso[] = new Permiso(
        $permiso_array['id'],
        $permiso_array['id_perfil'],
        $permiso_array['id_modulo'],
        $permiso_array['agregar'],
        $permiso_array['modificar'],
        $permiso_array['eliminar']);
        } 
        //echo highlight_string(var_dump($permiso));
        return $permiso;
    }
}
