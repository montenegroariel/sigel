<?php
require_once 'configuracion.php';
require_once DOM . DIRECTORY_SEPARATOR . 'Usuario.php';
require_once DOM . DIRECTORY_SEPARATOR . 'Perfil.php';
require_once DOM . DIRECTORY_SEPARATOR . 'Permiso.php';

abstract class UsuarioPresentacion
{
    
    
    static public function mostrarFormLogin()
    {
        $form = self::_mostrarLogin();
        return $form;
    }

    static public function errorAcceso()
    {
        $form = self::_errorAcceso();
        return $form;
    }

    public static function nuevoUsuario()
    {
     $form = self::_mostrarFormNuevoUsuario();
     return $form;
    }	

    public static function modificarUsuario($id)
    {
     $form = self::_mostrarFormModificarUsuario($id);
     return $form;
    }
    
    public static function mostrarFormRegistro()
    {
     $form = self::_mostrarFormRegistro();
     return $form;
    }

    static private function _errorAcceso()
    {
        $retorno = "<div class='container'>";
	    $retorno .= "<div class='col-md-4 col-md-offset-4'>";
	    $retorno .= "<div class='login-panel panel panel-default'>";
	    $retorno .= "<div class='panel-heading'>";
	    $retorno .= "<h3 class='panel-title'>Login</h3></div>";
	    $retorno .= "<div class='panel-body'>";
	    $retorno .= "<form>";
	    $retorno .= "<fieldset>";
	    $retorno .= "<div class='form-group'>";
	    $retorno .= "</div><div class='form-group'>";
	    $retorno .= "</div>";
	    $retorno .= "<div align='center' class='alert alert-danger'>Acceso denegado<br><a href='?modulo=login' class='alert-link'>Ingresar</a></div>";
	    $retorno .= "</fieldset>";
	    $retorno .= "</form>";
	    $retorno .= "</div>";
	    $retorno .= "</div>";
	    $retorno .= "</div>";
	    $retorno .= "</div>";
	    $retorno .= "</div>";
	    return $retorno;
     }
   
     static private function _mostrarLogin($user = "ariel@gmail.com",$pass = "ariel",$accion = "acceso")
     {
	    $retorno = "<div class='container'>";
	    $retorno .= "<div class='col-md-4 col-md-offset-4'>";
	    $retorno .= "<div class='login-panel panel panel-default'>";
	    $retorno .= "<div class='panel-heading'>";
	    $retorno .= "<h3 class='panel-title'>Login</h3></div>";
	    $retorno .= "<div class='panel-body'>";
	    $retorno .= "<form role='form' action='?modulo=".$accion."' method='post'>";
	    $retorno .= "<fieldset>";
	    $retorno .= "<div class='form-group'>";
	    $retorno .= "<input name='user' value='". $user ."' class='form-control' placeholder='E-mail' type='email' autofocus>";
	    $retorno .= "</div><div class='form-group'>";
	    $retorno .= "<input type='password' name='pass' value='". $pass ."' class='form-control' placeholder='Password' value=''>";
	    $retorno .= "</div>";                
	    $retorno .= "<div class='form-group' style='text-align:center;'><a href='?modulo=registro'>Registrarse</a></div>";                
	    $retorno .= "<input type='submit' name='submit' class='btn btn-lg btn-success btn-block'></input>";
	    $retorno .= "</fieldset>";
	    $retorno .= "</form>";
	    $retorno .= "</div>";
	    $retorno .= "</div>";
	    $retorno .= "</div>";
	    $retorno .= "</div>";
	    $retorno .= "</div>";
	    return $retorno;
     }
     
