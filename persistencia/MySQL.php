<?php
require_once 'configuracion.php';
require_once PER . DIRECTORY_SEPARATOR . 'ManejadorBaseDeDatosInterface.php';

class MySQL implements ManejadorBaseDeDatosInterface
{
    const USUARIO = 'user';
    const CLAVE = 'password';
    const BASE = 'sge';
    const SERVIDOR = 'localhost';
    private $_conexion;

    public function conectar()
    {
        $this->_conexion = new mysqli(        
        self::SERVIDOR, 
        self::USUARIO, 
        self::CLAVE, 
        self::BASE);
            if ($this->_conexion->connect_errno) {
                printf("Falló la conexión: %s\n", $this->_conexion->connect_error);
                exit();
            }
    }

    public function desconectar()
    {
        $this->_conexion->close();
    }
    
    public function consultar(SQL $sql)
    {
        $todo = array();
        $resultado = $this->_conexion->query($sql->consultar());
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
//        echo $sql->consultar();
//        break;
        $resultado = $this->_conexion->query($sql->consultar());
        return $resultado;
    }


}
