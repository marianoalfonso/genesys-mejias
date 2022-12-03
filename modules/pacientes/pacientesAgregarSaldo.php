
<!-- Modal -->
<div class="modal fade" id="agregarSaldoModal" tabindex="-1" aria-labelledby="agregarSaldoModalLabel" aria-hidden="true">
  <!-- <div class="modal-dialog modal-lg"> --> <!-- modal-lg para que sea mas grande -->
  <div class="modal-dialog"> <!-- modal-lg para que sea mas grande -->
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="agregarSaldoModalLabel">agregar saldo</h1> <!-- header -->
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form action="pacientesGuardarSaldo.php" method="post">


            <div class="mb-3">

                <input type="hidden" name="dni" id="dni" value="<?php echo $_GET['dni']; ?>">

                <label for="importe" class="form-label"></label>
                <input type="number" name="saldo" id="saldo" class="form-control" required>

            </div>

            <!-- botones -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cerrar</button>
                <button type="submit" class="btn btn-primary">guardar</button>  <!-- type="submit" -->
            </div>
        </form>
      </div>
    </div>
  </div>
</div>