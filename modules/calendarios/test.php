<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <link href='../../assets/fullcalendar/lib/main.css' rel='stylesheet' />
    <script src='../../assets/fullcalendar/lib/main.js'></script>
    <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          events: 'datosEventos.php?accion=listar',
          initialView: 'dayGridMonth'
        });
        calendar.render();
      });

    </script>
  </head>
  <body>
    <div id='calendar'></div>
  </body>
</html>