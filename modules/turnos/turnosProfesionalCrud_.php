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

        case 'close':
            if(isset($_POST['submit'])){
                $dni = $_POST['dni'];
                $idTurno = $_POST['idTurno'];
                $idProfesional = $_SESSION['profesional'];
                $fechaCierre = date('Y-m-d');
                $impPago = $_POST['pago'];
                $impSaldo = $_POST['saldo'] - $_POST['pago'];

                // echo "<br>dni: ".$dni;
                // echo "<br>idTurno: ".$idTurno;
                // echo "<br>idProfesional: ".$idProfesional;
                // echo "<br>fechaCierre: ".$fechaCierre;
                // echo "<br>impPago: ".$impPago;
                // echo "<br>impSaldo: ".$impSaldo;
                // die();

                //hacer el update con el estado de cierre del turno
                $sql = "update TURNOS set estado =:est where id =:idTurno";
                $p = db::conectar()->prepare($sql);
                $p->bindValue(':est', $_POST['estadoCierreTurno']);
                $p->bindValue(':idTurno', $_POST['idTurno']);
                $p->execute();
                if($p) {
                    echo '<br>estado del turno asignado';
                    $p = null;
                    //hacer el update con el resultado del saldo del paciente
                    $sql = "update PACIENTES set saldo = saldo - :pago where dni =:dni";
                    $p = db::conectar()->prepare($sql);
                    $p->bindValue(':pago', $_POST['pago']);
                    $p->bindValue(':dni', $_POST['dni']);
                    $p->execute();
                    if($p) {
                        echo '<br>saldo del paciente actualizado';
                        $p = null;
                        //hacer el insert en la tabla de log de pagos
                        $sql = "insert into CUENTACORRIENTELOG (`ctacte_dni`,
                        `ctacte_idTurno`,`ctacte_idProfesional`,`ctaCte_fecha`,
                        `ctaCte_importePago`,`ctacte_importeSaldo`) 
                        values (:dni, :idTurno, :idProfesional, :fecha, :impPago, :impSaldo)";
                        $p = db::conectar()->prepare($sql);
                        $p->bindValue(':dni', $dni);
                        $p->bindValue(':idTurno', $idTurno);
                        $p->bindValue('idProfesional', $idProfesional);
                        $p->bindValue(':fecha', $fechaCierre);
                        $p->bindValue(':impPago', $impPago);
                        $p->bindValue(':impSaldo', $impSaldo);

                        // echo ("<br>".$sql);
                        // die();

                        $p->execute();
                        if($p) {
                            echo '<br>log del pago insertado';
                            header ("Location: ./turnosProfesional.php");
                        }
                    }



                } else {
                    echo 'no se cerro el turno';
                }
                
            }
        break;

        // borrado de paciente
        case 'delete':
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                try {
                    $sql = "delete from turnos where id = $id";
                    $p = db::conectar()->prepare($sql);
                    $p->execute();
                    header ("Location: ./turnosProfesional.php");
                } catch (PDOException $error1) {
                    echo $error1->getMessage();
                } catch (Exception $error1) {
                    echo $error2->getMessage();
                }
            }
        break;



    }
?>