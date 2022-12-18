<?php

// devuelve la edad en base a la fecha de nacimiento
function calcularEdad($fec_nac) {
    $nacimiento = new DateTime($fec_nac);
    $ahora = new DateTime(date("Y-m-d"));
    $diferencia = $ahora->diff($nacimiento);
    return $diferencia->format("%y");
}

// verifica si en la base de datos existe un dni
function verificarDni($dni) {
    require_once('./modules/db/dbConnection.php');
    $sql = "select count(*) as cantidad from pacientes where dni =:dni";
    $p = db::conectar()->prepare($sql);
    $p->bindValue(':dni', $dni);
    $p->execute();
    $datos = $p->fetchAll(PDO::FETCH_ASSOC);
    foreach($datos as $row) {
        $cantidad =  $row['cantidad'];
    }
    return $cantidad;
}

// devuelve el proximo numero de DNI falso para el alta temporal de paciente
function obtenerProximoDni() {
    require_once('../../modules/db/dbConnection.php');
    $sql = "select obtenerDni()";   //llamo a la funcion almacenada
    $p = db::conectar()->prepare($sql);
    $p->execute();
    return $p->fetchColumn();
}
?>