<?php
    namespace Navidad\vistas;

    use Navidad\modelos\Regalo;

    class VistaRegalo {
        public static function render($regalos) {
          include("cabecera.php");


          //contenido principal
          echo' <main class="container ">';
          echo '
          <div class="d-flex justify-content-center p-4">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Añadir</button>  
          </div>
          <div class="d-flex justify-content-end">
            <form class="form-inline" style="width:200px;">
              <div class="d-flex nowrap">
                <input class="form-control" type="number" placeholder="Buscar año" aria-label="Search" name="year" min=0 required>
                <button class="btn btn btn-success" type="submit" name="accion" value="regalosPorYear">Buscar</button>
              </div>
            </form> 
          </div>
          ';

          if($regalos == null) {
            echo '
            <h3 class="text-center text-info">Aun no tiene regalos que mostrar</h3>
            </main>
            ';
          } else {

            echo '
              <table class="table table-hover table-striped table-bordered">
                <tr class="table-dark text-center">
                  <th>Nombre</th>
                  <th>Destinatario</th>
                  <th>Precio</th>
                  <th>Estado</th>
                  <th>Año</th>
                  <th>Acciones</th>
                </tr>
            ';
          
            foreach($regalos as $regalo) {

              echo'<tr>';
              echo' <td>'.$regalo->getNombre().'</td>';
              echo' <td>'.$regalo->getDestinatario().'</td>';
              echo' <td>'.$regalo->getPrecio().'</td>';
              echo' <td>'.$regalo->getEstado().'</td>';
              echo' <td>'.$regalo->getYear().'</td>';
              echo' <td class="d-flex justify-content-center">
                <a href="index.php?accion=borrarRegalo&idRegalo='.$regalo->getId().'"><button class="btn btn-danger">x</button></a>
                <a href="index.php?accion=modificarRegaloForm&idRegalo='.$regalo->getId().'" class="px-2"><button class="btn btn-success"><img src="./vistas/imgs/configuracion.png" alt="modificar regalo" width="20px" height="20px"></button></a>
                <a href="index.php?accion=mostrarEnlaces&idRegalo='.$regalo->getId().'"><button class="btn btn-primary">@</button></a>
              </td>
              ';
              echo'</tr>';

            }
  
  
            echo'</table>';

          }

          echo '</main>';
          //fin contenido principal



          //modal
          echo '
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Añadir un nuevo Regalo</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                
                <form action="index.php" method="POST" id="formAddRegalo">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="inputNombre" name="nombre" placeholder="tu nombre" required>
                    <label for="inputNombre">Nombre del regalo</label>
                  </div>

                  <div class="form-floating">
                    <input type="text" class="form-control" id="inputDest" name="destinatario" placeholder="tu nombre" required>
                    <label for="inputDest">Destinatario/a</label>
                  </div>

                  <div class="form-floating">
                    <input type="number" step="any" class="form-control" id="inputPrecio" name="precio" placeholder="tu nombre" min="0" max="9999" required>
                    <label for="inputPrecio">Precio</label>
                  </div>

                  <div class="form-floating">
                    <select class="form-select py-3" name="estado" aria-label="Default select example">
                      <option value="pendiente" selected>Pendiente</option>
                      <option value="comprado">Comprado</option>
                      <option value="envuelto">Envuelto</option>
                      <option value="entregado">Entregado</option>
                    </select>
                  </div>

                  <div class="form-floating">
                    <input type="number" class="form-control" id="inputYear" name="year" placeholder="tu nombre" required>
                    <label for="inputYear">Año</label>
                  </div>

                </form>



                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button class="btn btn-primary" type="submit" name="accion" value="peticionAddRegalo" form="formAddRegalo">Añadir</button>
                </div>
              </div>
            </div>
          </div>
          ';
          //fin modal

          include("pie.php");
        }
    }
?>


