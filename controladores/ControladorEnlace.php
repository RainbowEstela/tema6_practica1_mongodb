<?php
    namespace Navidad\controladores;

use Navidad\modelos\ModeloEnlace;
use Navidad\vistas\VistaEnlace;

    class ControladorEnlace {
        public static function mostrarEnlaces($idRegalo) {

            $enlaces = ModeloEnlace::enlacesRegalo($idRegalo);

            VistaEnlace::render($enlaces,$idRegalo);
        }

        public static function mostrarEnlacesAsc($idRegalo) {
            $enlaces = ModeloEnlace::enlacesRegaloAsc($idRegalo);

            VistaEnlace::render($enlaces,$idRegalo,"asc");
        }

        public static function mostrarEnlacesDes($idRegalo) {
            $enlaces = ModeloEnlace::enlacesRegaloDes($idRegalo);

            VistaEnlace::render($enlaces,$idRegalo,"des");
        }

        public static function addEnlace($nombre,$enlace,$precio,$imagen,$prioridad,$idRegalo) {

            $imgPath = "";

            if($imagen == "") {
                //si no se envió nada
            } elseif($imagen["size"] == 0) {
                //si el tamaño es cero porque el archivo es muy grande
            } elseif($imagen["type"] != 'image/jpeg' && $imagen["type"] != 'image/png' && $imagen["type"] != 'image/webp') {
                //si el archivo no es una imagen
            } else {
                $destino = "./Vistas/imgs/". $imagen["name"];
                if(move_uploaded_file($imagen["tmp_name"],$destino)) {
                    $imgPath = $imagen["name"];
                }
            }


            ModeloEnlace::addEnlace($nombre,$enlace,$precio,$imgPath,$prioridad,$idRegalo);

            ControladorEnlace::mostrarEnlaces($idRegalo);

        }

        public static function borrarEnlace($idEnlace,$idRegalo) {
            ModeloEnlace::borrarEnlace($idEnlace);

            ControladorEnlace::mostrarEnlaces($idRegalo);
        }
    }   
?>