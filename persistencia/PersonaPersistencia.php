<?php

require_once 'configuracion.php';

require_once PER . DIRECTORY_SEPARATOR . 'BaseDeDatos.php';
require_once PER . DIRECTORY_SEPARATOR . 'MySQL.php';
require_once PER . DIRECTORY_SEPARATOR . 'Sql.php';

class PersonaPersistencia
{
    private $_id;
    public function getPersonas()
    {
        $bd = new BaseDeDatos(new MySQL());
        $sql = new Sql();
        $sql->addFuncion('SELECT');
        $sql->addTable('sge_personas');
        $resultado_arr = $bd->consultar($sql);
        return $resultado_arr;
    }
    
    public function getPersona($id) 
    { 
        $bd = new BaseDeDatos(new MySQL()); 
        $sql = new Sql(); 
        $sql->addTable('sge_personas');
        $sql->addFuncion("SELECT ");
        $sql->addWhere("id = ".$id);
        return $bd->consultar($sql);
    }

    public function guardarPersona($id, $dni, $nombre, $apellido, $direccion, $telefono)
    {
        $bd = new BaseDeDatos(new MySQL()); 
        $sql = new Sql(); 
        $sql->addFuncion("INSERT INTO "); 
        $sql->addTable("sge_personas ");
        $sql->addValue("'".$id."'"); 
        $sql->addValue("'".$dni."'"); 
        $sql->addValue("'".$nombre."'");
        $sql->addValue("'".$apellido."'");        
        $sql->addValue("'".$direccion."'");
        $sql->addValue("'".$telefono."'");
        return $bd->guardar($sql);
    }
    
}
