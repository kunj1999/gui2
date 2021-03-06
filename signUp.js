// File: signUp.js
// E-Tutor
// Kunj Patel, UMass Lowell Computer Science, kunj_patel@student.uml.edu
// Sean Gillis, UMass Lowell Computer Science, sean_gillis1@student.uml.edu
// Copyright (c) 2021 Kunj Patel, Sean Gillis. All rights reserved.
// Last Modified: 04/26/2021

$(document).ready(function()
{
    // Function handler for if the radio buttons; yes or no are selected
    $("#yes, #no").change(function()
    {
        // If yes, show the tutor settings
        if(this.value == "yes")
        {
            $("#tutor-settings").show();
            $("#tutor-settings :input").prop('required', true);
        }
        else // If no, hide the tutor settings
        {
            $("#tutor-settings").hide();
            $("#tutor-settings :input").prop('required', false);
        }
    });

    $("#signUp").submit( function(e) {
        var start = $("#startTime").val();
        var end = $("#endTime").val();

        $("#timeValidation").empty();

        if (start > end) {
            $("#timeValidation").append('Start time must come before end time');
            e.preventDefault();
        }

        var password = $("#password").val();

        if (password.length < 8) {
            $("#displayError").empty();
            $("#displayError").append("Password must be at least 8 characters!");
            e.preventDefault();
        }
    });

});