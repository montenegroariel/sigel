<?php
require_once 'configuracion.php';
require_once PER . DIRECTORY_SEPARATOR . 'ManejadorBaseDeDatosInterface.php';
require_once PER . DIRECTORY_SEPARATOR . 'Sql.php';

class BaseDeDatos
{
    private $_manejador;

    public function __construct(ManejadorBaseDeDatosInterface $manejador)
    {
        $this->_manejador = $manejador;
    }
    
    public function ejecutar(Sql $sql)
    {

        $this->_manejador->conectar();
        
        $datos = $this->_manejador->ejecutar($sql);

        $this->_manejador->desconectar();

        return $datos;
    }
    
    public function consultar(Sql $sql)
    {

        $this->_manejador->conectar();
        
        $datos = $this->_manejador->consultar($sql);

        $this->_manejador->desconectar();

        return $datos;
    }
    
    public function guardar(Sql $sql)
    {
        $this->_manejador->conectar();
        
        $datos = $this->_manejador->guardar($sql);

        $this->_manejador->desconectar();

        return $datos;
    }
    
    public function eliminar(Sql $sql)
    {
        $this->_manejador->conectar();
        
        $eliminar= $this->_manejador->eliminar($sql);
        
        $this->_manejador->desconectar();
        
        return $eliminar;
    }
    
    
    public function consultarModulo(sql $sql)
    {
        //echo $sql;
        //break;
        $this->_manejador->conectar();
        
        $datos = $this->_manejador->consultarModulo($sql);

        $this->_manejador->desconectar();

        return $datos;
    }
    
    public function autenticarUsuario(Sql $sql)
    {
        $this->_manejador->conectar();
        
        $autenticar= $this->_manejador->autenticarUsuario($sql);
        
        $this->_manejador->desconectar();
        
        return $autenticar;
    }    

    public function listarUsuarios(Sql $sql)
    {
        $this->_manejador->conectar();
        
        $autenticar= $this->_manejador->listarUsuarios($sql);
        
        $this->_manejador->desconectar();
        
        return $autenticar;
    }  

    
    public function modificar(Sql $sql)
    {
        $this->_manejador->conectar();
        
        $modificar= $this->_manejador->modificar($sql);
        
        $this->_manejador->desconectar();
        
        return $modificar;
    }
    
   
    public function consultarPerfiles(Sql $sql)
    {
        $this->_manejador->conectar();
        
        $eliminar= $this->_manejador->consultarPerfiles($sql);
        
        $this->_manejador->desconectar();
        
        return $eliminar;
        
    }
                
}
