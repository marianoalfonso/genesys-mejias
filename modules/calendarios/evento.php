<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
      <!-- formulario de eventos -->
      <div class="modal fade" id="formularioEventos" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <!-- cabecera -->
              <div class="modal-header">

                <button type="button" class="close" data-bs-dismiss="modal" aria-label="close">
                  <span aria-hidden="true">x</span>
                </button>

              </div>
              <!-- cuerpo -->
              <div class="modal-body">
                <input type="hidden" id="id">
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="">seleccione paciente</label>
                    <!-- <input type="text" id="titulo" class="form-control" placeholder=""> -->

                    <!-- cargamos el combo con las personas -->
                    <select id="titulo" class="form-control">
                        <?php
                          require_once("../db/dbConnection.php");
                          $sql = "select dni,apellido,nombre from pacientes order by apellido,nombre";
                          $p = db::conectar()->prepare($sql);
                          $p->execute();
                          $datos = $p->fetchAll(PDO::FETCH_ASSOC);
                          foreach($datos as $row){
                            echo '<option value="'.$row["dni"].'">'.$row["apellido"]." ".$row["nombre"].'</option>';
                          }
                        ?>
                    </select>

                  </div>
                </div>
                <div class="form-row">
                  <!-- fecha inicio -->
                  <div class="form-group col-md-6">
                    <label for="">fecha de inicio:</label>
                    <div class="input-group" data-autoclose="true">
                      <input type="date" id="fechaInicio" class="form-control" value="">
                    </div>
                  </div>
                  <!-- hora inicio -->
                  <div class="form-group col-md-6" id="tituloHoraInicio">
                    <label for="">hora de inicio</label>
                    <div class="input-group clockpicker" data-autoclose="true">
                      <input type="text" id="horaInicio" class="form-control" autocomplete="off">
                    </div>
                  </div>
                </div>

                <div class="form-row">
                  <!-- fecha fin -->
                  <div class="form-group col-md-6">
                    <label for="">fecha de fin:</label>
                    <div class="input-group" data-autoclose="true">
                      <input type="date" id="fechaFin" class="form-control" value="">
                    </div>
                  </div>
                  <!-- hora fin -->
                  <div class="form-group col-md-6" id="tituloHoraFin">
                    <label for="">hora de fin</label>
                    <div class="input-group clockpicker" data-autoclose="true">
                      <input type="text" id="horaFin" class="form-control" autocomplete="off">
                    </div>
                  </div>
                </div>
                <!-- descripcion -->
                <div class="form-row">
                  <label for="">descripcion</label>
                  <textarea id="descripcion" class="form-control" rows="3"></textarea>
                </div>
                <!-- color de fondo -->
                <div class="form-row">
                  <label for="">color fondo</label>
                  <input type="color" value="#3788D8" id="colorFondo" class="form-control" style="height:36px;">
                </div>
                <!-- color de texto -->
                <div class="form-row">
                  <label for="">color texto</label>
                  <input type="color" value="#FFFFFF" id="colorTexto" class="form-control" style="height:36px;">
                </div>

              </div>

              <div class="modal-footer">
                <button type="button" id="botonAgregar" class="btn btn-success">agregar</button>
                <!-- <button type="button" id="botonModificar" class="btn btn-success">modificar</button> -->
                <!-- <button type="button" id="botonBorrar" class="btn btn-success">borrar</button> -->
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">cancelar</button>
              </div>

            </div>
          </div>
        </div>


</body>
</html>