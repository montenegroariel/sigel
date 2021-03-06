<?php
require_once 'configuracion.php';
require_once DOM . DIRECTORY_SEPARATOR . 'Perfil.php';
require_once DOM . DIRECTORY_SEPARATOR . 'Persona.php';
require_once PER . DIRECTORY_SEPARATOR . 'UsuarioPersistencia.php';

class Usuario extends Persona
{
    private $_id; 
    private $_mail;
    private $_pass;
    private $_id_perfil;
    private $_id_persona;
    
    public function __construct($id ="", $mail = "", $pass="", $id_perfil="", $id_usuario_persona="", $id_persona ="", $dni = "", $nombre = "", $apellido = "", $direccion = "", $telefono="" ) 
    {
        parent::__construct($id_persona, $dni, $nombre, $apellido, $direccion, $telefono);
        $this->_id = $id; 
        $this->_mail = $mail;
        $this->_pass = $pass;
        $this->_id_perfil = $id_perfil;
        $this->_id_persona = $id_persona;
    }
            
    public function getId()
    { 
        return $this->_id; 
    }
       
    public function getMail() 
    { 
        return $this->_mail; 
    }
    
    public function getPassword()
    {
        return $this->_pass;
    }
    
    public function getPerfil() 
    {
        return $this->_id_perfil;
    }

    public function getPersona() 
    {
        return $this->_id_persona;
    }
    
    
    /* Acciones */
    
    public static function getAll()
    {
        $usuarioPersistencia = new UsuarioPersistencia(); 
        $datos_array = $usuarioPersistencia->getAll(); 
        foreach($datos_array as $usuarios_array){ 

        $usuarios[] = new Usuario(
            $usuarios_array['id'],
            $usuarios_array['mail'],
            $usuarios_array['pass'],
            $usuarios_array['id_perfil'],
            $usuarios_array['id_persona'],
            $usuarios_array['id'],
            $usuarios_array['dni'],
            $usuarios_array['nombre'],
            $usuarios_array['apellido'],
            $usuarios_array['direccion'],
            $usuarios_array['telefono']);

        } return $usuarios;   
    }
    
    public static function getUsuario($id)
    {
        $usuarioPersistencia = new UsuarioPersistencia(); 
        $datos_array = $usuarioPersistencia->getUsuario($id); 
        foreach($datos_array as $usuario_array){ 
        $usuario = new Usuario(
        $usuario_array['id'],
        $usuario_array['mail'],
        $usuario_array['pass'],
        $usuario_array['id_perfil'],
        $usuario_array['id_persona']);
        } return $usuario;
    }
    
    public function autenticarUsuario($user, $pass)
    {
       $usuarioPersistencia = new UsuarioPersistencia();
       $datos = $usuarioPersistencia->autenticarUsuario($user, $pass);
//       var_dump($datos);
//       break;
       return $datos;
    }
    
    public function guardarUsuario() 
    { 
        $usuarioPersistencia = new UsuarioPersistencia(); 
        $guardo = $usuarioPersistencia->guardarUsuario(
            $this->_id,
            $this->_mail, 
            $this->_pass,
            $this->_id_perfil, 
            $this->_id_persona);
        return $guardo;
    }
        
    public function guardarUsuarioModificado()
    {
        $usuariopersistencia = new UsuarioPersistencia();
        $modifico = $usuariopersistencia->modificarUsuario(
            $this->_id,
            $this->_mail, 
            $this->_pass,
            $this->_id_perfil, 
            $this->_id_persona);
        return $modifico;
    }
    
    public function eliminarUsuario($id){
       $usuarioPersistencia = new UsuarioPersistencia();
       $datos = $usuarioPersistencia->eliminarUsuario($id);
       return $datos;
    }
 
    public function __toString() 
    { 
        return $this->_mail;
    }
   
}
