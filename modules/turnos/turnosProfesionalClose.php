<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <!-- <link rel="stylesheet" href="../css/bootstrap.min.css" >
    <link rel="stylesheet" href="../css/datatables.min.css" >
    <link rel="stylesheet" href="../css/bootstrap-clockpicker.css" >
    <link rel="stylesheet" href="../fullcalendar/main.css" > -->

    <!-- bootstrap -->
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" 
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="./turnosProfesionalClose.css">

</head>
<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00FF5573";>
        gestión de turnos
    </nav>

    <?php
        session_start();
        $_SESSION['action'] = "close";
        $id = $_GET['id'];
        require_once("../db/dbConnection.php");
        $sql = "select profesional,pacientes.dni,title,description,start,end,textColor,backgroundColor,
                    pacientes.saldo
                    from turnos inner join pacientes on
                    turnos.dni = pacientes.dni
                    where turnos.id = $id limit 1";
        $p = db::conectar()->prepare($sql);
        $p->execute();
        $resultado = $p->fetchAll(PDO::FETCH_ASSOC);
        foreach($resultado as $row){
            $title = $row['title'];
            $dni = $row['dni'];
            $profesional = $row['profesional'];
            $turnoDesde =substr($row['start'],0,10)." ( ".substr($row['start'],11,8)." - ".substr($row['end'],11,8);
            $saldo = $row['saldo'];
        }
    ?>

    <div class="container d-flex justify-content-center">
        <form action="./turnosProfesionalCrud_.php" method="post" style="width: 50vw; min-width: 300px;">
            <div id="close-box" class="col-md-12">
                <div class="row">
                    <!-- id -->
                    <div class="col-md-2">
                        <label class="form-label">id</label>
                        <input type="number" class="form-control" name="idTurno" value="<?php echo $id; ?>" readonly>
                    </div>

                    <!-- apellido y nombre -->
                    <div class="col-md-7">
                        <label class="form-label">apellido</label>
                        <input type="text" class="form-control" name="title" value="<?php echo $title ?>" readonly>
                    </div>

                    <!-- dni -->
                    <div class="col-md-3">
                        <label class="form-label">dni</label>
                        <input type="number" class="form-control" name="dni" value="<?php echo $dni ?>" readonly>
                    </div>

                </div>
                <div class="row">
                    <!-- turno desde-->
                    <div class="col-md-6">
                        <label class="form-label">turno asignado</label>
                        <input type="text" class="form-control" name="turnoDesde" value="<?php echo $turnoDesde ?> )" readonly>
                    </div>

                    <!-- importe pagado -->
                    <div class="col-md-4">
                        <label for="estadoCierreTurno">estado de cierre del turno</label>
                        <select name="estadoCierreTurno" class="form-control">
                            <option value="pre">presente</option>
                            <option value="aCa">ausente con aviso</option>
                            <option value="aSa">ausente sin aviso</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <!-- cuenta corriente -->
                    <div class="col-md-5">
                        <label class="form-label">saldo</label>
                        <input type="number" class="form-control" name="saldo" value="<?php echo $saldo ?>">
                    </div>

                    <!-- pago -->
                    <div class="col-md-5">
                        <label class="form-label">pago</label>
                        <input type="number" class="form-control" name="pago" >
                    </div>
                </div>

                <div class="row">
                    <input type="submit" class="btn btn-warning" name="submit" value="cerrar turno"></button>
                    <a href="./turnosProfesional.php" class="btn btn-danger">cancelar</a>
                </div>

            </div>
        </form>
    </div>

    <!-- bootstrap -->
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>