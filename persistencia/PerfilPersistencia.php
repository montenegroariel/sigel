<?php
require_once 'configuracion.php';

require_once PER . DIRECTORY_SEPARATOR . 'BaseDeDatos.php';
require_once PER . DIRECTORY_SEPARATOR . 'MySQL.php';
require_once PER . DIRECTORY_SEPARATOR . 'Sql.php';

class PerfilPersistencia
{
   public function getPerfiles()
   {  
        $bd = new BaseDeDatos(new MySQL());
        $sql = new Sql();
        $sql->addFuncion('SELECT');
        $sql->addTable('sge_perfiles');
        $resultado_arr = $bd->consultar($sql);
        //echo highlight_string(var_dump($resultado_arr));
        return $resultado_arr;
    }
  
    public function getPerfil($id)
    {
        $bd = new BaseDeDatos(new MySQL());
        $sql = new Sql();
        $sql->addFuncion('SELECT ');
        $sql->addTable('sge_perfiles');
        $sql->addWhere('sge_perfiles.id = '. $id);
        $perfil = $bd->consultar($sql);
        return $perfil;
    }
    
    public function guardarPerfil($id,$detalle)
    {
        $bd = new BaseDeDatos(new MySQL()); 
        $sql = new Sql(); 
        $sql->addFuncion("INSERT INTO "); 
        $sql->addTable("sge_perfiles ");
        $sql->addValue("'".$id."'"); 
        $sql->addValue("'".$detalle."'");
        return $bd->guardar($sql);
    }
    
    public function modificarPerfil($id, $detalle)
    {
        $bd = new BaseDeDatos(new MySQL()); 
        $sql = new Sql(); 
        $sql->addFuncion("UPDATE "); 
        $sql->addTable("sge_perfiles SET ");
        $sql->addValue("id = '".$id."'"); 
        $sql->addValue("detalle = '".$detalle."'");
        $sql->addWhere("id = '".$id."'");
        return $bd->modificar($sql);
    }
    
    public function eliminarPerfil($id)
    {
        $bd = new BaseDeDatos(new MySQL());
        $sql = new Sql();
        $sql->addTable("sge_perfiles");
        $sql->addWhere('id='.$id );
        $sql->addFuncion("DELETE FROM sge");
        $datos = $bd->eliminar($sql);
        return $datos;
    }
    
    
    
}