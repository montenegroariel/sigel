<?php
require_once PRE . DIRECTORY_SEPARATOR . 'PermisoPresentacion.php';
    $accion = filter_input(INPUT_GET, 'accion');
	switch ($accion) {	
	case 'nuevoPermiso':
		echo "<div id='page-wrapper'>" ;
		echo "<div class='row'>";
		echo "<div class='col-lg-12'>";            
		echo "<h1 class='page-header'>Permisos";
		echo "</h1>";
		echo "</div>";
		echo "</div>";
		echo PermisoPresentacion::nuevoPermiso();
		echo "</div>";
		echo "</div>";
		break;
    case 'modificarPermiso':
        $id = filter_input(\INPUT_GET, 'id');
		echo "<div id='page-wrapper'>" ;
		echo "<div class='row'>";
		echo "<div class='col-lg-12'>";            
		echo "<h1 class='page-header'>Permisos";
		echo "</h1>";
		echo "</div>";
		echo "</div>";
		echo PermisoPresentacion::modificarPermiso($id);
		echo "</div>";
		echo "</div>";
		break;
    case 'guardarPermiso':
        $id_perfil = filter_input(\INPUT_POST, 'id_perfil');
        $id_modulo = filter_input(\INPUT_POST, 'id_modulo');
        $modulo = filter_input(\INPUT_GET, 'modulo');
		PermisoPresentacion::guardarPermiso('',$id_perfil,$id_modulo,false,false,false);
        header("Location:index.php?modulo=". $modulo ."&accion=inicio");
		break;
    case 'guardarPermisoModificado':
        $id_arr = unserialize(filter_input(INPUT_POST, 'id_arr'));
        $cont = 0;
        $id_perfil = filter_input(INPUT_POST, 'id_perfil');
        $id_modulo = filter_input(INPUT_POST, 'id_modulo');
        foreach($id_arr as $value){
        
        $agregar = (isset($_POST['agregar_' . $id_arr[$cont]])) ? true : false;
        $modificar = (isset($_POST['modificar_' . $id_arr[$cont]])) ? true : false;
        $eliminar = (isset($_POST['eliminar_' . $id_arr[$cont]])) ? true : false;
       
        PermisoPresentacion::guardarPermisoModificado($id_arr[$cont],$id_perfil,$id_modulo,$agregar,$modificar,$eliminar);
        $cont++;
        }
        header("Location:index.php?modulo=". $_GET['modulo'] ."&accion=inicio");
        break;
    case 'eliminarPermiso':
        $id = filter_input(\INPUT_GET, 'id');
		PermisoPresentacion::eliminarPermiso($id);
        header("Location:index.php?modulo=". $_GET['modulo'] ."&accion=inicio&id_perfil=");
		break;
	default:
        $id = (filter_input(\INPUT_POST, 'id_perfil')) ? filter_input(\INPUT_POST, 'id_perfil') : 1;
		echo "<div id='page-wrapper'>" ;
		echo "<div class='row'>";
		echo "<div class='col-lg-12'>";            
		echo "<h1 class='page-header'>Permisos";
		echo "</h1>";
		echo "</div>";
		echo "</div>";
		echo PermisoPresentacion::listadoPermisos($id);
		echo "</div>";
		echo "</div>";
		break;
    }