    static public function _mostrarFormNuevoUsuario()
    {
        $perfiles_arr = Perfil::getPerfiles();
        $retorno = "<form style='width:50%' role='form' action='?modulo=". $_GET['modulo'] ."&accion=guardarUsuario '       method='post'> ";
        $retorno .= "<div class='form-group'>";
        $retorno .= "<input class='form-control'name='apellido' placeholder='Apellido'>";
        $retorno .= "</div>";
        $retorno .= "<div class='form-group'>";
        $retorno .= "<input class='form-control' name='nombre' placeholder='Nombre'>";
        $retorno .= "</div>";
        $retorno .= "<div class='form-group'>";
        $retorno .= "<input class='form-control' name='mail' placeholder='e-mail'>";
        $retorno .= "</div>";
        $retorno .= "<div class='form-group'>";
        $retorno .= "<input class='form-control' type='password' name='pass' placeholder='Password'>";
        $retorno .= "</div>";
        $retorno .= "<div style='width:50%'class='form-group'>";
        $retorno .= "<select name='perfil' class='form-control'>";
            foreach($perfiles_arr as $Perfil){
            $retorno .= "<option value=".$Perfil->getId().">". $Perfil->getDetalle()."</option>";
            }
        $retorno .= "</select>";
        $retorno .= "</div>";
        $retorno .= "<div align='right' class='panel-heading'>";
        $retorno .="<input type='submit' class='btn btn-primary btn-sm'></submit>";
        $retorno .= "</div>";
        $retorno .= "</form>";
        return $retorno;
    }

    static public function _mostrarFormRegistro()
    {
        $retorno = "<div style='position:absolute;width:50%;top:10%;left:30%;'> ";
        $retorno .= "<form ' role='form' action='?modulo=guardarRegistro'  method='post'> ";
        $retorno .= "<div class='form-group'>";
        $retorno .= "<input class='form-control' name='nombre' placeholder='Nombre'>";
        $retorno .= "</div>";
        $retorno .= "<div class='form-group'>";
        $retorno .= "<input class='form-control'name='apellido' placeholder='Apellido'>";
        $retorno .= "</div>";
        $retorno .= "<div class='form-group'>";
        $retorno .= "<input type='number' class='form-control' name='dni' placeholder='DNI'>";
        $retorno .= "</div>";   
        $retorno .= "<div class='form-group'>";
        $retorno .= "<input class='form-control' name='direccion' placeholder='Direccion'>";
        $retorno .= "</div>";
        $retorno .= "<div class='form-group'>";
        $retorno .= "<input class='form-control' name='telefono' placeholder='Telefono'>";
        $retorno .= "</div>";
        $retorno .= "<div class='form-group'>";
        $retorno .= "<input type='email' class='form-control' name='mail' placeholder='e-mail'>";
        $retorno .= "</div>";
        $retorno .= "<div class='form-group'>";
        $retorno .= "<input class='form-control' type='password' name='pass' placeholder='Password'>";
        $retorno .= "</div>";
        $retorno .= "<div align='right' class='panel-heading'>";
        $retorno .="<input type='submit' class='btn btn-primary btn-sm' value='Registrarse'></submit>";
        $retorno .= "</div>";
        $retorno .= "</form>";
        $retorno .= "</div>";
        return $retorno;
    }

    static public function _mostrarFormModificarUsuario($id)
    {
        $Usuario = Usuario::getUsuario($id);
        $perfiles_arr = Perfil::getPerfiles();
        $retorno = "<form style='width:50%' role='form' action='?modulo=". $_GET['modulo'] ."&accion=guardarUsuarioModificado&id=". $Usuario->getId() ."' method='post'> ";
        $retorno .= " <label>Apellido</label>";
        $retorno .= "<div class='form-group'>";
        $retorno .= "<input class='form-control'name='apellido' placeholder='Apellido' value='". $Usuario->getApellido() ."'>";
        $retorno .= "</div>";
        $retorno .= " <label>Nombre</label>";
        $retorno .= "<div class='form-group'>";
        $retorno .= "<input class='form-control' name='nombre' placeholder='Nombre' value='". $Usuario->getNombre() ."'>";
        $retorno .= "</div>";
        $retorno .= " <label>Mail</label>";
        $retorno .= "<div class='form-group'>";
        $retorno .= "<input class='form-control' name='mail' placeholder='e-mail'value='". $Usuario->getMail() ."'>";
        $retorno .= "</div>";
        $retorno .= " <label>Password</label>";
        $retorno .= "<div class='form-group'>";
        $retorno .= "<input type='password' class='form-control' name='pass' placeholder='Password'>";
        $retorno .= "</div>";
        $retorno .= " <label>Perfil</label>";
        $retorno .= "<div style='width:50%'class='form-group'>";
        $retorno .= "<select name='perfil' class='form-control'>";
        foreach($perfiles_arr as $Perfil){
        $retorno .= "<option value=".$Perfil->getId().">". $Perfil->getDetalle() ."</option>";
        }
        $retorno .= "</select>";
        $retorno .= "</div>";
        $retorno .= "<div align='right' class='panel-heading'>";
        $retorno .="<input type='submit' class='btn btn-primary btn-sm'></submit>";
        $retorno .= "</div>";
        $retorno .= "</form>";
        return $retorno;
    }




