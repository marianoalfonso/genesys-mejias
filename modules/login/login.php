<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
<link href="../../assets/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> -->
<script src="../../assets/js/bootstrap.min.js"></script>
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<script src="../../assets/js/jquery-3.6.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="login.css">  

<body>
    <?php 
        require('../db/dbConnection.php');
        session_start();
        $_SESSION['action'] = 'login';
    ?>

    <div id="login">
        <h3 class="text-center text-white pt-5">laboratorio odontologico Gustavo Mejias</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" action="../cruds/loginCrud.php" class="form" method="post">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="dni" class="text-info">dni</label><br>
                                <input type="number" name="dni" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">password</label><br>
                                <input type="text" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="profesional" class="text-info">seleccionar agenda de profesional</label>
                                <select name="profesional" class="form-control">
                                    <?php
                                        $resultados = db::conectar()->prepare('select prf_id, prf_nombre from profesionales order by 2;');
                                        $resultados->execute();
                                        $datos = $resultados->fetchAll();
                                        foreach ($datos as $row) {
                                            echo "<option value = '".$row['prf_id']."'>".$row['prf_nombre']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="ingresar" class="btn btn-warning" name="logIn_button">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>