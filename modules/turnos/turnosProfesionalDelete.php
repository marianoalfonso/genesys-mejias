<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap CSS v5.2.0-beta1
    <link rel="stylesheet" href="../css/bootstrap.min.css" >
    <link rel="stylesheet" href="../css/datatables.min.css" >
    <link rel="stylesheet" href="../css/bootstrap-clockpicker.css" >
    <link rel="stylesheet" href="../fullcalendar/main.css" > -->

    <!-- bootstrap -->
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" 
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="turnosProfesionalDelete.css">  

</head>
<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00FF5573";>
        gestión de turnos
    </nav>

    <?php
        session_start();
        $_SESSION['action'] = "delete";
        $id = $_GET['id'];
        require_once("../db/dbConnection.php");

        $sql = "select dni,title,description,start,end
                from turnos where id = $id limit 1";
        $p = db::conectar()->prepare($sql);
        $p->execute();
        $result = $p->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $title = $row['title'];
            $turnoDesde =substr($row['start'],0,10)." ( ".substr($row['start'],11,8)." - ".substr($row['end'],11,8);
        }
    ?>
    <div class="container caja">
        <div class="container d-flex justify-content-center">
            <form action="./turnosProfesionalCrud_.php" method="post" style="width: 50vw; min-width: 300px;">
                <div class="row">
                    <div class="form-group mb-3">

                        <!-- id -->
                        <div class="col">
                            <label class="form-label">id</label>
                            <input type="number" class="form-control" name="id" value="<?php echo $id; ?>" readonly>
                        </div>

                        <!-- apellido y nombre -->
                        <div class="col">
                            <label class="form-label">apellido</label>
                            <input type="text" class="form-control" name="title" value="<?php echo $title ?>" readonly>
                        </div>

                        <!-- turno desde-->
                        <div class="col">
                            <label class="form-label">turno asignado</label>
                            <input type="text" class="form-control" name="turnoDesde" value="<?php echo $turnoDesde ?> )" readonly>
                        </div>

                    </div>

                    <div>
                        <input type="submit" class="btn btn-warning" name="submit" value="borrar"></button>
                        <a href="./turnosProfesional.php" class="btn btn-danger">cancelar</a>
                    </div>

                </div>
            </form>
        </div>
    </div>


    <!-- bootstrap -->
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>