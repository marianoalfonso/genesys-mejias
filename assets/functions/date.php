<?php

// devuelve la edad en base a la fecha de nacimiento
function calcularEdad($fec_nac) {
    $nacimiento = new DateTime($fec_nac);
    $ahora = new DateTime(date("Y-m-d"));
    $diferencia = $ahora->diff($nacimiento);
    return $diferencia->format("%y");
}


?>