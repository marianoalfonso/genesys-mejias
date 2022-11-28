<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>agendas en uso</title>

    <!-- bootstrap css -->
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">

    <!-- datatables css basico -->
    <link rel="stylesheet" type="text/css" href="../../assets/datatables/datatables.min.css">

    <!-- datatables estilo bootstrap -->
    <link rel="stylesheet" type="text/css" href="../../assets/datatables/DataTables-1.12.1/css/dataTables.bootstrap5.min.css">


    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="./agendasUso.css">  


</head>
<body>
    <?php
        session_start();
        $_SESSION['action'] = 'agendas';
    ?>
    <h3>agendas en uso</h3>

    <?php require_once("../db/dbConnection.php"); ?>


    <div class="container caja">
        <div class="row">
            <div class="col-lg-8">
            <div class="table-responsive">        
                <table id="example" class="table table-striped table-bordered table-condensed" style="width:100%" >
                    <thead class="text-center">
                        <tr>
                            <th>id</th>
                            <th>agenda profesional</th>                                
                            <th>bloqueada por</th>
                            <th>dni</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>       
                        
                    <?php
                        $sql = "select
                                profesionales.prf_id as id,profesionales.prf_nombre as profesional, 
                                usuarios.usr_nombre as bloqueo,usuarios.usr_dni as dni
                                FROM profesionales inner join usuarios ON
                                profesionales.prf_bloqueo = usuarios.usr_dni";
                        $resultado = db::conectar()->prepare($sql);
                        $resultado->execute();        
                        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
                        foreach($data as $row) {
                    ?>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['profesional']; ?></td>
                            <td><?php echo $row['bloqueo']; ?></td>
                            <td><?php echo $row['dni']; ?></td>
                            <!-- botones -->
                            <td><a href="./loginDesbloquearProfesional.php?id=<?php echo $row['id'] ?>"><img src="../../assets/icons/desbloquear.png" alt="desbloquear"></a></td>
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
    <script type="text/javascript" src="./agendasUso.js"></script>

</body>
</html>