<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- bootstrap -->
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"> -->

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>edicion de pacientes</title>

    <link rel="stylesheet" href="./pacientesEdit.css">

</head>
<body>
    <!-- <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00FF5573";> -->
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #17a2b8";>
        cambiar dni del paciente
    </nav>

    <!-- obtenemos los datos del paciente a editar en base al id recibido por parametro -->
    <?php
        session_start();
        $_SESSION['action'] = "edit";
        require_once('../db/dbConnection.php');

        $id = $_GET['id'];
        $sql = "select * from pacientes where id = $id limit 1";
        $p = db::conectar()->prepare($sql);
        $p->execute();
        $result = $p->fetchAll(PDO::FETCH_ASSOC);
        // si por algun motivo no recupera el registro, vuelve a la pagina de pacientes
        if(!$result){
            header ("Location: ./pacientes.php");
        } else {
            $apellido = $result[0]['apellido'];
            $nombre = $result[0]['nombre'];
            $dni = $result[0]['dni'];
        }
    ?>

    <div class="container d-flex justify-content-center">
        <form action="pacientesCrud.php" method="post" style="width: 50vw; min-width: 300px;">
            <div id="edit-box" class="col-md-12">
                <div class="row">
                    <!-- id -->
                    <div class="col-md-2">
                        <label class="form-label">id</label>
                        <input type="numeric" class="form-control" name="id" value="<?php echo $id ?>" readonly>
                    </div>
                    <!-- apellido -->
                    <div class="col-md-4">
                        <label class="form-label">apellido</label>
                        <input type="text" class="form-control" name="apellido" value="<?php echo $apellido?>">
                    </div>
                    <!-- nombre -->
                    <div class="col-md-6">
                        <label class="form-label">nombre</label>
                        <input type="text" class="form-control" name="nombre" value="<?php echo $nombre?>">
                    </div>
                </div>
                <div class="row">
                    <!-- dni -->
                    <div class="col">
                        <label class="form-label">dni</label>
                        <input type="number" class="form-control" name="dni" value="<?php echo $dni?>">
                    </div>                
                    <!-- fecha nacimiento -->
                    <div class="col">
                        <label class="form-label">nuevo dni</label>
                        <input type="number" class="form-control" name="nuevo_dni" value="">
                    </div>
                </div>




                <!-- boton submit -->
                <div>
                    <br>
                    <button type="submit" class="btn btn-warning" name="submit"><img src="../../assets/icons/editar.png" />  modificar</button>
                    <a href="pacientes.php" class="btn btn-danger"><img src="../../assets/icons/borrar.png" />  cancelar</a>
                </div>
            </div>
        </form>
    </div>

    <!-- bootstrap -->
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- <script src="assets/bootstrap/js/bootstrap.min.js"></script> -->
</body>
</html>