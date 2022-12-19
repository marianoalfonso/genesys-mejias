<?php
    require_once('../db/dbConnection.php');
    require_once('../../assets/functions/date.php');

    session_start();
    $_SESSION['action'] = "add";
?>

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

    <title>alta de pacientes</title>
    <link rel="stylesheet" href="./pacientesAdd.css">

</head>
<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00FF5573";>
        alta de pacientes
    </nav>



    <div class="container d-flex justify-content-center">
        <form action="pacientesCrud.php" method="post" style="width: 50vw; min-width: 300px;">
            <div id="add-box" class="col-md-12">
                <div class="row">

                    <!-- apellido -->
                    <div class="col-md-4">
                        <label class="form-label">apellido</label>
                        <input type="text" class="form-control" name="apellido" id="apellido">
                    </div>
                    <!-- nombre -->
                    <div class="col-md-8">
                        <label class="form-label">nombre</label>
                        <input type="text" class="form-control" name="nombre">
                    </div>
                </div>
                <div class="row">
                    <!-- dni -->
                    <div class="col">
                        <label class="form-label">dni</label>
                        <input type="number" class="form-control" name="dni" value="<?php echo obtenerProximoDni(); ?>">
                        
                    </div>                
                    <!-- fecha nacimiento -->
                    <?php $dt = new DateTime(); ?>
                    <div class="col">
                        <label class="form-label">fec.nacimiento</label>
                        <input type="date" class="form-control" name="fec_nac" value="<?php echo $dt->format('Y-m-d') ?>">
                    </div>
                </div>

                <div class="row">
                    <!-- cobertura -->
                    <div class="col-md-12">
                        <!-- cargamos el combo con las coberturas -->
                        <label class="form label">cobertura</label>
                        <select name = "cobertura" id="cobertura" class="form-control">
                            <?php
                                $sql = "select id,nombre from coberturas order by nombre";
                                $p = db::conectar()->prepare($sql);
                                $p->execute();
                                $result = $p->fetchAll(PDO::FETCH_ASSOC);
                                foreach($result as $row){
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
                        <input type="text" class="form-control" name="numero" >
                    </div>
                    <!-- telefono -->
                    <div class="col-md-6">
                        <label class="form-label">telefono</label>
                        <input type="text" class="form-control" name="telefono" >
                    </div>
                </div>
                <div class="row">
                    <!-- direccion -->
                    <div class="col-md-12">
                        <label class="form-label">direccion</label>
                        <input type="text" class="form-control" name="direccion" >
                    </div>
                    <!-- profesion -->
                    <div class="col-md-12">
                        <label class="form-label">profesion</label>
                        <input type="text" class="form-control" name="profesion" >
                    </div>
                </div>
                <!-- boton submit -->
                <div>
                    <br>
                    <button type="submit" onclick = "return enviarFormulario();" class="btn btn-warning" name="submit"><img src="../../assets/icons/agregar-usuario.png" />  guardar</button>
                    <a href="./pacientes.php" class="btn btn-danger"><img src="../../assets/icons/borrar.png" />  cancelar</a>
                </div>
                
            </div>
        </form>

        <div id="error"></div>

    </div>

    <script src="./pacientesAdd.js"></script>
    <!-- bootstrap -->
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- <script src="assets/bootstrap/js/bootstrap.min.js"></script> -->
</body>
</html>