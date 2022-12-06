<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">


  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <!-- con estas referencias logre que el hosting reconociera el fullcalendar   -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.css">
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.js"></script>




  <!-- Bootstrap CSS v5.2.0-beta1 -->
  <link rel="stylesheet" href="./css/bootstrap.min.css" >
  <link rel="stylesheet" href="./css/datatables.min.css" >
  <link rel="stylesheet" href="./css/bootstrap-clockpicker.css" >
  <link rel="stylesheet" href="./fullcalendar/main.css" >


  <!-- full calendar -->   
  <script src="js/jquery-3.6.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/datatables.min.js"></script>
  <script src="js/bootstrap-clockpicker.js"></script>
  <script src="js/moment-with-locales.min.js"></script>
  <script src="fullCalendar/main.js"></script>
  <script src="fullCalendar/locales-all.min.js"></script>

</head>
<body>

    <?php require_once("../../assets/pages/navBar.php") ?>

    <?php include "evento.php"; ?>
    <?php include "eventoInfo.php"; ?>

    <?php
        $nombre_profesional = $_GET['nombre'];
    ?>
    <h3>profesional: <?php echo $nombre_profesional ?></h3>
    
    <!-- definicion del calendario -->
    <div class="container">
        <!-- <div class="col-md-11 offset-md-2"> -->
        <div class="col-md-12">
            <div id='calendar'></div>
        </div>
    </div>

    <script>

        var value = getParameterByName('p');
        var consultaListado = 'datosEventos.php?accion=listar&p=' + value

        // https://stackoverflow.com/questions/69136421/remove-or-hide-a-specific-date-in-fullcalendar-v5
        var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {

                events: consultaListado,
                initialView: 'timeGridWeek',

                // No muestro los fines de semana
                weekends: false,
                hiddenDays: [0, 6],

                // Hora minima y maxima en la que se van a mostrar los eventos, con 30 minutos de separacion
                timeFormat: 'H:mm',
                axisFormat: 'HH:mm',
                slotMinTime: '08:00',
                slotMaxTime: '21:00',

                locale:"es",
                headerToolbar:{
                    left:'prev,next today',
                    center:'title',
                    right:'dayGridMonth,timeGridWeek,timeGridDay',
                    },

                dateClick: function(info){ //detecta click en la casilla del calendario
                    // recuperamos la informacion del dia que seleccionamos
                    limpiarFormulario();
                    //detectar click en un evento o en cualquier parte del dia
                    if (info.allDay) {
                        $('#fechaInicio').val(info.dateStr);  //inserta la fecha que se selecciona en el click
                        $('#fechaFin').val(info.dateStr);
                    } else {
                        let fechaHora = info.dateStr.split("T");
                        $('#fechaInicio').val(fechaHora[0]);
                        $('#fechaFin').val(fechaHora[0]);
                        $('#horaInicio').val(fechaHora[1].substring(0,5));
                        $('#horaFin').val(fechaHora[1].substring(0,5));
                    }
                    $('#formularioEventos').modal('show');
                },
                // se ejecuta cuando hacemos click en un evento existente
                eventClick: function(info){
                    //seteamos botones a mostrar
                    $('#botonAgregar').hide();
                    $('#botonBorrar').show();
                    
                    //recuperamos informacion
                    $("#id").val(info.event.id);
                    //recupero nombre del paciente
                    $("#infoTitulo").val(info.event.title);
                    //las fechas/horas las recuperamos directamente desde el calendario, no de la DB
                    $("#infoFechaInicio").val(moment(info.event.start).format("YYYY-MM-DD"));
                    //el formato para los minutos debe ser minuscula (mm)
                    $("#infoHoraInicio").val(moment(info.event.start).format("HH:mm"));
                    //las fechas las recuperamos directamente desde el calendario, no de la DB
                    $("#infoFechaFin").val(moment(info.event.end).format("YYYY-MM-DD"));
                    //el formato para los minutos debe ser minuscula (mm)
                    $("#infoHoraFin").val(moment(info.event.end).format("HH:mm"));
                    //extendedProps (porque tiene mas de 1 linea)
                    $("#infoDescripcion").val(info.event.extendedProps.description);  
                    $("#infoColorFondo").val(info.event.backgroundColor);
                    $("#infoColorTexto").val(info.event.textColor);
                    //mostramos el formulario
                    // $('#formularioEventos').modal('show');
                    $('#informacionEvento').modal('show');
                }
            });
            calendar.render();

            // abre una fecha especifica
            // calendar.gotoDate("2015-10-05");

            //eventos de botones de la aplicacion
            // control del evento click sobre el boton AGREGAR
            $('#botonAgregar').click(function(){
                let registro = recuperarDatosFormulario();
                let validado = validarEvento(registro);
                if(validado){ //si las validaciones estan correctas, se agrega el turno
                    agregarRegistro(registro);
                    $('#formularioEventos').modal('hide');
                }
            });

            // control del evento click sobre el boton BORRAR
            $("#infoBotonBorrar").click(function(){
                //recuperamos los datos del formulario que previamente los levanto del calendario
                let registro = recuperarDatosFormulario();
                borrarRegistro(registro);
                $('#informacionEvento').modal('hide');
            })

            // valido el registro del turno para ver si puede grabarse
            function validarEvento(registro) {
                var estado = true;
                var paciente = registro.titulo;
                var fechaDesde = registro.inicio;
                var fechaHasta = registro.fin;
                console.log(fechaDesde);
                console.log(fechaHasta);
                // var horaDesde = fechaDesde.substring(11,16);
                // var horaHasta = fechaHasta.substring(11,16);
                
                // obtengo fecha actual
                let date = new Date();
                let day = `${(date.getDate())}`.padStart(2,'0');
                let month = `${(date.getMonth()+1)}`.padStart(2,'0');
                let year = date.getFullYear();
                let hora = `${(date.getHours())}`;
                let minuto = `${(date.getMinutes())}`;
                let fechaHoraActual = `${year}-${month}-${day} ${hora}:${minuto}`;
                // console.log(`${year}-${month}-${day} ${hora}:${minuto}`);
                
                // valido que no se asigne un turno anterior a ahora
                if(fechaDesde < fechaHoraActual) {
                    alert('no puede asignarse un turno anterior');
                    estado = false;
                }

                // valido que no este vacia la seleccion de paciente
                if(paciente == '') {
                    alert('el campo paciente no puede estar vacio');
                    estado = false;
                }
                
                // valido que la fecha desde y fecha hasta sean iguales (mismo dia)
                if(fechaDesde != fechaHasta){
                    alert('la fecha/hora desde y hasta del turno deben ser iguales')
                    estado = false;
                }

                // valido que la hora hasta no sea menor a la hora desde
                // if(horaHasta < horaDesde){
                //     alert('la hora de finalizacion del turno no puede ser menor a la de inicio');
                //     estado = false;                  
                // }

                return estado;
            }

            //funcion ajax para dar de alta el registro
            function agregarRegistro(registro) {
                $.ajax({
                type: 'POST',
                url: 'datosEventos.php?accion=agregar',
                data: registro,
                success: function(msg){
                    calendar.refetchEvents(); //si se ejecuto el alta, recarga el calendario
                },
                error: function(error){
                    alert('se produjo un error al agregar el evento :' + error);
                }
                })
            }

            //funcion ajax para borrar el registro
            function borrarRegistro(registro){
                $.ajax({
                type: 'POST',
                url: 'datosEventos.php?accion=borrar',
                data: registro,
                success: function(msg){
                    calendar.refetchEvents(); //si se ejecuto el alta, recarga el calendario
                },
                error: function(error){
                    alert('se produjo un error al borrar el evento :' + error);
                }
                })         
            }

            //funciones que interactuan con el formulario de eventos
            function limpiarFormulario(){
            $('#id').val('');
            $('#titulo').val('');
            $('#descripcion').val('');
            $('#fechaInicio').val('');
            $('#fechaFin').val('');
            $('#horaInicio').val('');
            $('#horaFin').val('');
            $('#colorFondo').val('#3788D8'); 
            $('#colorTexto').val('#FFFFFF'); 
            $('#botonAgregar').show();
            $('#botonModificar').hide();
            $('#botonBorrar').hide();
            }

            //funcion para recuperar los datos del formulario EVENTO.PHP
            //y pasarlo como parametro POST datosEventos.php para el alta
            function recuperarDatosFormulario(){
                let registro = {
                    id: $('#id').val(),
                    profesional: value,
                    dni: $('#titulo').val(), //devuelve el value del campo de seleccion, no el texto
                    titulo: $('#titulo option:selected').text(), //devuelve el texto del campo de seleccion
                    descripcion: $('#descripcion').val(),
                    inicio: $('#fechaInicio').val() + ' ' + $('#horaInicio').val(),
                    fin: $('#fechaFin').val() + ' ' + $('#horaFin').val(),
                    colorFondo: $('#colorFondo').val(),
                    colorTexto: $('#colorTexto').val()
                }

                // alert('id: ' + registro.id);
                // alert('id profesional: ' + registro.profesional);
                // alert('dni: ' + registro.dni);
                // alert('titulo ' + registro.titulo);
                // alert('descripcion ' + registro.descripcion);
                // alert('inicio ' + registro.inicio);
                // alert('fin ' + registro.fin);
                // alert('color fondo ' + registro.colorFondo);
                // alert('color texto ' + registro.colorTexto);

                return registro;
                }


            // funcion para obtener el parametro desde la URl con javascript
            function getParameterByName(name) {
                name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
                results = regex.exec(location.search);
                return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
            }
        </script>

    <script type="text/javascript" src="./calendario.js"></script>  

</body>
</html>
