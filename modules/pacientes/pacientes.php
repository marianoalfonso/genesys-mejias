<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">  

    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="pacientes.css">  

</head>
<body>

    <?php require('../db/dbConnection.php'); ?>


    <div class="form-group">
        <br/>
            <!-- boton para form modal (habilitar con la refactorizacion) -->
            <!-- <button id="btnNuevo" type="button" class="btn btn-warning" data-toggle="modal">agregar paciente</button>     -->
            <a href="personaAdd.php" class="btn btn-warning">agregar paciente</a>
        <br/><br/>
    </div>

    <div class="container caja">
        <div class="row">
            <div class="col-lg-12">
            <div class="table-responsive">        
                <table id="tablaPacientes" class="table table-striped table-bordered table-condensed" style="width:100%" >
                    <thead class="text-center">
                        <tr>
                            <th>id</th>
                            <th>apellido</th>
                            <th>nombre</th>                                
                            <th>dni</th>  
                            <th>direccion</th>
                            <th>cobertura</th>
                            <th>socio</th>
                            <th>reint</th>
                            <th>acciones</th>
                        </tr>
                    </thead>
                    <tbody>                           
                    </tbody>        
                </table>               
            </div>
            </div>
        </div>  
    </div>   

    <script src="../../assets/js/jquery-3.6.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="pacientes.js"></script>  
    <script>

        $(document).ready(function() {
            $('#tablaPacientes').DataTable( {
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-AR.json'
                }
            } );
        } );
    </script>
    
</body>
</html>