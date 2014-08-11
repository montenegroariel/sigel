<?php
require_once PRE . DIRECTORY_SEPARATOR . 'UsuarioPresentacion.php';
$accion = filter_input(INPUT_GET, 'accion');
switch ($accion) {	
    case 'nuevoUsuario':
		echo "<div id='page-wrapper'>" ;
		echo "<div class='row'>";
		echo "<div class='col-lg-12'>";            
		echo "<h1 class='page-header'>Usuarios";
		echo "</h1>";
		echo "</div>";
		echo "</div>";
		echo UsuarioPresentacion::nuevoUsuario();
		echo "</div>";
		echo "</div>";
		break;
    case 'modificarUsuario':
        $id = filter_input(INPUT_GET, 'id');
		echo "<div id='page-wrapper'>" ;
		echo "<div class='row'>";
		echo "<div class='col-lg-12'>";            
		echo "<h1 class='page-header'>Usuarios";
		echo "</h1>";
		echo "</div>";
		echo "</div>";
		echo UsuarioPresentacion::modificarUsuario($id);
		echo "</div>";
		echo "</div>";
		break;
    case 'guardarUsuario':
        $nombre = filter_input(INPUT_POST, 'nombre');
        $apellido = filter_input(INPUT_POST, 'apellido');
        $mail = filter_input(INPUT_POST, 'mail');
        $pass = filter_input(INPUT_POST, 'pass');
        $perfil = filter_input(INPUT_POST, 'perfil');
        $modulo = filter_input(INPUT_GET, 'modulo');
        UsuarioPresentacion::guardarUsuario('',$nombre,$apellido,$mail, md5($pass) ,$perfil);
        header("Location:index.php?modulo=". $modulo ."&accion=inicio");
        break;
    case 'guardarUsuarioModificado':
        $id = filter_input(INPUT_GET, 'id');
        $nombre = filter_input(INPUT_POST, 'nombre');
        $apellido = filter_input(INPUT_POST, 'apellido');
        $mail = filter_input(INPUT_POST, 'mail');
        $pass = filter_input(INPUT_POST, 'pass');
        $perfil = filter_input(INPUT_POST, 'perfil');
        $modulo = filter_input(INPUT_GET, 'modulo');
        UsuarioPresentacion::guardarUsuarioModificado($id,$nombre,$apellido,$mail,$pass,$perfil);
        header("Location:index.php?modulo=". $modulo ."&accion=inicio");
	break;
    case 'eliminarUsuario':
        $id = filter_input(INPUT_GET, 'id');
        $modulo = filter_input(INPUT_GET, 'modulo');
		UsuarioPresentacion::eliminarUsuario($id);
        header("Location:index.php?modulo=". $modulo ."&accion=inicio");
		break;
	default:
        $modulo = filter_input(INPUT_GET, 'modulo');
		echo "<div id='page-wrapper'>" ;
		echo "<div class='row'>";
		echo "<div class='col-lg-12'>";            
		echo "<h1 class='page-header'>Usuarios";
		echo "</h1>";
		echo "</div>";
		echo "</div>";
		echo UsuarioPresentacion::listadoUsuarios($modulo);
		echo "</div>";
		echo "</div>";
		break;
	}
