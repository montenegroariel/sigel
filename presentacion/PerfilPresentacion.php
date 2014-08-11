<?php
require_once 'configuracion.php';
require_once DOM . DIRECTORY_SEPARATOR . 'Permiso.php';
require_once DOM . DIRECTORY_SEPARATOR . 'Perfil.php';

abstract class PerfilPresentacion
{
    public static function nuevoPerfil()
    {
        $form = self::_mostrarFormNuevoPerfil();
        return $form;
    }
    
    public static function guardarPerfil($id,$detalle)
    {
        $perfil = new Perfil($id,$detalle);
        return $perfil->guardarPerfil();
    }
    
    public static function modificarPerfil($id)
    {
        $form = self::_mostrarFormModificarPerfil($id);
        return $form;
    }
    
    public static function guardarPerfilModificado($id, $detalle)
    {
        $perfil = new Perfil($id,$detalle);
        return $perfil->guardarPerfilModificado();
    }
    
    public static function eliminarPerfil($id)
    {
        $perfil = new Perfil;
        $perfil->eliminarPerfil($id);
    }
    
    static public function listadoPerfiles()
    { 
	  $perfiles_arr = Perfil::getPerfiles();
      $permiso = Permiso::getPermiso($_SESSION['perfil'], $_GET['modulo']);
	  $retorno = "<div class='row'>";	
	  $retorno .= "<div class='col-lg-12'>";
	  $retorno .= "<div class='panel panel-default'>";
	  $retorno .= "<div align='right' class='panel-heading'>";
	  $retorno .= "</div>";
	  $retorno .= "<div class='panel-body'>";
	  $retorno .= "<div class='table-responsive'>";
	  $retorno .= "<table class='table table-striped table-bordered table-hover' id='dataTables-example'>";
	  $retorno .= "<thead>";
	  $retorno .= "<tr>";
	  $retorno .= "<th>Id</th>";
	  $retorno .= "<th>Detalle</th>";
	  $retorno .= "<th>Modificar</th>";
	  $retorno .= "<th>Eliminar</th>";
	  $retorno .= "</tr>";
	  $retorno .= "</thead>";
	  $retorno .= "<tbody>";
			
	  //var_dump($usuarios_arr);
	  foreach($perfiles_arr as $perfil){
	       $retorno .= "<tr class='odd gradeX'>";			
	       $retorno .= "<td>" . $perfil->getId() . "</td>";
	       $retorno .= "<td>" . $perfil->getDetalle() . "</td>";
                if($permiso->getModificar()){
                    $retorno .= "<td><a href='?modulo=". $_GET['modulo'] ."&accion=modificarPerfil&id=".$perfil->getId()."'><i class='fa fa-edit fa-fw'></i></a></td>";
                }else{
                    $retorno .= "<td><i class='fa fa-edit fa-fw'></i></td>";
                }
                if($permiso->getEliminar()){
                    $retorno .= "<td><a href='?modulo=". $_GET['modulo'] ."&accion=eliminarPerfil&id=".$perfil->getId()."''><i class='fa fa-eraser fa-fw'></i></a></td>";
                }else{
                    $retorno .= "<td><i class='fa fa-eraser fa-fw'></i></td>";
                }
	       $retorno .= "</tr>";
	  } 
        $retorno .= "</tbody>";
        $retorno .= "</table>";
        if($permiso->getAgregar()){
            $retorno .= "<div align='right' class='panel-heading'>";
            $retorno .="<a href='?modulo=". $_GET['modulo'] ."&accion=nuevoPerfil' ><button type='button' class='btn btn-primary btn-sm'>Nuevo Perfil</button></a>";
            $retorno .= "</div>";
	  }
	  $retorno .= "</div>";
	  $retorno .= "</div>";
	  $retorno .= "</div>";
	  $retorno .= "</div>";
	  $retorno .= "</div>";     
	  return $retorno;   
    }
    
    static public function _mostrarFormNuevoPerfil()
    {
        $retorno = "<form style='width:50%' role='form' action='?modulo=". $_GET['modulo'] ."&accion=guardarPerfil ' method='post'> ";
        $retorno .= " <label>Detalle</label>";
        $retorno .= "<div class='form-group'>";
        $retorno .= "<input class='form-control' name='detalle' placeholder='Detalle'>";
        $retorno .= "</div>";
        $retorno .= "<div align='right' class='panel-heading'>";
        $retorno .="<input type='submit' class='btn btn-primary btn-sm'></submit>";
        $retorno .= "</div>";
        $retorno .= "</form>";
        return $retorno;
    }
    
    static public function _mostrarFormModificarPerfil($id)
    {
        $perfil = Perfil::getPerfil($id);
        $retorno = "<form style='width:50%' role='form' action='?modulo=". $_GET['modulo'] ."&accion=guardarPerfilModificado&id=". $perfil->getId() ."' method='post'> ";
        $retorno .= " <label>Detalle</label>";
        $retorno .= "<div class='form-group'>";
        $retorno .= "<input class='form-control'name='detalle' placeholder='Detalle' value='". $perfil->getDetalle() ."'>";
        $retorno .= "</div>";
        $retorno .= "<div align='right' class='panel-heading'>";
        $retorno .="<input type='submit' class='btn btn-primary btn-sm'></submit>";
        $retorno .= "</div>";
        $retorno .= "</form>";
        return $retorno;
    }
}

