<?php

    require_once("../db/dbConnection.php");

    $dni = $_POST['dni'];
    $saldo = $_POST['saldo'];

    $sql = "update pacientes set saldo = saldo + $saldo where dni = $dni";
    $t = db::conectar()->prepare($sql);
    $t->execute();
    if($t){
        header('Location: pacientesCtaCte.php?dni='.$dni);
    }


?>