function displayCalendar(timeSlots) {
    // Get the calendar div
    var calendarEl = document.getElementById('calendar');

    // Generate the daily month calendar with registered events from the database 
    var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    events: formatSlots(timeSlots),
    eventClick: function(info) {
        info.jsEvent.preventDefault();
        window.open(info.event._def.extendedProps.notes, "_blank");
    },
    height: "90%"});

    // Render the calendar
    calendar.render();
}

function formatSlots(registered) {
    var retval = new Array();

    // Generate array of registered sessions (Based on api documentation)
    for (i = 0; i < registered.length; i++) {
        retval.push({
            "id": registered[i][0],
            'title': registered[i][4],
            'start': registered[i][1],
            'end': registered[i][2],
            'notes': registered[i][3]
        });
    }

    return retval;
}