<?php
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

    <title>alta de personas</title>
</head>
<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00FF5573";>
        alta de pacientes
    </nav>

    <!-- <div class="container">
        <div class="text-center mb-4">
            <h3>agregar nuevo paciente</h3>
            <p class="text-muted">complete los campos para agregar un nuevo paciente</p>
        </div>
    </div> -->

    <div class="container d-flex justify-content-center">
        <form action="./pacientesCrud.php" method="post" style="width: 50vw; min-width: 300px;">
            <div class="row">

                <!-- estado -->
                <div class="row">
                    <div class="col">
                        <div class="form-group mb-3">
                            <label>estado</label> &nbsp;
                            <input type="radio" class="form-check-input" name="estado" id="activo" value="activo" checked>
                            <label for="male" class="form-input-label">activo</label>
                            &nbsp;
                            <input type="radio" class="form-check-input" name="estado" id="inactivo" value="inactivo">
                            <label for="male" class="form-input-label">inactivo</label>
                        </div>
                    </div>
                </div>

                <!-- apellido -->
                <div class="col">
                    <label class="form-label">apellido</label>
                    <input type="text" class="form-control" name="apellido" placeholder="apellido">
                </div>
                <!-- nombre -->
                <div class="col">
                    <label class="form-label">nombre</label>
                    <input type="text" class="form-control" name="nombre" placeholder="nombre">
                </div>
            </div>
            <div class="row">
                <!-- dni -->
                <div class="col">
                    <label class="form-label">dni</label>
                    <input type="number" class="form-control" name="dni" placeholder="dni">
                </div>                
            </div>
            <div class="row">
                <!-- direccion -->
                <div class="col">
                    <label class="form-label">direccion</label>
                    <input type="text" class="form-control" name="direccion" placeholder="direccion">
                </div>
            </div>
            <div class="row">
                <!-- cobertura -->
                <div class="col">
                    <!-- cargamos el combo con las coberturas -->
                    <label class="form label">cobertura</label>
                    <select name = "cobertura" id="cobertura" class="form-control">
                        <option value="0">seleccione una cobertura</option>
                        <?php
                            require_once('../db/connDB.php');
                            $conexion = regresarConexion();
                            $consulta = "select id,nombre from coberturas order by nombre";
                            $datos = mysqli_query($conexion, $consulta);
                            $ep = mysqli_fetch_all($datos, MYSQLI_ASSOC);
                            foreach($ep as $fila){
                                echo '<option value="'.$fila["id"].'">'.$fila["nombre"].'</option>';
                            }
                        ?>
                    </select>
                </div>


                <!-- cobertura numero -->
                <div class="col">
                    <label class="form-label">numero</label>
                    <input type="text" class="form-control" name="c1numero" placeholder="numero">
                </div>

                <!-- reintegro -->
                <div class="row">
                    <div class="col">
                        <div class="form-group mb-3">
                            <label>prestacion por reintegro?</label> &nbsp;
                            <input type="radio" class="form-check-input" name="reintegro" id="activo" value="si">
                            <label for="si" class="form-input-label">si</label>
                            &nbsp;
                            <input type="radio" class="form-check-input" name="reintegro" id="inactivo" value="no" checked>
                            <label for="no" class="form-input-label">no</label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <!-- contacto -->
                <div class="col">
                    <label class="form-label">contacto</label>
                    <textarea name="contacto" class="form-control" id="contacto" placeholder="contacto"></textarea>
                </div>
            </div>

            <!-- boton submit -->
            <div>
                <br>
                <button type="submit" class="btn btn-success" name="submit">guardar</button>
                <a href="./pacientes.php" class="btn btn-danger">cancelar</a>
            </div>
            

    </form>
    </div>

    <!-- bootstrap -->
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- <script src="assets/bootstrap/js/bootstrap.min.js"></script> -->
</body>
</html>