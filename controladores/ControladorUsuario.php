<?php
    namespace Navidad\controladores;

    use Navidad\vistas\VistaLogin;
    use Navidad\modelos\ModeloUsuario;
    use Navidad\modelos\Usuario;

    class ControladorUsuario {
        
        public static function mostrarLogin() {

            VistaLogin::render();

        }

        public static function gestionarLogin($nombre,$password) {

            $loginCorrecto = false;

            $usuario = ModeloUsuario::buscarUsuario($nombre);

            if($usuario != null) {
                
                if(strcmp($usuario->getPassword(),$password)  == 0) {
                    $loginCorrecto = true;
                }

            }

            if($loginCorrecto == true) {
                $_SESSION["id"] = $usuario->getId();
                $_SESSION["nombre"] = $usuario->getNombre();
                ControladorRegalo::mostrarRegalos();
            } else {
                VistaLogin::render("DATOS ERRONEOS");
            }

        }

        public static function cerrarSesion() {

            session_destroy();

            header("Location: index.php");
            die();
        }

    }
?>