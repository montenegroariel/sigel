<?php
require_once 'configuracion.php';

require_once PER . DIRECTORY_SEPARATOR . 'BaseDeDatos.php';
require_once PER . DIRECTORY_SEPARATOR . 'MySQL.php';
require_once PER . DIRECTORY_SEPARATOR . 'Sql.php';

class PermisoPersistencia
{
    public function getAll()
    {
        $bd = new BaseDeDatos(new MySQL());
        $sql = new Sql();
        $sql->addFuncion('SELECT');
        $sql->addTable('sge_permisos');
        $resultado_arr = $bd->consultar($sql);
        return $resultado_arr;
    }
    
    public function getPermiso($perfil, $modulo)
    {
        $bd = new BaseDeDatos(new MySQL()); 
        $sql = new Sql();
        $sql->addFuncion("SELECT ");
        $sql->addTable('sge_permisos');
        $sql->addWhere("id_perfil = ". $perfil ." AND id_modulo = ". $modulo); 
        return $bd->consultar($sql);
    }
    
    public function getPermisos($perfil)
    {
        $bd = new BaseDeDatos(new MySQL()); 
        $sql = new Sql();
        $sql->addFuncion("SELECT ");
        $sql->addTable('sge_permisos');
        $sql->addWhere("id_perfil = ". $perfil); 
        return $bd->consultar($sql);
    }

    public function guardarPermiso($id, $id_perfil, $id_modulo, $agregar, $modificar, $eliminar)
    {
        $bd = new BaseDeDatos(new MySQL()); 
        $sql = new Sql(); 
        $sql->addFuncion("INSERT INTO "); 
        $sql->addTable("sge_permisos ");
        $sql->addValue("'".$id."'"); 
        $sql->addValue("'".$id_perfil."'"); 
        $sql->addValue("'".$id_modulo."'");
        $sql->addValue("'".$agregar."'");        
        $sql->addValue("'".$modificar."'");
        $sql->addValue("'".$eliminar."'");
        return $bd->guardar($sql);
    }

    public function modificarPermiso($id, $id_perfil, $id_modulo, $agregar, $modificar, $eliminar)
    {
        $bd = new BaseDeDatos(new MySQL()); 
        $sql = new Sql(); 
        $sql->addFuncion("UPDATE "); 
        $sql->addTable("sge_permisos SET ");
        $sql->addValue("agregar = '".$agregar."'"); 
        $sql->addValue("modificar = '".$modificar."'");
        $sql->addValue("eliminar = '".$eliminar."'");
        $sql->addWhere("id = '".$id."'");
        //echo $sql;
        return $bd->modificar($sql);
    }
    
    public function eliminarPermiso($id)
    {
        $bd = new BaseDeDatos(new MySQL());
        $sql = new Sql();
        $sql->addTable("sge_permisos");
        $sql->addWhere('id='.$id );
        $sql->addFuncion("DELETE FROM sge");
        $datos = $bd->eliminar($sql);
        return $datos;
    }
}



