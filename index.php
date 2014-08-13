<?php
/* 
 * Copyright (C) 2014 Ariel Montenegro
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
session_start();
require_once 'configuracion.php';
require_once PRE . DIRECTORY_SEPARATOR . 'PanelPresentacion.php';
    if (!isset($_SESSION["perfil"])){
        header("Location:login.php?modulo=login");
        exit;
    }
    $id_perfil = $_SESSION['perfil'];    
?>
<html>
<head>
    <meta charset="ISO8859-1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestion Educativo</title>
    <!-- Core CSS - Include with every page -->
    <link href="presentacion/css/bootstrap.min.css" rel="stylesheet">
    <link href="presentacion/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- SB Admin CSS - Include with every page -->
    <link href="presentacion/css/sb-admin.css" rel="stylesheet">
</head>
<body>
	<div id='wrapper'> 
	<nav class='navbar navbar-default navbar-static-top' role='navigation' style='margin-bottom: 0'>
	<div class='navbar-header'>
	<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.sidebar-collapse'>
	<span class='sr-only'>Toggle navigation</span>
	<span class='icon-bar'></span>
	<span class='icon-bar'></span>
	<span class='icon-bar'></span>
	</button>
	<a class='navbar-brand' href='?modulo=1'>Sistema de Gestion Educativo</a>
    </div>
        <ul class="nav navbar-top-links navbar-right"></ul>
	</nav>
<?php
    
    /*if (!isset($_SESSION["perfil"])){
        header("Location:login.php?modulo=error");
    }else{
        $id_perfil = $_SESSION['perfil'];
        echo PanelPresentacion::mostrarModulos($id_perfil);
    }*/
    echo PanelPresentacion::mostrarModulos($id_perfil);
	abstract class Index
	{
		static public function run($get)
		{
		
			DEBUG ? var_dump($get) : null;
			if(count($get) != 0){
				self::_procesarModulo();
			}else{
				self::_porDefecto();
			}
		}
		static private function _porDefecto()
		{
			header("Location:login.php?modulo=login");
		}
	
		static private function _procesarModulo()
		{
            $modulo = filter_input(\INPUT_GET, 'modulo');
            $controlador = PanelPresentacion::getDetalleModulo($modulo);
            
            if (!isset($controlador)){
                header("Location:login.php?modulo=error");
            }
            
            include PRE . DIRECTORY_SEPARATOR . 'Controller/'. $controlador . '.php';
		}
	}
    //echo var_dump($_GET);
    Index::run($_GET);
?>
    <!-- Core Scripts - Include with every page -->
	 <script src='presentacion/js/jquery-1.10.2.js'></script>
	 <script src='presentacion/js/bootstrap.min.js'></script>
	 <script src='presentacion/js/plugins/metisMenu/jquery.metisMenu.js'></script>
    <!-- SB Admin Scripts - Include with every page -->
    <script src="presentacion/js/sb-admin.js"></script>
</body>
</html>

