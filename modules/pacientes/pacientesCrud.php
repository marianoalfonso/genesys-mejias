<?php
require('../db/dbConnection.php');

$apellido = (isset($_POST['apellido'])) ? $_POST['apellido'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$dni = (isset($_POST['dni'])) ? $_POST['dni'] : '';
$direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';


switch($opcion){
    case 1:
        $consulta = "INSERT INTO personas (apellido, nombre, dni, direccion) VALUES ('$apellido', '$nombre', '$dni', '$direccion')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "select personas.id,apellido,personas.nombre,dni,direccion,coberturas.nombre as cobertura,c1numero 
                        from personas left join coberturas ON
                        personas.cobertura1 = coberturas.id
                        order by apellido,personas.nombre";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;    

    case 2:        
        $consulta = "UPDATE personas SET apellido = '$apellido', nombre = '$nombre', dni = '$dni', direccion ='$direccion' ' WHERE id = '$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM usuarios WHERE id = '$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;

    case 3:        
        $consulta = "DELETE FROM personas WHERE id = '$id'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;

    // esta consulta se devuelve al formulario personas.php para poblar el datatable
    case 4:    
        $sql = "select personas.id as id,apellido,personas.nombre,dni,direccion,
                    coberturas.nombre as cobertura,c1numero as socio,
                    case reintegro
                        when 0 then 'no'
                        when 1 then 'si'
                    end as reint
                    from personas inner join coberturas ON
                    personas.cobertura1 = coberturas.id
                    order by apellido,personas.nombre";
        $resultado = db::conectar()->prepare($sql);
        $resultado->execute();        
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;