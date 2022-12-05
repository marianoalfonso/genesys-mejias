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
                $origenCierre = $_SESSION['origenCierreTurno'];
                $fechaTurno = substr($_POST['turnoDesde'], 0, 10);

            // if ($fechaTurno <= date('Y-m-d')) {
            //     echo 'el turno PUEDE BORRARSE';
            // } else {
            //     echo 'el turno NO PUEDE BORRARSE';
            // }
            // die();

                if($fechaTurno <= date('Y-m-d')){
                    $dni = $_POST['dni'];
                    $idTurno = $_POST['idTurno'];
                    $idProfesional = $_POST['idProfesional'];
                    $fechaCierre = date('Y-m-d');
                    $impPago = (double)$_POST['pago'];
                    $saldo = str_replace(',','',str_replace('$','',$_POST['saldo']));
                    $pago = str_replace(',','',str_replace('$','',$_POST['pago']));
                    $impSaldo = $saldo - $pago;
    
                    //hacer el update con el estado de cierre del turno
                    $sql = "update TURNOS set estado =:est where id =:idTurno";
                    $p = db::conectar()->prepare($sql);
                    $p->bindValue(':est', $_POST['estadoCierreTurno']);
                    $p->bindValue(':idTurno', $_POST['idTurno']);
                    $p->execute();
                    if($p) {
                        $p = null;
                        //hacer el update con el resultado del saldo del paciente
                        $sql = "update PACIENTES set saldo =:impSaldo where dni =:dni";
                        $p = db::conectar()->prepare($sql);
                        $p->bindValue(':impSaldo', $impSaldo);
                        $p->bindValue(':dni', $_POST['dni']);
                        $p->execute();
                        if($p) {
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
                            $p->execute();
                            if($p) {
                                if($origenCierre == "general") {
                                    header ("Location: ./turnosGeneral.php");
                                } else {
                                    header ("Location: ./turnosProfesional.php");
                                }
                            }
                        }
                    } else {
                        echo 'no se cerro el turno';
                    }
                } else {
                    $_SESSION['error'] = 'no puede cerrarse un turno futuro';
                    if($origenCierre == "general") {
                        header ("Location: ./turnosGeneral.php");
                    } else {
                        header ("Location: ./turnosProfesional.php");
                    }
                }
            }
        break;

        // borrado de paciente
        case 'delete':
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $fechaTurno = substr($_POST['turnoDesde'], 0, 10);
                if($fechaTurno > date('Y-m-d')) {
                    try {
                        $sql = "delete from turnos where id = $id";
                        $p = db::conectar()->prepare($sql);
                        $p->execute();
                        // header ("Location: ./turnosProfesional.php");
                    } catch (PDOException $error1) {
                        echo $error1->getMessage();
                    } catch (Exception $error1) {
                        echo $error2->getMessage();
                    }
                } else {
                    $_SESSION['error'] = 'no puede eliminarse un turno anterior a hoy';
                }
            }
            header ("Location: ./turnosProfesional.php");
        break;



    }
?>