<?php
    require('../db/dbConnection.php');
    session_start();
    $accion = $_SESSION['action'];
    // $id = $_POST['id'];

    
    switch ($accion) {
        case 'add':
            if(isset($_POST['submit'])) {
                try {
                    $apellido = $_POST['apellido'];
                    $nombre = $_POST['nombre'];
                    $dni = $_POST['dni'];
                    $direccion = $_POST['direccion'];
                    $cobertura = $_POST['cobertura'];
                    $numero = $_POST['c1numero'];
                    $contacto = $_POST['contacto'];
                    $estado = $_POST['estado'];
                    // estado activo o inactivo
                    if($estado=="activo"){
                        $valorEstado = 1;
                    } else {
                        $valorEstado = 0;
                    }
                    // pago por reintegro
                    $reintegro = $_POST['reintegro'];
                    if($reintegro=="si"){
                        $valorReintegro = 1;
                    } else {
                        $valorReintegro = 0;
                    }
                    $sql = "INSERT INTO `pacientes`(`apellido`, `nombre`, `dni`, `direccion`, `cobertura1`, `c1numero`, `contacto`, `estado`, `reintegro`) VALUES 
                    ('$apellido','$nombre','$dni','$direccion','$cobertura','$numero','$contacto','$valorEstado','$valorReintegro')";
                    $p = db::conectar()->prepare($sql);
                    $p->execute();
                    header ("Location: ./pacientes.php");
                } catch (PDOException $error1) {
                    echo $error1->getMessage();
                } catch (Exception $error1) {
                    echo $error2->getMessage();
                }
            }
        break;

        // edicion de paciente
        case 'edit':
            if(isset($_POST['submit'])){
                try {
                    $id = $_POST['id'];
                    $apellido = $_POST['apellido'];
                    $nombre = $_POST['nombre'];
                    $dni = $_POST['dni'];
                    $direccion = $_POST['direccion'];
                    $cobertura = $_POST['cobertura'];
                    $numero = $_POST['c1numero'];
                    $contacto = $_POST['contacto'];
                    $estado = $_POST['estado'];
                    if($estado=="activo"){
                        $valorEstado = 1;
                    } else {
                        $valorEstado = 0;
                    }
                    $reintegro = $_POST['reintegro'];
                    if($reintegro=="si"){
                        $valorReintegro = 1;
                    } else {
                        $valorReintegro = 0;
                    }
                    $sql = "UPDATE pacientes SET apellido='$apellido' ,nombre='$nombre', dni=$dni, direccion='$direccion',
                            cobertura1=$cobertura, c1numero=$numero, contacto='$contacto', estado=$valorEstado, reintegro=$valorReintegro 
                            WHERE id=$id";
                    $p = db::conectar()->prepare($sql);
                    $p->execute();
                    header ("Location: ./pacientes.php");
                } catch (PDOException $error1) {
                    echo $error1->getMessage();
                } catch (Exception $error1) {
                    echo $error2->getMessage();
                }
            }
        break;

        // borrado de paciente
        case 'delete':
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                try {
                    $sql = "delete from pacientes where id = $id";
                    $p = db::conectar()->prepare($sql);
                    $p->execute();
                    header ("Location: ./pacientes.php");
                } catch (PDOException $error1) {
                    echo $error1->getMessage();
                } catch (Exception $error1) {
                    echo $error2->getMessage();
                }
            }
        break;



    }
?>
