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
                    $sql = "select usr_nombre, tipo_descripcion from usuarios inner join usuarios_tipo on 
                            usuarios.usr_tipo = usuarios_tipo.tipo_id where usr_dni=:n and usr_password=:r limit 1";
                    $p = db::conectar()->prepare($sql);
                    $p->bindValue(':n', $dni);
                    $p->bindValue(':r', $pwd);
                    $p->execute();
                    $results = $p->fetchAll(PDO::FETCH_ASSOC);
                    if ($p->rowCount() > 0) {
                        foreach($results as $result) {
                            $_SESSION['usuario'] = $result['usr_nombre'];
                            $_SESSION['usuario_dni'] = $dni;
                            $_SESSION['usuario_tipo'] = $result['tipo_descripcion'];
                            $_SESSION['profesional'] = $profesional;
                            $_SESSION['validate'] = true;
                            //obtengo el nombre del profesional
                            $sql ="select prf_nombre from profesionales where prf_id =:idProfesional limit 1";
                            $r = db::conectar()->prepare($sql);
                            $r->bindValue(':idProfesional', $profesional);
                            $r->execute();
                            $datos = $r->fetchAll(PDO::FETCH_ASSOC);
                            foreach($datos as $row){
                                $_SESSION['profesional_nombre'] = $row['prf_nombre'];
                            }
                            //bloqueamos el profesional
                            $sql = "update profesionales set prf_bloqueo =:n
                                    where prf_id =:p";
                            $prof = db::conectar()->prepare($sql);
                            $prof->bindValue(':n', $dni);
                            $prof->bindValue(':p', $profesional);
                            $prof->execute();
                            if($prof) {

                                // echo("<br>usuario: ".$_SESSION['usuario']);
                                // echo("<br>usuario_dni: ".$_SESSION['usuario_dni']);
                                // echo("<br>usuario_tipo: ".$_SESSION['usuario_tipo']);
                                // echo("<br>profesional: ".$_SESSION['profesional']);
                                // echo("<br>validate: ".$_SESSION['validate']);
                                // echo("<br>profesional_nombre: ".$_SESSION['profesional_nombre']);
                                // die();

                                header('location: ../../index.php');
                            } else {
                                header('location: ../login/login.php');
                            }
                        }
                    } else {
                        header('location: ../login/login.php');
                    }
                }
                break;
        }
    ?>