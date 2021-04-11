function displayCalendar() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    events:[{
        id: '1',
        title: 'kunj',
        start: '2021-04-10 13:00:00',
        end: '2021-04-10 13:30:00',
        notes: "https://www.php.net/manual/en/function.date.php"
    }],
    eventClick: function(info) {
        info.jsEvent.preventDefault();
        window.open(info.event._def.extendedProps.notes, "_blank");
    }
    });
    calendar.render();
}