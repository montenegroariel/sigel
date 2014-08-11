<?php
require_once 'configuracion.php';
require_once PER . DIRECTORY_SEPARATOR . 'ManejadorBaseDeDatosInterface.php';

class MySQL implements ManejadorBaseDeDatosInterface
{
    const USUARIO = 'root';
    const CLAVE = 'lhrcm21';
    const BASE = 'sge';
    const SERVIDOR = 'localhost';
    private $_conexion;


    public function conectar()
    {
        $this->_conexion = new PDO('mysql:
            host='. self::SERVIDOR .
            ';dbname='. self::BASE,
            self::USUARIO,
            self::CLAVE
        );
        
        /*$this->_conexion->select_db(
            self::BASE
            //,$this->_conexion
        );*/
    }

    public function desconectar()
    {
        $this->_conexion = null;
    }
    

    
    public function consultar(SQL $sql)
    {
        $todo = array();
        $resultado = mysqli_query($this->_conexion,$sql->consultar());
        while ($fila = mysqli_fetch_array($resultado, MYSQL_ASSOC)){
            $todo[] = $fila;
        }
        return $todo;
    }
    
    
    public function guardar(SQL $sql) {
        mysqli_query($this->_conexion, $sql->guardar());
        $guardar = $this->_conexion->insert_id;
        return $guardar;
    }
    
    public function modificar(SQL $sql) {
        $modificar = mysqli_query($this->_conexion,$sql->modificar());
        return $modificar;
    }
    
    public function eliminar(SQL $sql) {
        $eliminar = mysqli_query($this->_conexion, $sql->eliminar());
        return $eliminar;
    }
    
    


    public function autenticarUsuario(SQL $sql)
    {
        $autenticar = mysqli_query($this->_conexion, $sql->consultar());
        return $autenticar;
    }
    
    public function listarUsuarios(SQL $sql)
    {
        $listado = mysqli_query($this->_conexion, $sql->consultarUsuarios());
        while ($fila = mysqli_fetch_array($listado, MYSQL_ASSOC)){
            $todo[] = $fila;
        }
        //highlight_string(var_export($todo));
        return $todo;
    }
    
    public function consultarModulos(SQL $sql) {
        $modulos = mysqli_query($this->_conexion, $sql->consultarModulos());
        return $modulos;    
    }
    
    public function consultarModulo(SQL $sql){
        $modulo = mysqli_query($this->_conexion, $sql->consultar());
        return $modulo;
    }
    
    public function consultarPerfiles(SQL $sql)
    {
        //echo DEBUG ? $sql : null;
        //echo $sql->consultarPerfiles();
        $perfiles = mysqli_query($this->_conexion, $sql->consultarPerfiles());
        while ($fila = mysqli_fetch_array($perfiles, MYSQL_ASSOC)){
        $todo[] = $fila;
        }
        //highlight_string(var_export($todo));
        return $todo;    
    }
}
