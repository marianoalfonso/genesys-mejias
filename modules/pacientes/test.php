<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h2>test.php</h2>

    <?php
        require_once('../db/dbConnection.php');

        $sql = "select * from pacientes where id = 2 limit 1";
        $p = db::conectar()->prepare($sql);
        $p->execute();
        $result = $p->fetchAll(PDO::FETCH_ASSOC);
        var_dump($result);
        if($result){
            echo $result[0]['apellido'];
        } else {
            echo 'sin datos';
        }
        


    ?>

</body>
</html>