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

            $regalosData = $conexion->regalos->find(["idUsuario"=>intval($idUsuario)]);

            $regalos = [];

           
            foreach ($regalosData as $regaloInfo) {
                array_push($regalos,new Regalo($regaloInfo["id"],$regaloInfo["nombre"],$regaloInfo["destinatario"],$regaloInfo["precio"],$regaloInfo["estado"],$regaloInfo["year"]));
            }
            

            $conexionObjet->cerrarConexion();

            return $regalos;
        }

        public static function regalosUsuarioYear($idUsuario,$year) {
            $conexionObjet = new ConexionBaseDeDatos();
            $conexion = $conexionObjet->getConexion();


            $resultado = $conexion->regalos->find(["idUsuario"=>intval($idUsuario),"year"=>intval($year)]);

            $regalos = [];

            foreach ($resultado as $regaloInfo) {
                array_push($regalos,new Regalo($regaloInfo["id"],$regaloInfo["nombre"],$regaloInfo["destinatario"],$regaloInfo["precio"],$regaloInfo["estado"],$regaloInfo["year"]));
            } 

            $conexionObjet->cerrarConexion();

            return $regalos;
        }

        /**
         * devuelve el regalo de la misma id
         */
        public static function buscarRegalo($idRegalo) {

            $conexionObjet = new ConexionBaseDeDatos();
            $conexion = $conexionObjet->getConexion();

            $resultado = $conexion->regalos->findOne(["id"=>intval($idRegalo)]);

            $regalo = new Regalo();

            if(isset($resultado["id"])) {
                $regalo->setId($resultado["id"]);
                $regalo->setNombre($resultado["nombre"]);
                $regalo->setDestinatario($resultado["destinatario"]);
                $regalo->setPrecio($resultado["precio"]);
                $regalo->setEstado($resultado["estado"]);
                $regalo->setYear($resultado["year"]);
            }

            $conexionObjet->cerrarConexion();

            return $regalo;

        }


        /**
         * añade un regalo a un usuario
         */
        public static function addRegalo($nombre,$destinatario,$precio,$estado,$year,$idUsuario) {
            $conexionObjet = new ConexionBaseDeDatos();
            $conexion = $conexionObjet->getConexion();

            $regaloMayor = $conexion->regalos->findOne(
                [],
                [
                    'sort' => ['id' => -1]
                ]
            );

            $id = 0;

            if(isset($regaloMayor)) {
                $id = $regaloMayor["id"] + 1;
            }

            $consulta = $conexion->regalos->insertOne([
                'id' => intval($id),
                'nombre' => $nombre,
                'destinatario' => $destinatario,
                'precio' => floatval($precio),
                'estado' => $estado,
                'year' => intval($year),
                'idUsuario' => intval($idUsuario)
            ]);

            $conexionObjet->cerrarConexion();

        }

        /**
         * modifica los datos de un regalo
         */
        public static function modificarRegalo($id,$nombre,$destinatario,$precio,$estado,$year) {
            $conexionObjet = new ConexionBaseDeDatos();
            $conexion = $conexionObjet->getConexion();

            $consulta = $conexion->regalos->updateOne(
                ['id'=>intval($id)],
                [
                    '$set' => [
                        'id' => intval($id),
                        'nombre' => $nombre,
                        'destinatario' => $destinatario,
                        'precio' => floatval($precio),
                        'estado' => $estado,
                        'year' => intval($year)
                    ]
                ]);
            
            $conexionObjet->cerrarConexion();
        }


        public static function borrarRegalo($idRegalo) {
            $conexionObjet = new ConexionBaseDeDatos();
            $conexion = $conexionObjet->getConexion();

            $consulta = $conexion->regalos->deleteOne(['id'=>intval($idRegalo)]);

            $conexionObjet->cerrarConexion();
        }
    }


    
?>