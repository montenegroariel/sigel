<?php
require_once 'configuracion.php';
//require_once DOM . DIRECTORY_SEPARATOR . 'Perfil.php';
require_once PER . DIRECTORY_SEPARATOR . 'PersonaPersistencia.php';

abstract class Persona
{
    private $_id; 
    private $_dni; 
    private $_nombre; 
    private $_apellido;
    private $_direccion;
    private $_telefono;
    
    public function __construct($id ="", $dni = "", $nombre = "", $apellido = "", $direccion = "", $telefono="") 
    {
        $this->_id = $id; 
        $this->_dni = $dni; 
        $this->_nombre = $nombre; 
        $this->_apellido = $apellido; 
        $this->_direccion = $direccion;
        $this->_telefono = $telefono;
    }
    
    public function getId()
    { 
        return $this->_id; 
    }
    
    public function getNombre()
    { 
        return $this->_nombre; 
    }
    
    public function getApellido()
    { 
        return $this->_apellido; 
    }
    
    public function getDireccion()
    { 
        return $this->_direccion; 
    }
    
    public function getTelefono()
    { 
        return $this->_telefono; 
    }
    
    /*public static function getPersonas()
    {
        $personaPersistencia = new PersonaPersistencia(); 
        $datos_array = $personaPersistencia->getPersonas(); 
        foreach($datos_array as $personas_array){ 
        $personas[] = new Persona(
            $personas_array['id'],
            $personas_array['dni'],
            $personas_array['nombre'],
            $personas_array['apellido'],
            $personas_array['direccion'],
            $personas_array['telefono']);
        } return $personas;   
    }
    
    public static function getPersona($id)
    {
        $personaPersistencia = new PersonaPersistencia(); 
        $datos_array = $personaPersistencia->getPersona($id);
        foreach($datos_array as $personas_array){ 
        $persona = new Persona(
            $personas_array['id'],
            $personas_array['dni'],
            $personas_array['nombre'],
            $personas_array['apellido'],
            $personas_array['direccion'],
            $personas_array['telefono']);
        } return $persona;   
    }

    public function guardarPersona() 
    { 
        $personaPersistencia = new PersonaPersistencia(); 
        $guardo = $personaPersistencia->guardarPersona(
            $this->_id, 
            $this->_dni,
            $this->_nombre, 
            $this->_apellido, 
            $this->_direccion, 
            $this->_telefono);
        return $guardo;
    }
    
    public function guardarPersonaModificada()
    {
        $personapersistencia = new PersonaPersistencia();
        $modifico = $personapersistencia->modificarPersona(
            $this->_id, 
            $this->_dni,
            $this->_nombre, 
            $this->_apellido, 
            $this->_direccion, 
            $this->_telefono);
        return $modifico;
    }
    
    public function eliminarPersona($id){
        $personaPersistencia = new PersonaPersistencia();
        $datos = $personaPersistencia->eliminarPersona($id);
    return $datos;
    }*/
    
}
