<?php

    namespace Navidad\vistas;

    use Navidad\modelos\Regalo;

    class VistaModificarRegaloForm {

        public static function render(Regalo $regalo) {

            include("cabecera.php");


            echo '
            <form action="index.php" method="POST" class="w-50 mx-auto my-5">
                <div>
                    <h3 class="text-center text-primary">Modificar Regalo</h3>
                </div>

                <input type="hidden" name="id" value="'.$regalo->getId().'">

                <div class="form-floating">
                    <input type="text" class="form-control" id="inputNombre" name="nombre" placeholder="tu nombre" value="'.$regalo->getNombre().'" required>
                    <label for="inputNombre">Nombre del regalo</label>
                </div>

                <div class="form-floating">
                    <input type="text" class="form-control" id="inputDest" name="destinatario" placeholder="tu nombre" value="'.$regalo->getDestinatario().'" required>
                    <label for="inputDest">Destinatario/a</label>
                </div>

                <div class="form-floating">
                    <input type="number" step="any" class="form-control" id="inputPrecio" name="precio" placeholder="tu nombre" min="0" max="9999" value="'.$regalo->getPrecio().'" required>
                    <label for="inputPrecio">Precio</label>
                </div>

                
                <div class="form-floating">
                    <select class="form-select py-3" name="estado" aria-label="Default select example">
                ';

            $opciones = [
                [
                    "value" => "pendiente",
                    "name" => "Pendiente"
                ],

                [
                    "value" => "comprado",
                    "name" => "Comprado"
                ],

                [
                    "value" => "envuelto",
                    "name" => "Envuelto"
                ],

                [
                    "value" => "entregado",
                    "name" => "Entregado"
                ]
            ];

            
            foreach($opciones as $opcion) {
                if(strcmp($opcion["value"],$regalo->getEstado()) == 0) {
                    echo '<option value="'.$opcion["value"].'" selected>'.$opcion["name"].'</option>';
                } else {
                    echo '<option value="'.$opcion["value"].'">'.$opcion["name"].'</option>';
                }
            }
            
            echo'

                    </select>
                </div>
                <div class="form-floating">
                    <input type="number" class="form-control" id="inputYear" name="year" placeholder="tu nombre" value="'.$regalo->getYear().'" required>
                    <label for="inputYear">Año</label>
                </div>

                <div class="form-floating d-flex justify-content-center my-3">
                    <input type="submit" name="accion" value="modificarRegalo" class="btn btn-primary">
                </div>
            </form>
            
            ';

            include("pie.php");

        }
    }

?>

