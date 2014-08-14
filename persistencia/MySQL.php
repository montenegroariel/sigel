<?php
require_once 'configuracion.php';
require_once PER . DIRECTORY_SEPARATOR . 'ManejadorBaseDeDatosInterface.php';

class MySQL implements ManejadorBaseDeDatosInterface
{
    const USUARIO = 'root';
    const CLAVE = 'piratas2012';
    const BASE = 'sge';
    const SERVIDOR = 'localhost';
    private $_conexion;


    public function conectar()
    {
        $this->_conexion = new mysqli(        
        self::SERVIDOR, 
        self::USARIO, 
        self::CLAVE, 
        self::BASE);
    }

    public function desconectar()
    {
        $this->_conexion->disconect;
    }
    
    public function consultar(SQL $sql)
    {
        $todo = array();
        $resultado = mysqli_query($this->_conexion, $sql->consultar);
        //var_dump($resultado);
        while ($fila = $resultado->fetch_assoc()){
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
        $autenticar = $this->_conexion->query($sql->consultar());   
        $resultado = $autenticar->fetch();
        return $resultado;
    }


}
