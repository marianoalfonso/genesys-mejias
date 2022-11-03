<?php
$server = 'localhost';
$user = 'root';
$pass = '';
$db = 'mejias';

// $conexion_mysqli = mysqli_connect($server, $user, $pass, $db);
try {
    $conexion_pdo = new PDO("mysql:host=$server; dbname=$db", $user, $pass);
    $conexion_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $error) {
    var_dump($error->getMessage());
}


// $respuesta = $conexion_pdo->query("select * from profesionales");
// foreach ($respuesta as $r) {
//     var_dump($r);
// }

$respuesta = $conexion_pdo->prepare("select * from profesionales");
$respuesta->execute();
$datos = $respuesta->fetchAll();  
foreach ($datos as $r) {
    var_dump($r);
}