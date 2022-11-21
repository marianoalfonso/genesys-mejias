<!-- libera el bloqueo de la tabla PROFESIONALES del usuario que esta abandonando la sesion -->
<?php
    session_start();
    require('../db/dbConnection.php');
    $sql = "update profesionales set prf_bloqueo = null where prf_bloqueo =:dni";
    $p = db::conectar()->prepare($sql);
    $p->bindValue(':dni',$_SESSION['usuario_dni']);
    $p->execute();
    if($p){
        header ('Location: http://localhost/genesys-mejias/modules/login/login.php');
    } else {
        header ('Location: http://localhost/genesys-mejias/assets/pages/error.php');
    }

    unset(
        $_SESSION['usuario'],
        $_SESSION['usuario_dni'],
        $_SESSION['usuario_tipo'],
        $_SESSION['profesional'],
        $_SESSION['validate'],
        $_SESSION['profesional_nombre']
    );

?>



$_SESSION['usuario'] = $result['usr_nombre'];
$_SESSION['usuario_dni'] = $dni;
$_SESSION['usuario_tipo'] = $result['tipo_descripcion'];
$_SESSION['profesional'] = $profesional;
$_SESSION['validate'] = true;
$_SESSION['profesional_nombre'] = $datos[0].['prf_nombre'];