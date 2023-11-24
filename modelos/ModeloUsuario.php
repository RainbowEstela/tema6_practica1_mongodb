<?php
    namespace Navidad\modelos;
    use Navidad\modelos\ConexionBaseDeDatos;
    use Navidad\modelos\Usuario;
    use \PDO;

    class ModeloUsuario {

        public static function buscarUsuario($nombre) {
            $conexionObjet = new ConexionBaseDeDatos();
            $conexion = $conexionObjet->getConexion();

            $valor = $conexion->usuarios->findOne(["nombre" => $nombre]);

            $usuario = null;

            if(isset($valor["id"])) {
                $usuario = new Usuario($valor["id"],$valor["nombre"],$valor["password"]);
            }


            $conexionObjet->cerrarConexion();

            return $usuario;
        }
    }
?>