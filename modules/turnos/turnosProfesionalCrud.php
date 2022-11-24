<?php
    session_start();
    require_once("../db/dbConnection.php");
    // $objeto = new Conexion();
    // $conexion = $objeto->Conectar();


$apellido = (isset($_POST['apellido'])) ? $_POST['apellido'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$dni = (isset($_POST['dni'])) ? $_POST['dni'] : '';
$direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';


switch($opcion){
    case 1:
        // $consulta = "INSERT INTO personas (apellido, nombre, dni, direccion) VALUES ('$apellido', '$nombre', '$dni', '$direccion')";			
        // $resultado = $conexion->prepare($consulta);
        // $resultado->execute(); 
        
        // $consulta = "select personas.id,apellido,personas.nombre,dni,direccion,coberturas.nombre as cobertura,c1numero 
        //                 from personas left join coberturas ON
        //                 personas.cobertura1 = coberturas.id
        //                 order by apellido,personas.nombre";
        // $resultado = $conexion->prepare($consulta);
        // $resultado->execute();
        // $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        // break;    

    case 2:        
        // $consulta = "UPDATE personas SET apellido = '$apellido', nombre = '$nombre', dni = '$dni', direccion ='$direccion' ' WHERE id = '$id' ";		
        // $resultado = $conexion->prepare($consulta);
        // $resultado->execute();        
        
        // $consulta = "SELECT * FROM usuarios WHERE id = '$id' ";       
        // $resultado = $conexion->prepare($consulta);
        // $resultado->execute();
        // $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        // break;

    case 3:        
        // $sql = $consulta = "DELETE FROM turnos WHERE id =:idTurno";		
        // $p = db::conectar()->prepare($sql);
        // $p->bindValue(':idTurno', $id);
        // $p->execute();
        // $resultado = $p->fetchAll(PDO::FETCH_ASSOC);
        //     break;

    // esta consulta se devuelve al formulario personas.php para poblar el datatable
    case 4:
        $sql = "select turnos.id,pacientes.dni,concat(pacientes.apellido,' ',pacientes.nombre) as title,description,
        date_format(start, '%d/%m/%Y ( %H:%i )') as start,
        date_format(end, '%d/%m/%Y ( %H:%i )') as end, estado
        from turnos
        inner join pacientes on
        turnos.dni = pacientes.dni
        where profesional =:profesional
        and date(start) >= :hoy";
        // $sql = "select turnos.id,turnos.profesional,pacientes.dni,concat(pacientes.apellido,' ',pacientes.nombre) as title,description,start,end 
        // from turnos
        // inner join pacientes on
        // turnos.dni = pacientes.dni
        // where profesional =:profesional";
        $p = db::conectar()->prepare($sql);
        $p->bindValue(':profesional', $_SESSION['profesional']);
        $p->bindValue(':hoy', date('Y/m/d'));
        $p->execute();
        $resultado=$p->fetchAll(PDO::FETCH_ASSOC);
        break;

    case 5:    
        $sql = "select turnos.id,pacientes.dni,concat(pacientes.apellido,' ',pacientes.nombre) as title,description,
        date_format(start, '%d/%m/%Y ( %H:%i )') as start,
        date_format(end, '%d/%m/%Y ( %H:%i )') as end
        from turnos
        inner join pacientes on
        turnos.dni = pacientes.dni
        where profesional =:profesional and estado = ''";
        $p = db::conectar()->prepare($sql);
        $p->execute();
        $resultado=$p->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($resultado, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;