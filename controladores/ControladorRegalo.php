<?php
    namespace Navidad\controladores;

use Navidad\modelos\ModeloRegalo;
use Navidad\modelos\Regalo;
use Navidad\vistas\VistaModificarRegaloForm;
use Navidad\vistas\VistaRegalo;

    class ControladorRegalo {

        /**
         * Muestra todos los regalos del usaurio en la sesion
         */
        public static function mostrarRegalos() {
            $regalos = ModeloRegalo::regalosUsuario($_SESSION["id"]);
            VistaRegalo::render($regalos);
        }

        public static function mostrarRegalosYear($year) {
            $regalos = ModeloRegalo::regalosUsuarioYear($_SESSION["id"],$year);
            VistaRegalo::render($regalos);
        }

        /**
         * crea un regalo en bd con los parametros pasados
         */
        public static function addRegalo($nombre,$destinatario,$precio,$estado,$year,$idUsuario) {

            ModeloRegalo::addRegalo($nombre,$destinatario,$precio,$estado,$year,$idUsuario);

            ControladorRegalo::mostrarRegalos();
        }

        /**
         * muestra el formulario de modificar regalo con la informacion del mismo
         */
        public static function modificarRegaloForm($idRegalo) {

            $regalo = ModeloRegalo::buscarRegalo($idRegalo);

            VistaModificarRegaloForm::render($regalo);

        }

        /**
         * modifica un regalo y muestra todos los regalos
         */
        public static function modificarRegalo($id,$nombre,$destinatario,$precio,$estado,$year) {

            ModeloRegalo::modificarRegalo($id,$nombre,$destinatario,$precio,$estado,$year);

            ControladorRegalo::mostrarRegalos();

        }

        public static function borrarRegalo($idRegalo) {

            ModeloRegalo::borrarRegalo($idRegalo);

            ControladorRegalo::mostrarRegalos();
        }


    }



?>