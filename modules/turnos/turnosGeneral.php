
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- bootstrap css -->
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">

    <!-- datatables css basico -->
    <link rel="stylesheet" type="text/css" href="../../assets/datatables/datatables.min.css">
    
    <!-- datatables estilo bootstrap -->
    <link rel="stylesheet" type="text/css" href="../../assets/datatables/DataTables-1.12.1/css/dataTables.bootstrap5.min.css">
    

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">  

    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="turnos.css">  

</head>
<body>

    <?php require_once("../../assets/pages/navBar.php"); ?>
    <?php require_once("../db/dbConnection.php"); ?>


    <?php
        // session_start();
        $_SESSION['origenCierreTurno'] = "general";
    ?> 

    <!-- <h3>profesional: <?php //echo $nombreProfesional ?></h3> -->
    <div class="container cabecera">
        <div class="form-group">
            <div class="modulo">
                <h4>listado de turnos de todos los profesionales</h4>
            </div>
            <div class="ayuda">
                <h6>(aqui se muestran los turnos de todos los pacientes y todos los profesionales ordenados de hoy a futuro)</h6>
            </div>
            <div class="col">
                <!-- <a href="../calendarios/test.php" class="btn btn-warning" disabled><img src="../../assets/icons/lista.png" />  prox. turnos disp.</a> -->
            </div>
            <div class="error">
                <?php
                    if(isset($_SESSION['error'])) { ?>
                        <h3><?php echo $_SESSION['error']; ?></h3>
                        <?php unset($_SESSION['error']);
                    }
                ?>
            </div>
        </div>
    </div>

    <div class="container caja">
        <div class="row">
            <div class="col">
                <div class="table-responsive">   
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <td>id</td>
                                <td>idProf</td>
                                <td>profesional</td>
                                <td>dni</td>
                                <td>paciente</td>
                                <td>description</td>
                                <td>fecha/hora</td>
                                <!-- <td>fecha/hora fin</td> -->
                                <td>estado</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                            // $idProf = $_GET['id'];
                            $sql = "select turnos.id as idTurno,turnos.profesional as idProfesional, profesionales.prf_nombre as profesional,
                                pacientes.dni,concat(pacientes.apellido,' ',pacientes.nombre) as nombre,description as descripcion,
                                concat(date_format(start, '%d/%m/%Y (%H:%i'),' - ', date_format(end, '%H:%i)')) as horario, estado
                            from turnos inner join pacientes on turnos.dni = pacientes.dni inner join profesionales on turnos.profesional = profesionales.prf_id 
                            where (date(start) >= curdate() or estado = '')";
                            $p = db::conectar()->prepare($sql);
                            $p->execute();
                            $datos = $p->fetchAll(PDO::FETCH_ASSOC);
                            foreach($datos as $row){
                                $idTurno = $row['idTurno'];
                                $idProfesional = $row['idProfesional'];
                                $profesional = $row['profesional'];
                                $dni = $row['dni'];
                                $nombre = $row['nombre'];
                                $descripcion = $row['descripcion'];
                                $desde = $row['horario'];
                                // $hasta = $row['hasta'];
                                $estado = $row['estado'];
                            ?>
                                <tr>
                                    <td><?php echo $idTurno ?></td>
                                    <td><?php echo $idProfesional ?></td>
                                    <td><a href="../calendarios/calendario.php?p=<?php echo $row['idProfesional'] ?>&nombre=<?php echo $row['profesional'] ?>"><img src="../../assets/icons/calendario.png" alt="calendario"></a><?php echo "  ".$row['profesional']; ?></td>
                                    <!-- <td><?php //echo $profesional ?></td> -->
                                    <td><?php echo $dni ?></td>
                                    <td><?php echo $nombre ?></td>
                                    <td><?php echo $descripcion ?></td>                      
                                    <td><?php echo $desde ?></td>
                                    <!-- <td><?php //echo $hasta ?></td> -->
                                    <td><?php echo $estado ?></td>
                                    <td><a href="./turnosProfesionalClose.php?idTurno=<?php echo $idTurno ?>"><img src="../../assets/icons/cerrar.png" alt="cerrar"></a></td>
                                    <td><a href="./turnosEdit.php?id=<?php echo $idTurno ?>"><img src="../../assets/icons/editar.png" alt="modificar"></a></td>
                                    <td><a href="./turnosDelete.php?id=<?php echo $idTurno ?>"><img src="../../assets/icons/borrar.png" alt="borrar"></a></td>
                                </tr>
                            <?php }?>    

                        </tbody>
                    </table>
                
                </div>
            </div>
        </div>
    </div>

    <!-- jquery, popper.js, bootstrap.js -->
    <script src="../../assets/jquery/jquery-3.6.1.min.js"></script>
    <script src="../../assets/popper/popper.min.js"></script>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>

    <!-- datatables.js -->
    <script type="text/javascript" src="../../assets/datatables/datatables.min.css"></script>
    <script type="text/javascript" src="../../assets/datatables/DataTables-1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="../../assets/datatables/DataTables-1.12.1/js/dataTables.bootstrap5.min.js"></script>
 
    <script type="text/javascript" src="turnosProfesional.js"></script>  

</body>
</html>