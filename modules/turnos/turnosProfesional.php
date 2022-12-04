
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
    <link rel="stylesheet" href="turnosProfesional.css">  

</head>
<body>

    <?php require_once("../../assets/pages/navBar.php"); ?>
    <?php require_once("../db/dbConnection.php"); ?>

    <?php
        // $idProfesional = $_SESSION['profesional'];
        // $nombreProfesional = $_SESSION['profesional_nombre'];
    ?>

    <!-- <h3>profesional: <?php //echo $nombreProfesional ?></h3> -->
    <div class="form-group">

        <br/>
            <a href="#" class="btn btn-warning" disabled><img src="../../assets/icons/agregar-usuario.png" />  agregar turno</a>
            <a href="../calendarios/test.php" class="btn btn-warning" disabled><img src="../../assets/icons/lista.png" />  prox. turnos disp.</a>
            <!-- <a href="../calendarios/calendario.php?p=<?php //echo $idProfesional ?>" class="btn btn-warning" disabled><img src="../../assets/icons/calendario.png" />  ver calendario</a> -->
            <a href="../calendarios/calendario.php" class="btn btn-warning" disabled><img src="../../assets/icons/calendario.png" />ver calendario</a>
        <br/><br/>
    </div>

    <div class="container caja">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">   

                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <td>idTurno</td>
                                <td>idProfesional</td>
                                <td>profesional</td>
                                <td>dni</td>
                                <td>paciente</td>
                                <td>description</td>
                                <td>fecha/hora inicio</td>
                                <td>fecha/hora fin</td>
                                <td>estado</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                            $sql = "select turnos.id as idTurno,turnos.profesional as idProfesional,profesionales.prf_nombre as profesional,
                            pacientes.dni,concat(pacientes.apellido,' ',pacientes.nombre) as nombre,description as descripcion,
                            date_format(start, '%d/%m/%Y ( %H:%i )') as desde,
                            date_format(end, '%d/%m/%Y ( %H:%i )') as hasta, estado
                            from turnos
                            inner join pacientes on turnos.dni = pacientes.dni
                            inner join profesionales on turnos.profesional = profesionales.prf_id
                            where date(start) >= curdate()
                            or estado = ''";
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
                                $desde = $row['desde'];
                                $hasta = $row['hasta'];
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
                                    <td><?php echo $hasta ?></td>
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