<?php
require_once 'configuracion.php';
//require_once DOM . DIRECTORY_SEPARATOR . 'Usuario.php';
require_once DOM . DIRECTORY_SEPARATOR . 'Modulo.php';

abstract class PanelPresentacion
{
    static public function mostrarPanel($id_perfil)
    {
        //return $id_perfil;
        $form = self::_mostrarPanel($id_perfil);
        return $form;
    }



    static public function mostrarFormModificarUsuario($id)
	  {
			$usuario = Usuario::load($id); 
			$form = self::_mostrarFormulario(
			        $id, $usuario->getNombre(), 
			        $usuario->getApellido(),
			        $usuario->getPassword(),
			        $usuario->getEstado(),
			        $usuario->getAdmin(),
			        "modificar" ); 
			return $form;
	  }



    static private function _mostrarModulos($id_perfil)
    {
		$retorno = "<nav class='navbar-default navbar-static-side' role='navigation'>";
		$retorno .= "<div class='sidebar-collapse'>";
		$retorno .= "<ul class='nav' id='side-menu'>";
		//side-menu
		$datos_array = Modulo::getModulos($id_perfil);
		//var_dump($datos_array);
		//break;        
        foreach($datos_array as $modulos){
            if($modulos->getPadre() == 0) {
            $retorno .= "<li><a href='?modulo=". $modulos->getEnlace() ."'><i class='fa fa-edit fa-fw'></i>" . $modulos->getDetalle() . "</a>";
            $id = $modulos->getId();
            $retorno .= "<ul class='nav nav-second-level'>";
                foreach($datos_array as $modulos){
                    if($modulos->getPadre() == $id) {
                    $retorno .= "<li><a href='?modulo=". $modulos->getEnlace() ."'>" . $modulos->getDetalle() . "</a></li>";        		
                    }
                }
           $retorno .= "</ul>"; 
            }
        } 
				
		$retorno .= "</li>";
		//side-menu
		$retorno .= "</ul>";
		$retorno .= "</div>";
		$retorno .= "</nav>";
        return $retorno;
    }


    
    static private function _mostrarPanel($id_perfil)
        { 
			$retorno = "<div id='wrapper'>"; 
			$retorno .= "<nav class='navbar navbar-default navbar-static-top' role='navigation' style='margin-bottom: 0'>";
			$retorno .= "<div class='navbar-header'>";
			$retorno .= "<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.sidebar-collapse'>";
			$retorno .= "<span class='sr-only'>Toggle navigation</span>";
			$retorno .= "<span class='icon-bar'></span>";
			$retorno .= "<span class='icon-bar'></span>";
			$retorno .= "<span class='icon-bar'></span>";
			$retorno .= "</button>";
			$retorno .= "<a class='navbar-brand' href='index.html'>Sistema de Gesti&oacuten Educativo</a>";
			$retorno .= "</div></nav>";
			$retorno .= self::_mostrarModulos($id_perfil);
			$retorno .= "<div id='page-wrapper'>";
			$retorno .= "<div class='row'>";
			$retorno .= "<div class='col-lg-12'>";
			//Contenido div
			$retorno .= "<h1 class='page-header'>Modulo</h1>";
			//Contenido div
			$retorno .= "</div>";
			$retorno .= "</div>";
			$retorno .= "</div>";
			$retorno .= "</div>";
        
        return $retorno;
        }

}
