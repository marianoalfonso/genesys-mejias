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
    <link rel="stylesheet" href="pacientes.css">  
    
</head>
<body>

    <?php require_once("../../assets/pages/navBar.php"); ?>
    <?php require_once("../../assets/functions/date.php"); ?>

    <div class="container">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <a href="./pacientesAdd.php" class="btn btn-warning" disabled><img src="../../assets/icons/agregar-usuario.png" />  agregar paciente</a>
                </div>
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
                    <table id="example" class="table table-striped table-bordered table-condensed" style="width:100%" >
                        <thead class="text-center">
                            <tr>
                                <th>id</th>
                                <th>apellido</th>
                                <th>nombre</th>                                
                                <th>dni</th>
                                <th>edad</th>  
                                <th>cobertura</th>
                                <th>socio</th>
                                <th>telefono</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>       
                            
                        <?php
                            require_once("../db/dbConnection.php");
                            $sql = "select pacientes.id as id,apellido,pacientes.nombre,dni,fec_nac,
                                    coberturas.nombre as cobertura,numero as socio,telefono
                                    from pacientes inner join coberturas ON
                                    pacientes.cobertura = coberturas.id
                                    order by apellido,pacientes.nombre";
                            $resultado = db::conectar()->prepare($sql);
                            $resultado->execute();        
                            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
                            foreach($data as $row) {
                        ?>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['apellido']; ?></td>
                                <td><?php echo $row['nombre']; ?></td>
                                <td><?php echo $row['dni']; ?></td>
                                <td><?php echo calcularEdad($row['fec_nac']); ?></td>
                                <td><?php echo $row['cobertura']; ?></td>
                                <td><?php echo $row['socio']; ?></td>
                                <td><?php echo $row['telefono']; ?></td>
                                <!-- botones -->
                                <td><a href="pacientesCtaCte.php?dni=<?php echo $row['dni'] ?>"><img src="../../assets/icons/money.png" alt="cta.cte"></a></td>
                                <td><a href="pacientesTurnos.php?dni=<?php echo $row['dni'] ?>"><img src="../../assets/icons/lista.png" alt="turnos"></a></td>
                                <td><a href="./pacientesEdit.php?id=<?php echo $row['id'] ?>"><img src="../../assets/icons/editar.png" alt="modificar"></a></td>
                                <td><a href="./pacientesDelete.php?id=<?php echo $row['id'] ?>"><img src="../../assets/icons/borrar.png" alt="borrar"></a></td>
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