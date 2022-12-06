<?php

// todo lo que devuelve este modulo lo devuelve a traves de json
header('Content-Type: application/json');
require_once("../db/dbConnection.php");


switch ($_GET['accion']) {
    case 'listar':
        $sql = "select
                    id,profesional,dni,
                    title,description,
                    start,end,
                    textColor,backgroundColor
                from turnos 
                where profesional = $_GET[p]";
        $p = db::conectar()->prepare($sql);
        $p->execute();
        $resultado = $p->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        break;

    case 'agregar':
        $sql = "insert into
                        turnos (
                            profesional,
                            dni,
                            title,
                            description,
                            start,
                            end,
                            textColor,
                            backgroundColor
                            )
                        values (
                            '$_POST[profesional]',
                            '$_POST[dni]',
                            '$_POST[titulo]',
                            '$_POST[descripcion]',
                            '$_POST[inicio]',
                            '$_POST[fin]',
                            '$_POST[colorTexto]',
                            '$_POST[colorFondo]'
                            )";
        $p = db::conectar()->prepare($sql);
        $p->execute();

        // $respuesta = mysqli_query($conexion, $consulta);
        echo json_encode($p);
        break;

    case 'modificar':
        $sql = "update
                turnos set
                    title = '$_POST[titulo]',
                    description = '$_POST[descripcion]',
                    start = '$_POST[inicio]',
                    end = '$_POST[fin]',
                    textColor = '$_POST[colorFondo]',
                    backgroundColor = '$_POST[colorTexto]'
                where
                    id = $_POST[id]";
        $p = db::conectar()->prepare($sql);
        $p->execute();
        echo json_encode($p);
        break;

    case 'borrar':
        $sql= "delete from
            turnos
         where
            id = $_POST[id]";
        $p = db::conectar()->prepare($sql);
        $p->execute();
        echo json_encode($p);
        break;

    default:
        # code...
        break;
}


?>