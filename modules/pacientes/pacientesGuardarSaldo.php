<?php

    require_once("../db/dbConnection.php");

    $dni = $_POST['dni'];
    $pago = $_POST['saldo'];
    $descripcion = $_POST['descripcion'];
    $fecha = date('Y-m-d');

    $sql = "update pacientes set saldo = saldo + $pago  where dni = $dni";
    $t = db::conectar()->prepare($sql);
    $t->execute();


    $sql = "insert into CUENTACORRIENTELOG (`ctacte_dni`,
            `ctacte_idTurno`,`ctacte_idProfesional`,`ctaCte_fecha`,
            `ctaCte_importePago`,`ctacte_importeSaldo`,`ctacte_descripcion`) 
            values ($dni, 0, 0, '$fecha', $pago, 0, '$descripcion')";
// echo $sql;
// die();
    $p = db::conectar()->prepare($sql);
    // $p->bindValue(':dni', $dni);
    // $p->bindValue(':idTurno', '0');
    // $p->bindValue('idProfesional', '0');
    // $p->bindValue(':fecha', '');
    // $p->bindValue(':impPago', '');
    // $p->bindValue(':impSaldo', '');
    // $p->bindValue(':descripcion', $descripcion);
    $p->execute();


    if($t){
        header('Location: pacientesCtaCte.php?dni='.$dni);
    }


?>