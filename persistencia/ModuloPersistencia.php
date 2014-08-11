<?php
require_once 'configuracion.php';

require_once PER . DIRECTORY_SEPARATOR . 'BaseDeDatos.php';
require_once PER . DIRECTORY_SEPARATOR . 'MySQL.php';
require_once PER . DIRECTORY_SEPARATOR . 'Sql.php';


    class ModuloPersistencia
    {
        public function getPermisos($perfil) {
            $bd = new BaseDeDatos(new MySQL());
            $sql = new Sql();
            $sql->addTable('sge_permisos');
            $sql->addFuncion("SELECT ");
            $sql->addWhere(" id_perfil = ".$perfil); 
            //echo $sql;        
            $resultado_arr = $bd->consultar($sql);
            //var_dump($resultado_arr);
            //break;
            return $resultado_arr;
        }

        public function getModulos() {
            $bd = new BaseDeDatos(new MySQL());
            $sql = new Sql();
            $sql->addFuncion('SELECT ');
            $sql->addTable('sge_modulos');
            $resultado_arr = $bd->consultar($sql);
            //echo highlight_string(var_dump($resultado_arr));
            //break;
            return $resultado_arr;
        }
        
        public function getSubModulos($id) {
            $bd = new BaseDeDatos(new MySQL());
            $sql = new Sql();
            $sql->addFuncion('SELECT ');
            $sql->addTable('sge_modulos');
            $sql->addWhere(' sge_modulos.id_padre = '. $id);
            $resultado_arr = $bd->consultar($sql);
            //echo highlight_string(var_dump($resultado_arr));
            //break;
            return $resultado_arr;
        }
        
        public function getModulo($id) {
            $bd = new BaseDeDatos(new MySQL());
            $sql = new Sql();
            $sql->addFuncion('SELECT sge_modulos.');
            $sql->addTable('sge_modulos');            
            $sql->addWhere(' sge_modulos.id = '. $id);
            $resultado = $bd->consultar($sql);
            //var_dump($resultado);
            //break;
            return $resultado;
        }

           
   
    }