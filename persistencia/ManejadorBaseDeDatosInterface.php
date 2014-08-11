<?php
interface ManejadorBaseDeDatosInterface
{
    public function conectar();
    public function desconectar();
    public function guardar(SQL $sql);
    public function eliminar(SQL $sql);
    public function modificar(SQL $sql);


    public function autenticarUsuario(SQL $sql);
    public function consultar(SQL $sql);
    public function consultarModulos(SQL $sql);
    public function listarUsuarios(SQL $sql);
    public function consultarModulo(SQL $sql);
    public function consultarPerfiles(SQL $sql);
  
}