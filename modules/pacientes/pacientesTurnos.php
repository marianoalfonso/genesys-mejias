
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- bootstrap css -->
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">

    <!-- css personalizado -->
    <link rel="stylesheet" href="./turnosProfesional.css">

    <!-- datatables css basico -->
    <link rel="stylesheet" type="text/css" href="../../assets/datatables/datatables.min.css">
    
    <!-- datatables estilo bootstrap -->
    <link rel="stylesheet" type="text/css" href="../../assets/datatables/DataTables-1.12.1/css/dataTables.bootstrap5.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">  

</head>
<body>

    <?php require_once("../../assets/pages/navBar.php"); ?>
    <?php require_once("../db/dbConnection.php"); ?>

    <?php
        $idProfesional = $_SESSION['profesional'];
        $nombreProfesional = $_SESSION['profesional_nombre'];
    ?>

    <div class="form-group">

        <br/>
            <a href="#" class="btn btn-warning" disabled><img src="../../assets/icons/agregar-usuario.png" />  agregar turno</a>
            <a href="../calendarios/test.php" class="btn btn-warning" disabled><img src="../../assets/icons/lista.png" />  prox. turnos disp.</a>
            <a href="../calendarios/calendario.php?p=<?php echo $idProfesional ?>" class="btn btn-warning" disabled><img src="../../assets/icons/calendario.png" />  ver calendario</a>
        <br/><br/>
    </div>

    <div class="container caja">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">   

                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <td>id</td>
                                <!-- <td>profesional</td> -->
                                <td>dni</td>
                                <td>nombre</td>
                                <td>description</td>
                                <td>fecha/hora inicio</td>
                                <td>fecha/hora fin</td>
                                <td>estado</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>

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

    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });

    </script>

</body>
</html>