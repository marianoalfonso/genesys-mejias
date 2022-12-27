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

    <title>borrado de pacientes</title>

    <!-- <link rel="stylesheet" href="./pacientesDelete.css"> -->
    <link rel="stylesheet" href="pacientes.css">

</head>
<body>
    <!-- <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00FF5573";> -->
    <!-- <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #17a2b8";>
        borrar paciente
    </nav> -->

    <!-- obtenemos los datos del paciente a editar en base al id recibido por parametro -->
    <?php
        session_start();
        $_SESSION['action'] = "delete";
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
            $fec_nac = $result[0]['fec_nac'];
            $cobertura = $result[0]['cobertura'];
            $numero = $result[0]['numero'];
            $telefono = $result[0]['telefono'];
            $direccion = $result[0]['direccion'];
            $profesion = $result[0]['profesion'];
        }
    ?>

    <div class="container modulo">
        <div class="titulo">
            <h5>borrar paciente</h5>
        </div>       
    </div>

    <div class="container header">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <div class="paciente">
                            <h3>paciente: <?php echo $apellido.', '.$nombre; ?></h3>
                        </div>
                        <div class="volver">
                            <h3><a href="pacientes.php" class="btn btn-light" alt="back"><img src="../../assets/icons/back.png">  volver</a></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="container d-flex justify-content-center">
        <form action="pacientesCrud.php" method="post" style="width: 50vw; min-width: 300px;">
            <div id="delete-box" class="col-md-12">
                <div class="row">
                    <!-- id -->
                    <div class="col-md-2">
                        <label class="form-label">id</label>
                        <input type="numeric" class="form-control" name="id" value="<?php echo $id ?>" readonly>
                    </div>
                    <!-- apellido -->
                    <div class="col-md-4">
                        <label class="form-label">apellido</label>
                        <input type="text" class="form-control" name="apellido" value="<?php echo $apellido?>" readonly>
                    </div>
                    <!-- nombre -->
                    <div class="col-md-6">
                        <label class="form-label">nombre</label>
                        <input type="text" class="form-control" name="nombre" value="<?php echo $nombre?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <!-- dni -->
                    <div class="col">
                        <label class="form-label">dni</label>
                        <input type="number" class="form-control" name="dni" value="<?php echo $dni?>" readonly>
                    </div>                
                    <!-- fecha nacimiento -->
                    <div class="col">
                        <label class="form-label">fec.nacimiento</label>
                        <input type="date" class="form-control" name="fec_nac" value="<?php echo $fec_nac?>" readonly>
                    </div>
                </div>

                <div class="row">
                    <!-- cobertura -->
                    <div class="col-md-12">
                        <!-- cargamos el combo con las coberturas -->
                        <label class="form label">cobertura</label>
                        <select name = "cobertura" id="cobertura" class="form-control" disabled>
                            <?php
                                $sql = "select id,nombre from coberturas order by nombre";
                                $p = db::conectar()->prepare($sql);
                                $p->execute();
                                $result = $p->fetchAll(PDO::FETCH_ASSOC);
                                foreach($result as $row){
                                    // verificamos cual es la opcion que traemos desde la base de datos
                                    // para setearla como SELECTED
                                    if($row['id'] == $cobertura){
                                        $selected = 'selected';
                                    } else {
                                        $selected = '';
                                    }
                                    echo '<option value="'.$row["id"].'" '.$selected.'>'.$row["nombre"].'</option>';
                                }
                            ?>
                        </select>
                    </div>

                </div>
                <div class="row">
                    <!-- cobertura numero -->
                    <div class="col-md-6">
                        <label class="form-label">cobertura numero</label>
                        <input type="text" class="form-control" name="numero" value="<?php echo $numero?>" readonly>
                    </div>
                    <!-- telefono -->
                    <div class="col-md-6">
                        <label class="form-label">telefono</label>
                        <input type="text" class="form-control" name="telefono" value="<?php echo $telefono?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <!-- direccion -->
                    <div class="col-md-12">
                        <label class="form-label">direccion</label>
                        <input type="text" class="form-control" name="direccion" value="<?php echo $direccion?>" readonly>
                    </div>
                    <!-- profesion -->
                    <div class="col-md-12">
                        <label class="form-label">profesion</label>
                        <input type="text" class="form-control" name="profesion" value="<?php echo $profesion?>" readonly>
                    </div>
                </div>
                <!-- boton submit -->
                <div>
                    <br>
                    <button type="submit" class="btn btn-warning" name="submit"><img src="../../assets/icons/borrar-usuario.png" />  borrar</button>
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