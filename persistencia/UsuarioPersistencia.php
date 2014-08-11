<?php
require_once 'configuracion.php';

require_once PER . DIRECTORY_SEPARATOR . 'BaseDeDatos.php';
require_once PER . DIRECTORY_SEPARATOR . 'MySQL.php';
require_once PER . DIRECTORY_SEPARATOR . 'Sql.php';


class UsuarioPersistencia
{
    private $_id;
    public function getAll()
    {
        /* Usa las clases de persistencia y retornara 
        * solo datos extraidos de la base de datos, 
        * la clase de dominio se encargará de armar los 
        * objetos y entregarlos a la capa de 
        * presentacion*/
        $bd = new BaseDeDatos(new MySQL());
        $sql = new Sql();
        $sql->addFuncion('SELECT');
        $sql->addTable('sge_usuarios join sge_personas on sge_usuarios.id_persona = sge_personas.id'); 
        $resultado_arr = $bd->consultar($sql);
        return $resultado_arr;
    }
  
  
    public function getUsuario($id) 
    { 
        $bd = new BaseDeDatos(new MySQL()); 
        $sql = new Sql(); $sql->addTable('sge_usuarios');
        $sql->addFuncion("SELECT ");
        $sql->addWhere("id = ".$id);
        return $bd->consultar($sql);
    }
 
    public function guardarUsuario($id, $mail, $pass, $perfil, $id_persona)
    {
        $bd = new BaseDeDatos(new MySQL()); 
        $sql = new Sql(); 
        $sql->addFuncion("INSERT INTO "); 
        $sql->addTable("sge_usuarios ");
        $sql->addValue("'".$id."'"); 
        $sql->addValue("'".$mail."'");        
        $sql->addValue("'".$pass."'");
        $sql->addValue("'".$perfil."'");
        $sql->addValue("'".$id_persona."'");
        return $bd->guardar($sql);
    }
  
    public function eliminarUsuario($id)
    {
        $bd = new BaseDeDatos(new MySQL());
        $sql = new Sql();
        $sql->addTable("sge_usuarios");
        $sql->addWhere('id='.$id );
        $sql->addFuncion("DELETE FROM sge");
        $datos = $bd->eliminar($sql);
        return $datos;
    }
  
    public function autenticarUsuario($user, $pass)
    {
        $bd = new BaseDeDatos(new MySQL()); 
        $sql = new Sql();
        $sql->addFuncion("SELECT ");
        $sql->addTable("`sge_usuarios`");
        $sql->addWhere("`mail` = '".$user."'");  
        $sql->addWhere("`pass` = '". md5($pass) ."'");  
        return $bd->autenticarUsuario($sql);
    }
  
 
    public function modificarUsuario($id, $nombre, $apellido, $mail, $pass, $perfil)
    {
        $bd = new BaseDeDatos(new MySQL()); 
        $sql = new Sql(); 
        $sql->addFuncion("UPDATE "); 
        $sql->addTable("sge_usuarios SET ");
        $sql->addValue("nombre = '".$nombre."'"); 
        $sql->addValue("apellido = '".$apellido."'");
        $sql->addValue("mail = '".$mail."'");
        $sql->addValue("pass = '".$pass."'");
        $sql->addValue("perfil = '".$perfil."'");
        $sql->addWhere("id = '".$id."'");
        return $bd->modificar($sql);
    }
}
