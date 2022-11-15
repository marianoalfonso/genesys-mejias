    <?php
        require('../db/dbConnection.php');
        session_start();
        $accion = $_SESSION['action'];

        switch ($accion) {
            case 'login':
                if(isset($_POST['logIn_button'])) {
                    $_SESSION['validate'] = false;
                    $dni = $_POST['dni'];
                    $pwd = $_POST['password'];
                    $profesional = $_POST['profesional'];
                    $p = db::conectar()->prepare('select usr_nombre, tipo_descripcion from usuarios inner join usuarios_tipo on 
                        usuarios.usr_tipo = usuarios_tipo.tipo_id where usr_dni=:n and usr_password=:r limit 1');
                    $p->bindValue(':n', $dni);
                    $p->bindValue(':r', $pwd);
                    $p->execute();
                    $results = $p->fetchAll(PDO::FETCH_ASSOC);
                    if ($p->rowCount() > 0) {
                        foreach($results as $result) {
                            $_SESSION['usuario'] = $result['usr_nombre'];
                            $_SESSION['usuario_tipo'] = $result['tipo_descripcion'];
                            $_SESSION['profesional'] = $profesional;
                            $_SESSION['validate'] = true;
                            header('location: ../../index.php');
                        }
                    } else {
                        header('location: ../login/login.php');
                    }
                }
                break;
        }
    ?>