<!--
    File: /Homepage/calendar/calendar.php
    E-Tutor
    Kunj Patel, UMass Lowell Computer Science, kunj_patel@student.uml.edu
    Sean Gillis, UMass Lowell Computer Science, sean_gillis1@student.uml.edu
    Copyright (c) 2021 Kunj Patel, Sean Gillis. All rights reserved.

    Last Modified: 04/26/2021
-->

<?php

    require_once '../../Database/sqlConn.php';
    require_once '../../Debug.php';


    // If the user hasn't been authenticated, deny entry to this page
    session_start();
    if(!isset($_SESSION['username'])) {
        header("Location: ../../signIn.php");
        die();
    }
    
    // Get registered session for current user
    $result = search_registration_table($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E-Tutor</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="../navbar.css">
        <link rel="stylesheet" href="calendar.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.1/main.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    </head>

    <body>

        <div>

            <!-- include navbar code -->
            <?php include("../navbar.php");?>

        </div>

        <!-- This is where the calendar will be generated -->
        <div class="col-12 mt-2" id='calendar'></div>

        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.1/main.min.js"></script>
         <!-- Jquery -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <!-- Bootstrap Javascript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

        <script src="calendar.js"></script>

        <script>
            $(document).ready(function() {
                // Get the data from php and pass it to the function that will generate the calendar
                var timeslots = <?php echo json_encode($result); ?>;
                displayCalendar(timeslots);
            });
        </script>
    </body>
</html>