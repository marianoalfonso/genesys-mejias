<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
    <!-- bootstrap css -->
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">

    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="login.css">  

</head>
<body>
    <?php 
        require_once('../db/dbConnection.php');
        session_start();
        $_SESSION['action'] = 'login';
    ?>

    <div id="login">
        <h3 class="text-center text-white pt-5">laboratorio odontologico Gustavo Mejias</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" action="./loginCrud.php" class="form" method="post">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="dni" class="text-info">dni</label><br>
                                <input type="number" name="dni" class="form-control" value="22925061">
                                <!-- <input type="number" name="dni" class="form-control" value=""> -->
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">password</label><br>
                                <input type="password" name="password" class="form-control" value="test1234">
                                <!-- <input type="password" name="password" class="form-control" value=""> -->
                            </div>
                            <!-- <div class="form-group">
                                <label for="profesional" class="text-info">seleccionar agenda de profesional</label>
                                <select name="profesional" class="form-control"> -->
                                    <?php
                                        // try {
                                        //     $sql = "select prf_id, prf_nombre from profesionales where prf_bloqueo is null order by 2";
                                        //     $p = db::conectar()->prepare($sql);
                                        //     $p->execute();
                                        //     $datos = $p->fetchAll(PDO::FETCH_ASSOC);
                                        //     foreach ($datos as $row) {
                                        //         echo "<option value = '".$row['prf_id']."'>".$row['prf_nombre']."</option>";
                                        //     }    
                                        // } catch (PDOException $error1) {
                                        //     echo "error PDO: ".$error1;
                                        // } catch (exception $error2) {
                                        //     echo "error general: ".$error1;
                                        // }
                                    ?>
                                <!-- </select> -->
                            </div>
                            <div class="form-group" >
                                <div id="logInButton-column" class="col-md-12">
                                    <input type="submit" value="ingresar" class="btn btn-warning col-md-12" name="logIn_button" id="logIn_button" >
                                    <!-- <a href="./agendasUso.php" class="btn btn-warning col-md-5"><img src="../../assets/icons/cta-cte.png" />  ver agendas en uso</a> -->
                            
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

    <!-- jquery, popper.js, bootstrap.js -->
    <script src="../../assets/jquery/jquery-3.6.1.min.js"></script>
    <script src="../../assets/popper/popper.min.js"></script>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>

</html>





