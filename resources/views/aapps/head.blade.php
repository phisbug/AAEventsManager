<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha256-L/W5Wfqfa0sdBNIKN9cG6QA5F2qx4qICmU2VgLruv9Y=" crossorigin="anonymous" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<link href='https://unpkg.com/@fullcalendar/core@4.3.1/main.min.css' rel='stylesheet' />

<link href='https://unpkg.com/@fullcalendar/list@4.3.0/main.min.css' rel='stylesheet' />




<script src="https://unpkg.com/moment@2.24.0/min/moment.min.js"></script>
<script src='https://unpkg.com/@fullcalendar/core@4.3.1/main.min.js'></script>

<script src='https://unpkg.com/@fullcalendar/list@4.3.0/main.min.js'></script>


<script>

  var globalCalendar;

	document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    plugins: [ 'list' ],
    timeZone: 'UTC',
    defaultView: 'listWeek',

    defaultDate: new Date(),
    header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
    events: '/events/load',

    // customize the button names,
    // otherwise they'd all just say "list"
    views: {
      listDay: { buttonText: '' },
      listWeek: { buttonText: 'list week' },
      listMonth: { buttonText: 'list month' }
    },

    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'listDay,listWeek,listMonth'
    },
  });

  globalCalendar = calendar;

  calendar.render();
});
</script>