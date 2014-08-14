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
}
