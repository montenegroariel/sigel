<?php
session_start();
require_once 'configuracion.php';
require_once PRE . DIRECTORY_SEPARATOR . 'UsuarioPresentacion.php';
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
    abstract class Login
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
            header('Location:login.php?modulo=login');
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
                    if (count($result[0])){
                        $_SESSION['perfil'] = $result[0]['id_perfil']; //sesion de usuario                 
                        header("Location:index.php?modulo=1");
                    }
                    else{
                        header('Location:login.php?modulo=error');
                    }
                    break;
                case 'registro':
                    echo UsuarioPresentacion::mostrarFormRegistro();
                    break;
                case 'guardarRegistro':
                    $nombre = filter_input(INPUT_POST, 'nombre');
                    $apellido = filter_input(INPUT_POST, 'apellido');
                    $dni = filter_input(INPUT_POST, 'dni');
                    $direccion = filter_input(INPUT_POST, 'direccion');
                    $telefono = filter_input(INPUT_POST, 'telefono');
                    $mail = filter_input(INPUT_POST, 'mail');
                    $pass = filter_input(INPUT_POST, 'pass');
                    UsuarioPresentacion::guardarRegistro($nombre,$apellido,$dni,$direccion,$telefono,$mail,md5($pass));
                    header("Location:login.php?modulo=login");
                    break;
                case 'error':
                   echo UsuarioPresentacion::errorAcceso();
                   break;
                default:
                   header('Location:login.php?modulo=login');
                   break;
            }
        }
    }

    Login::run($_GET);
?>   
    <!-- Core Scripts - Include with every page -->
    <script src="presentacion/js/jquery-1.10.2.js"></script>
    <script src="presentacion/js/bootstrap.min.js"></script>
    <script src="presentacion/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <!-- SB Admin Scripts - Include with every page -->
    <script src="presentacion/js/sb-admin.js"></script>
</body>
</html>
