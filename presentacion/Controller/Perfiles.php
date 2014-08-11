<?php
require_once PRE . DIRECTORY_SEPARATOR . 'PerfilPresentacion.php';

	switch ($_GET['accion']) {	
	case 'nuevoPerfil':
		echo "<div id='page-wrapper'>" ;
		echo "<div class='row'>";
		echo "<div class='col-lg-12'>";            
		echo "<h1 class='page-header'>Perfiles";
		echo "</h1>";
		echo "</div>";
		echo "</div>";
		echo PerfilPresentacion::nuevoPerfil();
		echo "</div>";
		echo "</div>";
		break;
    case 'modificarPerfil':
		echo "<div id='page-wrapper'>" ;
		echo "<div class='row'>";
		echo "<div class='col-lg-12'>";            
		echo "<h1 class='page-header'>Perfiles";
		echo "</h1>";
		echo "</div>";
		echo "</div>";
		echo PerfilPresentacion::modificarPerfil($_GET['id']);
		echo "</div>";
		echo "</div>";
		break;
    case 'guardarPerfil':
		echo PerfilPresentacion::guardarPerfil('',$_POST['detalle']);
            header("Location:index.php?modulo=". $_GET['modulo'] ."&accion=inicio");
		break;
    case 'guardarPerfilModificado':
		echo PerfilPresentacion::guardarPerfilModificado($_GET['id'],$_POST['detalle']);
            header("Location:index.php?modulo=". $_GET['modulo'] ."&accion=inicio");
		break;
    case 'eliminarPerfil':
		echo PerfilPresentacion::eliminarPerfil($_GET['id']);
            header("Location:index.php?modulo=". $_GET['modulo'] ."&accion=inicio");
		break;
	default:
		echo "<div id='page-wrapper'>" ;
		echo "<div class='row'>";
		echo "<div class='col-lg-12'>";            
		echo "<h1 class='page-header'>Perfiles";
		echo "</h1>";
		echo "</div>";
		echo "</div>";
		echo PerfilPresentacion::listadoPerfiles($_GET['modulo']);
		echo "</div>";
		echo "</div>";
		break;
    }