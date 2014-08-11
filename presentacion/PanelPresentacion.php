<?php
require_once 'configuracion.php';
require_once DOM . DIRECTORY_SEPARATOR . 'Modulo.php';
require_once DOM . DIRECTORY_SEPARATOR . 'Permiso.php';

abstract class PanelPresentacion
{
    static public function mostrarPanel($id_perfil)
    {
        //return $id_perfil;
        $form = self::_mostrarPanel($id_perfil);
        return $form;
    }

    static public function mostrarModulos($id_perfil)
    {
        //return $id_perfil;
        $form = self::_mostrarModulos($id_perfil);
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
		
        //$modulos_array = Modulo::getModulos();
        $permisos_array = Permiso::getPermisos($id_perfil);
        
        if(count($permisos_array) == 0)
        {
            return 'Sin modulos asignados';
        }else{
        //cargar modulos
            foreach($permisos_array as $permiso)
            {
                $modulo = Modulo::getModulo($permiso->getModulo());

                if ($modulo->getPadre() == 0)
                {
                    $id = $modulo->getId();    
                    $retorno .= "<li><a href=''>"
                        . "<i class='fa ". $modulo->getIcono() ." fa-fw'></i> " . 
                        $modulo->getDetalle() . "</a>";

                    foreach($permisos_array as $permiso)
                    {   
                        $submodulo = Modulo::getModulo($permiso->getModulo());
                        if($id == $submodulo->getPadre()){    
                        $retorno .= "<ul class='nav nav-second-level'>";
                        $retorno .= "<li><a href='?modulo=". $submodulo->getId() . 
                            "&accion=inicio'><i class='fa  ". $submodulo->getIcono() ." fa-fw'></i>" . 
                            $submodulo->getDetalle() . "</a></li>";          
                        $retorno .= "</ul>";
                        }
                    }
                    $retorno .= "</li>";    
                }
            }
        }
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
    
    public static function getDetalleModulo($id)
    {
        if ($id=='Inicio'){
            return $id;
        }
        else{
            $modulo = new Modulo();
            return $modulo->getDetalleModulo($id);
            //break;
        }
    }
}
