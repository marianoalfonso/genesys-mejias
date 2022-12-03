<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="./profesionales.css">  

    <!-- bootstrap css -->
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">

    <!-- datatables css basico -->
    <link rel="stylesheet" type="text/css" href="../../assets/datatables/datatables.min.css">
    
    <!-- datatables estilo bootstrap -->
    <link rel="stylesheet" type="text/css" href="../../assets/datatables/DataTables-1.12.1/css/dataTables.bootstrap5.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">  

</head>
<body>

    <?php require_once('../../assets/pages/navBar.php'); ?>

    <div class="form-group">
        <br/>
            <a href="profesionalesAdd.php" class="btn btn-warning" disabled>agregar profesional</a>
        <br/><br/>
    </div>

    <div class="container caja">
        <div class="row">
            <div class="col-lg-12">
            <div class="table-responsive">        
                <table id="example" class="table table-striped table-bordered table-condensed" style="width:100%" >
                    <thead class="text-center">
                        <tr>
                            <th>id</th>
                            <th>nombre</th>                                
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>       
                        
                    <?php
                        require_once("../db/dbConnection.php");
                        $sql = "SELECT prf_id,prf_nombre FROM profesionales order by prf_nombre";
                        $resultado = db::conectar()->prepare($sql);
                        $resultado->execute();        
                        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
                        foreach($data as $row) {
                    ?>
                        <tr>
                            <td><?php echo $row['prf_id']; ?></td>
                            <td><a href="../calendarios/calendario.php?p=<?php echo $row['prf_id'] ?>&nombre=<?php echo $row['prf_nombre'] ?>"><img src="../../assets/icons/calendario.png" alt="calendario"></a><?php echo "  ".$row['prf_nombre']; ?></td>
                            <!-- botones -->
                            <td><a href="#"><img src="../../assets/icons/editar.png" alt="modificar"></a> editar</td>
                            <td><a href="#"><img src="../../assets/icons/borrar.png" alt="borrar"></a> borrar</td>
                            <td><a href="../turnos/turnosProfesional.php?id=<?php echo $row['prf_id'] ?>&nombre=<?php echo $row['prf_nombre'] ?>"><img src="../../assets/icons/lista.png" alt="turnos"></a> turnos</td>
                            <td><a href="../calendarios/calendario.php?p=<?php echo $row['prf_id'] ?>&nombre=<?php echo $row['prf_nombre'] ?>"><img src="../../assets/icons/calendario.png" alt="calendario"></a> calendario</td>
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
    <script type="text/javascript" src="profesionales.js"></script>

    

    <!-- <script src="//code.jquery.com/jquery-3.5.1.js"></script> -->
    <!-- <script src="../../assets/js/jquery-3.6.1.min.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script> -->

    <!-- <script type="text/javascript" src="./pacientes.js"></script>   -->
    <!-- <script src="assets/bootstrap/js/bootstrap.min.js"></script> -->
    <!-- <script src="../../assets/bootstrap/js/bootstrap.min.js"></script> -->

    <!-- <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-AR.json'
                }
            } );
        } );
    </script> -->

    
</body>
</html>