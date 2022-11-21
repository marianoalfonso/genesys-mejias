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
                    $fec_nac = $_POST['fec_nac'];
                    $cobertura = $_POST['cobertura'];
                    $numero = $_POST['numero'];
                    $telefono = $_POST['telefono'];
                    $direccion = $_POST['direccion'];
                    $profesion = $_POST['profesion'];
                    $sql = "INSERT INTO `pacientes`(`apellido`, `nombre`, `dni`, `fec_nac`, `cobertura`, `numero`, `telefono`, `direccion`, `profesion`) VALUES 
                    ('$apellido','$nombre','$dni','$fec_nac','$cobertura','$numero','$telefono','$direccion','$profesion')";
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
                    $fec_nac = $_POST['fec_nac'];
                    $cobertura = $_POST['cobertura'];
                    $numero = $_POST['numero'];
                    $telefono = $_POST['telefono'];
                    $direccion = $_POST['direccion'];
                    $profesion = $_POST['profesion'];
                    $sql = "UPDATE `pacientes` SET `apellido`='$apellido',`nombre`='$nombre',`dni`='$dni',`fec_nac`='$fec_nac',
                            `cobertura`='$cobertura',`numero`='$numero',`telefono`='$telefono',`direccion`='$direccion',
                            `profesion`='$profesion' WHERE id=$id";
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
