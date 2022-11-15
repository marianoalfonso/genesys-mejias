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

    <title>alta de personas</title>
</head>
<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00FF5573";>
        editar paciente
    </nav>

    <!-- obtenemos los datos del paciente a editar en base al id recibido por parametro -->
    <?php
        session_start();
        $_SESSION['action'] = "edit";
        require_once('../db/connDB.php');
        $conexion = regresarConexion();

        $id = $_GET['id'];
        $consulta = "select * from pacientes where id = $id limit 1";
        $result = mysqli_query($conexion, $consulta);
        $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container d-flex justify-content-center">
        <form action="pacientesCrud.php" method="post" style="width: 50vw; min-width: 300px;">
            <div class="row">

                <!-- id -->
                <div class="col">
                    <label class="form-label">id</label>
                    <input type="numeric" class="form-control" name="id" value="<?php echo $id ?>" readonly>
                </div>
                <!-- estado -->
                <div class="row">
                    <div class="col">
                        <div class="form-group mb-3">
                            <label>estado</label> &nbsp;
                            <input type="radio" class="form-check-input" name="estado" 
                             id="activo" value="activo" <?php echo($row['estado'] == '1') ? "checked" : "";?> >
                            <label for="male" class="form-input-label">activo</label>
                            &nbsp;
                            <input type="radio" class="form-check-input" name="estado" 
                             id="inactivo" value="inactivo" <?php echo($row['estado'] == '0') ? "checked" : "";?> >
                            <label for="male" class="form-input-label">inactivo</label>
                        </div>
                    </div>
                </div>
                <!-- apellido -->
                <div class="col">
                    <label class="form-label">apellido</label>
                    <input type="text" class="form-control" name="apellido" value="<?php echo $row['apellido']?>">
                </div>
                <!-- nombre -->
                <div class="col">
                    <label class="form-label">nombre</label>
                    <input type="text" class="form-control" name="nombre" value="<?php echo $row['nombre']?>">
                </div>
            </div>
            <div class="row">
                <!-- dni -->
                <div class="col">
                    <label class="form-label">dni</label>
                    <input type="number" class="form-control" name="dni" value="<?php echo $row['dni']?>">
                </div>                
            </div>
            <div class="row">
                <!-- direccion -->
                <div class="col">
                    <label class="form-label">direccion</label>
                    <input type="text" class="form-control" name="direccion" value="<?php echo $row['direccion']?>">
                </div>
            </div>
            <div class="row">
                <!-- cobertura -->
                <div class="col">
                    <!-- cargamos el combo con las coberturas -->
                    <label class="form label">cobertura</label>
                    <select name = "cobertura" id="cobertura" class="form-control">
                        <?php
                            $sql = "select id,nombre from coberturas order by nombre";
                            echo $sql;
                            $datos = mysqli_query($conexion, $sql);
                            $ep = mysqli_fetch_all($datos, MYSQLI_ASSOC);
                            foreach($ep as $fila){
                                // verificamos cual es la opcion que traemos desde la base de datos
                                // para setearla como SELECTED
                                if($fila['id'] == $row['cobertura1']){
                                    $selected = 'selected';
                                } else {
                                    $selected = '';
                                }
                                echo '<option value="'.$fila["id"].'" '.$selected.'>'.$fila["nombre"].'</option>';
                                // echo '<option value="'.$fila["id"].'">'.$fila["nombre"].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <!-- cobertura numero -->
                <div class="col">
                    <label class="form-label">numero</label>
                    <input type="text" class="form-control" name="c1numero" value="<?php echo $row['c1numero']?>">
                </div>
            </div>

            <!-- reintegro -->
            <div class="row">
                <div class="col">
                    <div class="form-group mb-3">
                        <label>prestacion por reintegro?</label> &nbsp;
                        <input type="radio" class="form-check-input" name="reintegro" 
                            id="activo" value="si" <?php echo($row['reintegro'] == '1') ? "checked" : "";?> >
                        <label for="si" class="form-input-label">si</label>
                        &nbsp;
                        <input type="radio" class="form-check-input" name="reintegro" 
                            id="inactivo" value="no" <?php echo($row['reintegro'] == '0') ? "checked" : "";?> >
                        <label for="no" class="form-input-label">no</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- contacto -->
                <div class="col">
                    <label class="form-label">contacto</label>
                    <textarea name="contacto" class="form-control" id="contacto"><?php echo $row['contacto']?></textarea>
                </div>
            </div>
            <!-- boton submit -->
            <div>
                <br>
                <button type="submit" class="btn btn-success" name="submit">modificar</button>
                <a href="pacientes.php" class="btn btn-danger">cancelar</a>
            </div>
            

    </form>
    </div>

    <!-- bootstrap -->
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- <script src="assets/bootstrap/js/bootstrap.min.js"></script> -->
</body>
</html>