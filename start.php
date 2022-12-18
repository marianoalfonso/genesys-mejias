
<?php

    echo 'mostrando pagina START.PHP';

    $server = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'mejias';

    try {
        $sql = "select * from profesionales order by 2";
        $conexion_pdo = new PDO("mysql:host=$server; dbname=$db", $user, $pass);
        // $resultados = $conexion_pdo->prepare($sql);
        $resultados = $conexion_pdo->prepare($sql);
        // $resultados->execute();
        $resultados->execute();
        // $datos = $resultados->fetchAll();
        $datos = $resultados->fetchAll();
        foreach ($datos as $row) {
            echo "<br>".$row['prf_nombre'];
        //     var_dump($row);
        }
        require_once("./assets/functions/date.php");
        echo "<br>".calcularEdad('1972-08-08');

    } catch (PDOException $error1) {
        echo $error1->getMessage();
    } catch (Exception $error2) {
        echo $error2->getMessage();
    }


    $saldo = "20.3";
    $saldoFloat = floatval($saldo);
    echo "<br>saldo: ".number_format($saldoFloat,2);
    echo "<br>saldo: ".number_format(floatval($saldo),5);
  
    echo "<br>fecha: ".date('Y/m/d');
?>
<hr><hr>
<?php
    echo 'ejecutando funcion obtenerProximoDni<br>';
    require_once('./assets/functions/date.php');
    $existe = obtenerProximoDni();
    echo $existe;

?>


