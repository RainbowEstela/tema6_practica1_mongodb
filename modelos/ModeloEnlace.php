<?php
    namespace Navidad\modelos;

    use Navidad\modelos\ConexionBaseDeDatos;
    use \PDO;
    use Navidad\modelos\Enlace;

    class ModeloEnlace {
        public static function enlacesRegalo($idRegalo) {
            $conexionObjet = new ConexionBaseDeDatos();
            $conexion = $conexionObjet->getConexion();

            $enlacesData = $conexion->enlaces->find(["idRegalo" => intval($idRegalo)]);

            $enlaces=[];

            foreach($enlacesData as $data) {
                array_push($enlaces, new Enlace($data["id"],$data["nombre"],$data["enlace"],$data["precio"],$data["imagen"],$data["prioridad"]));
            }

            $conexionObjet->cerrarConexion();

            return $enlaces;
        }

        

        public static function enlacesRegaloAsc($idRegalo) {
            $conexionObjet = new ConexionBaseDeDatos();
            $conexion = $conexionObjet->getConexion();

            $enlacesData = $conexion->enlaces->find(["idRegalo" => intval($idRegalo)],
            [
                'sort' => ['precio' => 1]
            ]);

            $enlaces=[];

            foreach($enlacesData as $data) {
                array_push($enlaces, new Enlace($data["id"],$data["nombre"],$data["enlace"],$data["precio"],$data["imagen"],$data["prioridad"]));
            }

            $conexionObjet->cerrarConexion();

            return $enlaces;

        }

        public static function enlacesRegaloDes($idRegalo) {
            $conexionObjet = new ConexionBaseDeDatos();
            $conexion = $conexionObjet->getConexion();

            $enlacesData = $conexion->enlaces->find(["idRegalo" => intval($idRegalo)],
            [
                'sort' => ['precio' => -1]
            ]);

            $enlaces=[];

            foreach($enlacesData as $data) {
                array_push($enlaces, new Enlace($data["id"],$data["nombre"],$data["enlace"],$data["precio"],$data["imagen"],$data["prioridad"]));
            }

            $conexionObjet->cerrarConexion();

            return $enlaces;

        }


        public static function addEnlace($nombre,$enlace,$precio,$imagen,$prioridad,$idRegalo) {
            $conexionObjet = new ConexionBaseDeDatos();
            $conexion = $conexionObjet->getConexion();

            $enlaceMayor = $conexion->enlaces->findOne(
                [],
                [
                    'sort' => ['id' => -1]
                ]
            );

            $id = 0;

            if(isset($enlaceMayor)) {
                $id = $enlaceMayor["id"] + 1;
            }

            $consulta = $conexion->enlaces->insertOne([
                'id' => intval($id),
                'nombre' => $nombre,
                'enlace' => $enlace,
                'precio' => floatval($precio),
                'imagen' => $imagen,
                'prioridad' => intval($prioridad),
                'idRegalo' => intval($idRegalo)
            ]);
            $conexionObjet->cerrarConexion();

        }

        public static function borrarEnlace($idEnlace) {
            $conexionObjet = new ConexionBaseDeDatos();
            $conexion = $conexionObjet->getConexion();

            $consulta = $conexion->enlaces->deleteOne(['id'=>intval($idEnlace)]);

            $conexionObjet->cerrarConexion();
        }
    }
?>