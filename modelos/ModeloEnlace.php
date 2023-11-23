<?php
    namespace Navidad\modelos;

    use Navidad\modelos\ConexionBaseDeDatos;
    use \PDO;
    use Navidad\modelos\Enlace;

    class ModeloEnlace {
        public static function enlacesRegalo($idRegalo) {
            $conexionObjet = new ConexionBaseDeDatos();
            $conexion = $conexionObjet->getConexion();

            $consulta = $conexion->prepare("SELECT id,nombre,enlace,precio,imagen,prioridad FROM enlaces WHERE idRegalo = ?");
            $consulta->bindValue(1,$idRegalo);

            $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Navidad\modelos\Enlace');
            $consulta->execute();

            $enlaces = $consulta->fetchAll();

            $conexionObjet->cerrarConexion();

            return $enlaces;
        }

        public static function enlacesRegaloAsc($idRegalo) {
            $conexionObjet = new ConexionBaseDeDatos();
            $conexion = $conexionObjet->getConexion();

            $consulta = $conexion->prepare("SELECT id,nombre,enlace,precio,imagen,prioridad FROM enlaces WHERE idRegalo = ? ORDER BY precio ASC");
            $consulta->bindValue(1,$idRegalo);

            $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Navidad\modelos\Enlace');
            $consulta->execute();

            $enlaces = $consulta->fetchAll();

            $conexionObjet->cerrarConexion();

            return $enlaces;

        }

        public static function enlacesRegaloDes($idRegalo) {
            $conexionObjet = new ConexionBaseDeDatos();
            $conexion = $conexionObjet->getConexion();

            $consulta = $conexion->prepare("SELECT id,nombre,enlace,precio,imagen,prioridad FROM enlaces WHERE idRegalo = ? ORDER BY precio DESC");
            $consulta->bindValue(1,$idRegalo);

            $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Navidad\modelos\Enlace');
            $consulta->execute();

            $enlaces = $consulta->fetchAll();

            $conexionObjet->cerrarConexion();

            return $enlaces;

        }


        public static function addEnlace($nombre,$enlace,$precio,$imagen,$prioridad,$idRegalo) {
            $conexionObjet = new ConexionBaseDeDatos();
            $conexion = $conexionObjet->getConexion();

            $consulta = $conexion->prepare("INSERT INTO `navidad`.`enlaces` (`nombre`, `enlace`, `precio`, `imagen`, `prioridad`, `idRegalo`) VALUES (?, ?, ?, ?, ?, ?);");

            //bindeo de parametros
            $consulta->bindValue(1,$nombre);
            $consulta->bindValue(2,$enlace);
            $consulta->bindValue(3,$precio);
            $consulta->bindValue(4,$imagen);
            $consulta->bindValue(5,$prioridad);
            $consulta->bindValue(6,$idRegalo);

            $consulta->execute();
            $conexionObjet->cerrarConexion();

        }

        public static function borrarEnlace($idEnlace) {
            $conexionObjet = new ConexionBaseDeDatos();
            $conexion = $conexionObjet->getConexion();

            $consulta = $conexion->prepare("DELETE FROM enlaces WHERE id = ?");

            $consulta->bindValue(1,$idEnlace);

            $consulta->execute();
            $conexionObjet->cerrarConexion();
        }
    }
?>