<?php
    namespace Navidad\modelos;

    use Navidad\modelos\ConexionBaseDeDatos;
    use Navidad\modelos\Regalo;
    use \PDO;

    class ModeloRegalo {

        /**
         * devuelve todos los regalos de un usuario
         */
        public static function regalosUsuario($idUsuario) {
            $conexionObjet = new ConexionBaseDeDatos();
            $conexion = $conexionObjet->getConexion();

            $consulta = $conexion->prepare("SELECT id,nombre,destinatario,precio,estado,year FROM regalos WHERE idUsuario = ?");
            $consulta->bindValue(1,$idUsuario);

            $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Navidad\modelos\Regalo');
            $consulta->execute();

            $regalos = $consulta->fetchAll();

            $conexionObjet->cerrarConexion();

            return $regalos;
        }

        public static function regalosUsuarioYear($idUsuario,$year) {
            $conexionObjet = new ConexionBaseDeDatos();
            $conexion = $conexionObjet->getConexion();

            $consulta = $conexion->prepare("SELECT id,nombre,destinatario,precio,estado,year FROM regalos WHERE idUsuario = ? AND regalos.year = ?");
            $consulta->bindValue(1,$idUsuario);
            $consulta->bindValue(2,$year);

            $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Navidad\modelos\Regalo');
            $consulta->execute();

            $regalos = $consulta->fetchAll();

            $conexionObjet->cerrarConexion();

            return $regalos;
        }

        /**
         * devuelve el regalo de la misma id
         */
        public static function buscarRegalo($idRegalo) {

            $conexionObjet = new ConexionBaseDeDatos();
            $conexion = $conexionObjet->getConexion();

            $consulta = $conexion->prepare("SELECT id,nombre,destinatario,precio,estado,year FROM regalos WHERE id = ?");
            $consulta->bindValue(1,$idRegalo);

            $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Navidad\modelos\Regalo');
            $consulta->execute();

            $regalo = $consulta->fetch();

            $conexionObjet->cerrarConexion();

            return $regalo;

        }


        /**
         * añade un regalo a un usuario
         */
        public static function addRegalo($nombre,$destinatario,$precio,$estado,$year,$idUsuario) {
            $conexionObjet = new ConexionBaseDeDatos();
            $conexion = $conexionObjet->getConexion();

            $consulta = $conexion->prepare("INSERT INTO `navidad`.`regalos` (`nombre`, `destinatario`, `precio`, `estado`, `year`, `idUsuario`) VALUES (?, ?, ?, ?, ?, ?);");

            //bindeo de parametros
            $consulta->bindValue(1,$nombre);
            $consulta->bindValue(2,$destinatario);
            $consulta->bindValue(3,$precio);
            $consulta->bindValue(4,$estado);
            $consulta->bindValue(5,$year);
            $consulta->bindValue(6,$idUsuario);

            $consulta->execute();
            $conexionObjet->cerrarConexion();

        }

        /**
         * modifica los datos de un regalo
         */
        public static function modificarRegalo($id,$nombre,$destinatario,$precio,$estado,$year) {
            $conexionObjet = new ConexionBaseDeDatos();
            $conexion = $conexionObjet->getConexion();

            $consulta = $conexion->prepare("UPDATE regalos SET nombre = ?, destinatario = ?, precio = ?, estado = ?, year = ? WHERE id = ?");

            //bindeo de parametros
            $consulta->bindValue(1,$nombre);
            $consulta->bindValue(2,$destinatario);
            $consulta->bindValue(3,$precio);
            $consulta->bindValue(4,$estado);
            $consulta->bindValue(5,$year);
            $consulta->bindValue(6,$id);

            $consulta->execute();
            $conexionObjet->cerrarConexion();
        }


        public static function borrarRegalo($idRegalo) {
            $conexionObjet = new ConexionBaseDeDatos();
            $conexion = $conexionObjet->getConexion();

            $consulta = $conexion->prepare("DELETE FROM regalos WHERE id = ?");

            $consulta->bindValue(1,$idRegalo);

            $consulta->execute();
            $conexionObjet->cerrarConexion();
        }
    }


    
?>