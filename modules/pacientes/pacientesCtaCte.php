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

    <div class="container">


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
                    // $saldo = (float)$row['saldo'];
                    $saldo = $row['saldo'];
                }
            ?>
            
            <div class="form-group">
            <br/>
                <!-- data-bs-toggle="modal" indicamos que vamos a abrir una venana modal con este link -->
                <!-- data-bs-target="agregarSaldoModal" indicamos el id de la ventana modal -->
                <h4>paciente: <?php echo $nombrePaciente; ?></h4>
                <h4>saldo general: <?php echo "$ ".number_format((float)$saldo,2); ?></h4>
                <a href="./pacientesAgregarSaldo.php?dni=<?php $_GET['dni']; ?>" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#agregarSaldoModal"><img src="../../assets/icons/money.png" />  agregar saldo</a>

            <br/><br/>
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
                            <th>fecha</th>
                            <th>turno</th>
                            <th>pago</th>                                
                            <!-- <th>saldo</th> -->
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>       
                        
                    <?php
                        // require_once("../db/dbConnection.php");
                        // $dni = $_GET['dni'];
                        $sql = "SELECT
                            concat(pacientes.apellido,', ',pacientes.nombre) as nombre,
                            cuentacorrientelog.ctacte_dni as dni,ctacte_idProfesional as idProfesional,
                            profesionales.prf_nombre as profesional,ctaCte_fecha as fecha,
                            turnos.description as turno,
                            ctaCte_importePago as pago,ctacte_importeSaldo as saldo,
                            pacientes.saldo as saldoPaciente
                            FROM cuentacorrientelog
                            inner join pacientes ON cuentacorrientelog.ctacte_dni = pacientes.dni
                            inner join profesionales ON cuentacorrientelog.ctacte_idProfesional = profesionales.prf_id
                            left join turnos on cuentacorrientelog.ctacte_idTurno = turnos.id
                            where ctacte_dni = $dni
                            and (ctaCte_importePago <> 0 and ctacte_importeSaldo <> 0)
                            order by ctaCte_fecha";

                        $resultado = db::conectar()->prepare($sql);
                        $resultado->execute();        
                        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
                        foreach($data as $row) {
                    ?>
                            <td><?php echo $row['profesional']; ?></td>
                            <td><?php echo $row['fecha']; ?></td>
                            <td><?php echo $row['turno']; ?></td>
                            <td><?php echo "$ ".number_format((float)$row['pago']); ?></td>
                            <!-- <td><?php //echo "$ ".number_format((float)$row['saldo']); ?></td> -->
                            <!-- botones -->
                            <td><a href="#"><img src="../../assets/icons/lista.png" alt="turnos"></a></td>
                            <td><a href="#"><img src="../../assets/icons/borrar.png" alt="borrar"></a></td>
                        </tr>
                        <?php } ?>

                    </tbody>        
                </table>               
            </div>
            </div>
        </div>  
    </div> 

    <?php include "pacientesAgregarSaldo.php"; ?>

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