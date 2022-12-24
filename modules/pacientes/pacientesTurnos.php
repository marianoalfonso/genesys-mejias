<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cuenta corriente</title>

   <!-- bootstrap css -->
   <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">

    <!-- datatables css basico -->
    <link rel="stylesheet" type="text/css" href="../../assets/datatables/datatables.min.css">

    <!-- datatables estilo bootstrap -->
    <link rel="stylesheet" type="text/css" href="../../assets/datatables/DataTables-1.12.1/css/dataTables.bootstrap5.min.css">


    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">  

    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="pacientesCtaCte.css">  
    <!-- <link rel="stylesheet" href="pacientes.css">   -->

</head>
<body>
    
<?php require_once("../../assets/pages/navBar.php"); ?>
    <?php require_once("../../assets/functions/date.php"); ?>

    <!-- <div class="container">
        <div class="form-group">
            <br/>
                <a href="./pacientesAdd.php" class="btn btn-warning" disabled><img src="../../assets/icons/agregar-usuario.png" />  agregar paciente</a>
            <br/><br/>
        </div>

        <div class="error">
            <?php
                require_once("../db/dbConnection.php");
                $dni = $_GET['dni'];
                $sql = "select concat(apellido,', ',nombre) as nombre, saldo from pacientes where dni = $dni limit 1";
                $consulta = db::conectar()->prepare($sql);
                $consulta->execute();
                $resultado = $consulta->fetchall(PDO::FETCH_ASSOC);
                foreach($resultado as $row){
                    $nombrePaciente = $row['nombre'];
                }

            ?>
            
        </div>
    </div> -->
    <div class="container">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <h4>paciente: <?php echo $nombrePaciente; ?></h4>
                    <h5>listado de turnos ordenados desde el mas reciente</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="container caja">
        <div class="row">
            <div class="col-lg-12">
            <div class="table-responsive">        
                <table id="example" class="table table-striped table-bordered table-condensed" style="width:100%" >
                    <thead class="text-center">
                        <tr>
                            <th>profesional</th>
                            <th>tratamiento</th>
                            <th>fecha</th>
                            <th>estado</th>
                            <!-- <th></th> -->
                            <!-- <th></th> -->
                        </tr>
                    </thead>
                    <tbody>       
                        
                    <?php
                        // require_once("../db/dbConnection.php");
                        // $dni = $_GET['dni'];
                        $sql = "select 
                        turnos.id,turnos.profesional as idProf,profesionales.prf_nombre as profesional, 
                        turnos.dni,turnos.title as nombre,turnos.description as tratamiento,
                        concat(date_format(start, '%d/%m/%Y (%H:%i'),' - ', date_format(end, '%H:%i)')) as fecha,
                        estado
                        from turnos 
                        left join profesionales on profesionales.prf_id = turnos.profesional
                        where dni = $dni order by start desc;";

                        $resultado = db::conectar()->prepare($sql);
                        $resultado->execute();        
                        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
                        foreach($data as $row) {
                    ?>
                            <td><a href="../calendarios/calendario.php?p=<?php echo $row['idProf'] ?>&nombre=<?php echo $row['profesional'] ?>"><img src="../../assets/icons/calendario.png" alt="calendario"></a><?php echo "  ".$row['profesional']; ?></td>
                            <td><?php echo $row['tratamiento']; ?></td>
                            <td><a href="../calendarios/calendario.php?p=<?php echo $row['idProf'] ?>&nombre=<?php echo $row['profesional'] ?>"><img src="../../assets/icons/calendario.png" alt="calendario"></a><?php echo "  ".$row['fecha']; ?></td>
                            <!-- <td><?php //echo $row['fecha']; ?></td> -->
                            <td><?php 
                                switch ($row['estado']){
                                    case 'pre':
                                        echo 'presente';
                                    break;
                                    case 'aCa':
                                        echo 'ausente con aviso';
                                    break;
                                    case 'aSa':
                                        echo 'ausente sin aviso';
                                    break;   
                                    case '':
                                        echo 'sin cerrar';
                                    break;                                 
                                } ?>
                            </td>

                            <!-- botones -->
                            <!-- <td><a href="#"><img src="../../assets/icons/lista.png" alt="turnos"></a></td> -->
                            <!-- <td><a href="#"><img src="../../assets/icons/borrar.png" alt="borrar"></a></td> -->
                        </tr>
                        <?php } ?>

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

    <!-- js personalizado -->
    <script type="text/javascript" src="./pacientes.js"></script>



</body>
</html>