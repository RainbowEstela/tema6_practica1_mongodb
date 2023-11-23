<?php
    namespace Navidad\modelos;
    use Navidad\modelos\ConexionBaseDeDatos;
    use Navidad\modelos\Usuario;
    use \PDO;

    class ModeloUsuario {

        public static function buscarUsuario($nombre) {
            $conexionObjet = new ConexionBaseDeDatos();
            $conexion = $conexionObjet->getConexion();

            $consulta = $conexion->prepare("SELECT * FROM usuarios WHERE nombre LIKE ?");
            $consulta->bindValue(1,$nombre);

            $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Navidad\modelos\Usuario');
            $consulta->execute();

            $usuario = $consulta->fetch();

            $conexionObjet->cerrarConexion();

            return $usuario;
        }
    }
?>