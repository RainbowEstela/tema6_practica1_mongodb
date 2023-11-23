<?php
    namespace Navidad;

use Navidad\controladores\ControladorEnlace;
use Navidad\controladores\ControladorRegalo;
use Navidad\controladores\ControladorUsuario;

    //empezar la sesion
    session_start();
    
  
    //Autocargar las clases --------------------------
    spl_autoload_register(function ($class) {
        //echo substr($class, strpos($class,"\\")+1);
        $ruta = substr($class, strpos($class,"\\")+1);
        $ruta = str_replace("\\", "/", $ruta);
        include_once "./" . $ruta . ".php"; 
    });
    //Fin Autcargar --


    


    //enrrutador
    if(isset($_SESSION["id"])) {

        if(isset($_REQUEST)) {
            //gestionar request
            if(isset($_REQUEST["accion"])) {

                if(strcmp($_REQUEST["accion"],"mostrarRegalos") == 0) {

                    //mostrar pagina principal
                    ControladorRegalo::mostrarRegalos($_SESSION["id"]);

                } elseif(strcmp($_REQUEST["accion"],"regalosPorYear") == 0) {

                    //mostrar los regalos del año pasado por el formulario
                    $year = $_REQUEST["year"];

                    ControladorRegalo::mostrarRegalosYear($year);

                } elseif(strcmp($_REQUEST["accion"],"cerrarSesion") == 0) {

                    //cerrar sesion
                    ControladorUsuario::cerrarSesion();

                } elseif(strcmp($_REQUEST["accion"],"peticionAddRegalo") == 0) {

                    //añadir regalo
                    $nombre = $_REQUEST["nombre"];
                    $destinatario = $_REQUEST["destinatario"];
                    $precio = $_REQUEST["precio"];
                    $estado = $_REQUEST["estado"];
                    $year = $_REQUEST["year"];
                    $idUsuario = $_SESSION["id"];

                    ControladorRegalo::addRegalo($nombre,$destinatario,$precio,$estado,$year,$idUsuario);

                } elseif(strcmp($_REQUEST["accion"],"modificarRegaloForm") == 0) {
                    //mostrar formulario de modificacion de un regalo
                    $idRegalo = $_REQUEST["idRegalo"];

                    ControladorRegalo::modificarRegaloForm($idRegalo);

                } elseif(strcmp($_REQUEST["accion"],"modificarRegalo") == 0) {

                    //datos del regalo a modificar
                    $id = $_REQUEST["id"];
                    $nombre = $_REQUEST["nombre"];
                    $destinatario = $_REQUEST["destinatario"];
                    $precio = $_REQUEST["precio"];
                    $estado = $_REQUEST["estado"];
                    $year = $_REQUEST["year"];

                    ControladorRegalo::modificarRegalo($id,$nombre,$destinatario,$precio,$estado,$year);

                } elseif(strcmp($_REQUEST["accion"],"borrarRegalo") == 0) {
                    //borrar regalo
                    $idRegalo = $_REQUEST["idRegalo"];

                    ControladorRegalo::borrarRegalo($idRegalo);

                } elseif(strcmp($_REQUEST["accion"],"mostrarEnlaces") == 0) {
                    
                    //mostrar enlaces de un regalo
                    $idRegalo = $_REQUEST["idRegalo"];

                    ControladorEnlace::mostrarEnlaces($idRegalo);

                } elseif(strcmp($_REQUEST["accion"],"enlacesAsc") == 0) {

                    //mostrar enlaces de un regalo de forma ascendente por precio
                    $idRegalo = $_REQUEST["idRegalo"];

                    ControladorEnlace::mostrarEnlacesAsc($idRegalo);

                } elseif(strcmp($_REQUEST["accion"],"enlacesDes") == 0) {
                    //mostrar enlaces de un regalo de forma descendente por precio
                    $idRegalo = $_REQUEST["idRegalo"];

                    ControladorEnlace::mostrarEnlacesDes($idRegalo);
                
                } elseif(strcmp($_REQUEST["accion"],"peticionAddEnlace") == 0) {

                    $nombre = $_REQUEST["nombre"];
                    $enlace = $_REQUEST["enlace"];
                    $precio = $_REQUEST["precio"];
                    $imagen = "";
                    //comprobar si se mandó imagen
                    if(isset($_FILES["imagen"])) {
                        $imagen = $_FILES["imagen"];
                    }

                    
                    $prioridad = $_REQUEST["prioridad"];
                    $idRegalo = $_REQUEST["idRegalo"];

                    //añadir el nuevo enlace
                    ControladorEnlace::addEnlace($nombre,$enlace,$precio,$imagen,$prioridad,$idRegalo);
                    
                } elseif(strcmp($_REQUEST["accion"],"borrarEnlace") == 0) {

                    $idEnlace = $_REQUEST["idEnlace"];
                    $idRegalo = $_REQUEST["idRegalo"];

                    ControladorEnlace::borrarEnlace($idEnlace,$idRegalo);

                } else {

                    //si no es ninguna accion le mostramos la pagina principal
                    ControladorRegalo::mostrarRegalos($_SESSION["id"]);

                }
    
            } else {
                
                //si no llega una accion pero esta logeado mostramos la pagina principal
                ControladorRegalo::mostrarRegalos($_SESSION["id"]);
                
            }
            
        }

    } else {
        

        if(isset($_REQUEST["accion"])) {
    
            //accion peticionLogin
            if(strcmp($_REQUEST["accion"],"peticionLogin") == 0) {

                $nombre = $_REQUEST["nombre"];
                $password = $_REQUEST["password"];

                ControladorUsuario::gestionarLogin($nombre,$password);
            } else {
                //enviar a logearse
                ControladorUsuario::mostrarLogin();
            }
        } else {
            //enviar a logearse
            ControladorUsuario::mostrarLogin();
        }

        
    }

?>