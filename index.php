<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- bootstrap -->
    <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">


</head>
<body>
    <div class="container-fluid">
        <!-- barra de navegacion -->
        <!-- navbar-expand-md (expansion de la barra) -->
        <!-- navbar-light (estilo luminoso) -->
        <!-- border-primary (color azul llamativo) -->
        <nav class="navbar navbar-expand-md navbar-light bg-light border-3 border-bottom border-primary">
            <!-- container-fluid (ocupa todo el ancho disponible) -->
            <div class="container-fluid">
                <a href="#" class="navbar-brand">consultorio Mejias</a>
                <!-- navbar-toggler (alterna entre estado visible o no) -->
                <!-- data-bs-toggle (propiedad a alternar) -->
                <!-- data-bs-target (cual es el elemento objetivo del toggle) -->
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#MenuNavegacion">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div id="MenuNavegacion" class="collapse navbar-collapse">
                    <ul class="navbar-nav ms-3">
                        <!-- menu pacientes -->
                        <li class="nav-item"><a class="nav-link" href="./modules/pacientes/pacientes.php">pacientes</a></li>
                        <!-- menu profesionales -->
                        <li class="nav-item"><a class="nav-link" href="#">profesionales</a></li>
                        <!-- menu desplegable turnos -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">turnos</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">ver calendario</a></li>
                                <li><a class="dropdown-item" href="#">ver turnos</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#">salir</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    </div>
    
    <!-- para el menu dropdown, debe importarse popper antes que bootstrap -->
    <script src="./assets/bootstrap/js/popper.min.js"></script>
    <script src="./assets/bootstrap/js/bootstrap.min.js"></script>
    
</body>
</html>