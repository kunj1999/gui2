// File: /Homepage/calendar/calendar.js
// E-Tutor
// Kunj Patel, UMass Lowell Computer Science, kunj_patel@student.uml.edu
// Sean Gillis, UMass Lowell Computer Science, sean_gillis1@student.uml.edu
// Copyright (c) 2021 Kunj Patel, Sean Gillis. All rights reserved.

// Last Modified: 04/26/2021


// @param: sessions from registered table
// @return: (none)
// purpose: display calendar with timeslots from databse
function displayCalendar(timeSlots) {
    // Get the calendar div
    var calendarEl = document.getElementById('calendar');

    // Generate the daily month calendar with registered events from the database 
    var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    events: formatSlots(timeSlots),
    eventClick: function(info) {
        info.jsEvent.preventDefault();
        // When the user clicks time slot, open new webpage with zoom link
        window.open(info.event._def.extendedProps.notes, "_blank");
    },
    height: "90%"});

    // Render the calendar
    calendar.render();
}

// @param: Array of registered sessions
// @return: Array containing well formated timeslots
// purpose: Format timeslots based on api documentation
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