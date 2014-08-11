<?php
session_start();
require_once 'configuracion.php';
require_once PRE . DIRECTORY_SEPARATOR . 'UsuarioPresentacion.php';
require_once PRE . DIRECTORY_SEPARATOR . 'PanelPresentacion.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="latin1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gesti&oacuten Educativo</title>
    <link href="presentacion/css/bootstrap.min.css" rel="stylesheet">
    <link href="presentacion/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="presentacion/css/sb-admin.css" rel="stylesheet">
</head>
<body>
<?php
abstract class Index
{
    const SIN_PARAMETROS = 0;
    
    static public function run($get)
    {
        DEBUG ? var_dump($get) : null;

        if(count($get) != self::SIN_PARAMETROS){

            self::_procesarModulo();

        }else{
            self::_porDefecto();
        }
    }
    static private function _porDefecto()
    {
        header("Location:index.php?modulo=login");
    }
    static private function _moduloNoExiste()
    {
        echo 'Modulo no Existe';
    }
    static private function _procesarModulo()
    {
        switch ($_GET['modulo']) {
            case 'login':
                echo UsuarioPresentacion::mostrarFormLogin();
                break;   
                     
            case 'acceso':
            //echo $_POST['user'] . " " . $_POST['pass'];
                $result = UsuarioPresentacion::autenticarUsuario($_POST['user'], $_POST['pass']);        
                     
                if (mysqli_num_rows($result) > 0){                
                    $user = $result->fetch_assoc();                
                    $_SESSION['perfil'] = $user['perfil']; //sesion de usuario                 
                    //echo $user['perfil'];
                    //break;
                    header("Location:index.php?modulo=panel");
                }
                else{
                    header("Location:index.php?modulo=error");
                }
                
                break;  
            case 'panel':
                 if (!isset($_SESSION["perfil"])){
                     header("Location:index.php?modulo=error");
                 }else {
                     $id_perfil = $_SESSION['perfil'];  			     
			         echo PanelPresentacion::mostrarPanel($id_perfil);
			     }
            	 break;    
            case 'error':
               echo UsuarioPresentacion::errorAcceso();
               break;
            default:
               self::_moduloNoExiste();
               break;
        }
    }
}

Index::run($_GET);
?>

    <!-- Core Scripts - Include with every page -->
    <script src="presentacion/js/jquery-1.10.2.js"></script>
    <script src="presentacion/js/bootstrap.min.js"></script>
    <script src="presentacion/js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="presentacion/js/sb-admin.js"></script>

</body>

</html>

