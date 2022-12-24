<?php
    require('../db/dbConnection.php');
    session_start();
    $accion = $_SESSION['action'];
    $dniOriginal = $_SESSION['dniOriginal'];
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
                    // al hacer el alta de un nuevo paciente, lo direccionamos automaticamente a la lista de profesionales
                    // para seleccinar una agenda y dar de alta un turno
                    header ("Location: ../profesionales/profesionales.php");
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
                    // si el dni fue actualizado, elecuto el SP para cambiarlo en todas las tablas
                    if($dniOriginal != $dni) {
                        $sql = 'CALL cambiarDni (?, ?)';
                        $s = db::conectar()->prepare($sql);
                        $s->bindParam(1, $dniOriginal, PDO::PARAM_INT, 10);
                        $s->bindParam(2, $dni, PDO::PARAM_INT, 10);
                        $s->execute();
                    }
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
                    $sql = "SELECT count(*) as turnos FROM turnos inner join pacientes ON
                        turnos.dni = pacientes.dni WHERE pacientes.id = $id
                        and (date(turnos.start) <= curdate())";

                    $t = db::conectar()->prepare($sql);
                    $t->bindValue(':id', $id);
                    $t->execute();
                    $resultado = $t->fetch(PDO::FETCH_ASSOC);

                    if($resultado['turnos'] != 0) {    //si tiene turnos cerrados no lo borramos
                        $_SESSION['error'] = 'no puede eliminarse un paciente con turnos anteriores a hoy';
                        header ("Location: ./pacientes.php");
                    } else { //si no tiene turnos cerrados o tiene turnos futuros, lo borramo
                        //borro el turno
                        $sql = "delete turnos FROM turnos inner join pacientes ON
                                turnos.dni = pacientes.dni WHERE pacientes.id =:id
                                and turnos.estado =  ''";
                        $r = db::conectar()->prepare($sql);
                        $r->bindValue(':id', $id);
                        $r->execute();
                        // borro paciente
                        $sql = "delete from pacientes where id = $id";
                        $p = db::conectar()->prepare($sql);
                        $p->execute();
                        header ("Location: ./pacientes.php");                       
                    }

                } catch (PDOException $error1) {
                    echo $error1->getMessage();
                } catch (Exception $error1) {
                    echo $error2->getMessage();
                }
            }
        break;



    }
?>
