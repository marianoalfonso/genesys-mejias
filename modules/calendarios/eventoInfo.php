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
      <div class="modal fade" id="informacionEvento" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <!-- cabecera -->
              <div class="modal-header">

              </div>
              <!-- cuerpo -->
              <div class="modal-body">
                <input type="hidden" id="id">
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="">seleccione paciente</label>
                    <input type="text" id="infoTitulo" class="form-control" placeholder="paciente">
                  </div>
                </div>
                <div class="form-row">
                  <!-- fecha inicio -->
                  <div class="form-group col-md-6">
                    <label for="">fecha de inicio:</label>
                    <div class="input-group" data-autoclose="true">
                      <input type="date" id="infoFechaInicio" class="form-control" value="">
                    </div>
                  </div>
                  <!-- hora inicio -->
                  <div class="form-group col-md-6" id="tituloHoraInicio">
                    <label for="">hora de inicio</label>
                    <div class="input-group clockpicker" data-autoclose="true">
                      <input type="text" id="infoHoraInicio" class="form-control" autocomplete="off">
                    </div>
                  </div>
                </div>

                <div class="form-row">
                  <!-- fecha fin -->
                  <div class="form-group col-md-6">
                    <label for="">fecha de fin:</label>
                    <div class="input-group" data-autoclose="true">
                      <input type="date" id="infoFechaFin" class="form-control" value="">
                    </div>
                  </div>
                  <!-- hora fin -->
                  <div class="form-group col-md-6" id="tituloHoraFin">
                    <label for="">hora de fin</label>
                    <div class="input-group clockpicker" data-autoclose="true">
                      <input type="text" id="infoHoraFin" class="form-control" autocomplete="off">
                    </div>
                  </div>
                </div>
                <!-- descripcion -->
                <div class="form-row">
                  <label for="">descripcion</label>
                  <textarea id="infoDescripcion" class="form-control" rows="3"></textarea>
                </div>
                <!-- color de fondo -->
                <div class="form-row">
                  <label for="">color fondo</label>
                  <input type="color" value="#3788D8" id="infoColorFondo" class="form-control" style="height:36px;">
                </div>
                <!-- color de texto -->
                <div class="form-row">
                  <label for="">color texto</label>
                  <input type="color" value="#FFFFFF" id="infoColorTexto" class="form-control" style="height:36px;">
                </div>

              </div>

              <div class="modal-footer">
                <button type="button" id="infoBotonBorrar" class="btn btn-success">borrar</button>
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">cancelar</button>
              </div>

            </div>
          </div>
        </div>


</body>
</html>