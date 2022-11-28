<!-- libera el bloqueo de la tabla PROFESIONALES del usuario que esta abandonando la sesion -->
<?php
    session_start();
    require('../db/dbConnection.php');
    if($_SESSION['action'] == 'login') { //desbloqueo los profesionales asociados a un usuario
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
    } else { //desbloqueo un profesional especifico
        $sql = "update profesionales set prf_bloqueo = null where prf_id =:idProf";
        $p = db::conectar()->prepare($sql);
        $p->bindValue(':idProf',$_GET['id']);
        $p->execute();
        if($p){
            unset(            
                $_SESSION['profesional'],
                $_SESSION['validate'],
                $_SESSION['profesional_nombre']
            );
            header ('Location: http://localhost/genesys-mejias/modules/login/login.php');
        } else {
            header ('Location: http://localhost/genesys-mejias/assets/pages/error.php');
        }
    }
?>