<?php
    session_start();
    $usuario = $_SESSION['usuario'];
    $usuario_tipo = $_SESSION['usuario_tipo'];
    $profesional = $_SESSION['profesional'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    usuario: <?php echo $usuario; ?><br>
    tipo: <?php echo $usuario_tipo; ?><br>
    profesional: <?php echo $profesional; ?><br>
</body>
</html>