    static public function listadoUsuarios($id)
    {
        $Permiso = Permiso::getPermiso($_SESSION['perfil'], $_GET['modulo']);
        $usuarios_arr = Usuario::getAll($id);
        //var_dump($usuarios_arr);
        //break;
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
        $retorno .= "<th>Nombre</th>";
        $retorno .= "<th>Apellido</th>";
        $retorno .= "<th>Perfil</th>";
        $retorno .= "<th>Modificar</th>";
        $retorno .= "<th>Eliminar</th>";
        $retorno .= "</tr>";
        $retorno .= "</thead>";
        $retorno .= "<tbody>";

        //var_dump($usuarios_arr);
        foreach($usuarios_arr as $Usuario){

            //$Persona = Persona::getPersona($Usuario->getPersona());
            $retorno .= "<tr class='odd gradeX'>";			
            $retorno .= "<td>" . $Usuario->getId() . "</td>";
            $retorno .= "<td>" . $Usuario->getNombre() . "</td>";
            $retorno .= "<td>" . $Usuario->getApellido() . "</td>";

                if($Usuario->getPerfil() != 0){
                $Perfil = Perfil::getPerfil($Usuario->getPerfil());
                $retorno .= "<td>" . $Perfil->getDetalle() . "</td>";
                    }else{
                $retorno .= "<td><a>Registrado</a></td>";
                }
            
                if($Permiso->getModificar()){
                    $retorno .= "<td><a href='?modulo=". $_GET['modulo'] .
                    "&accion=modificarUsuario&id=".$Usuario->getId().
                    "'><i class='fa fa-edit fa-fw'></i></a></td>";
                }else{
                    $retorno .= "<td><i class='fa fa-edit fa-fw'></i></td>";
                }

                if($Permiso->getEliminar()){
                    $retorno .= "<td><a href='?modulo=". $_GET['modulo'] .
                    "&accion=eliminarUsuario&id=".$Usuario->getId().
                    "''><i class='fa fa-eraser fa-fw'></i></a></td>";
                }else{
                    $retorno .= "<td><i class='fa fa-eraser fa-fw'></i></td>";
                }

            $retorno .= "</tr>";
        }
        
        $retorno .= "</tbody>";
        $retorno .= "</table>";
        if($Permiso->getAgregar()){
            $retorno .= "<div align='right' class='panel-heading'>";
            $retorno .="<a href='?modulo=". $_GET['modulo'] .
            "&accion=nuevoUsuario' ><button type='button' class='btn btn-primary btn-sm'>Nuevo Usuario</button></a>";
            $retorno .= "</div>";
        }
        
        $retorno .= "</div>";
        $retorno .= "</div>";
        $retorno .= "</div>";
        $retorno .= "</div>";
        $retorno .= "</div>";     
        return $retorno;   
    }


        public static function autenticarUsuario($user, $pass)
        {
          $Usuario = new Usuario();
          return $Usuario->autenticarUsuario($user, $pass);
        }

        public static function guardarUsuario($id,$nombre,$apellido,$mail,$pass,$perfil)
        {
                $Usuario = new Usuario($id,$nombre, $apellido,$mail,$pass,$perfil);
                return $Usuario->guardarUsuario();
        }

        public static function guardarUsuarioModificado($id,$nombre,$apellido,$mail,$pass,$perfil)
        {
                $Usuario = new Usuario($id,$nombre, $apellido,$mail,$pass,$perfil);
                return $Usuario->guardarUsuarioModificado();
        }   
        
        public static function eliminarUsuario($id)
        {
                $Usuario = new Usuario();
                return $Usuario->eliminarUsuario($id);
        }

        public static function guardarRegistro($nombre,$apellido,$dni,$direccion,$telefono,$mail,$pass)
        {
                $Persona = new Persona('', $dni, $nombre, $apellido, $direccion, $telefono);                                
                $id_persona = $persona->guardarPersona();

                $Usuario = new Usuario('', $mail, $pass, $perfil, $id_persona);
                $Usuario->guardarUsuario();
        }

     
}
