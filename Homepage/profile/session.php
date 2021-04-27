<!--
    File: /Homepage/profile/session.php
    E-Tutor
    Kunj Patel, UMass Lowell Computer Science, kunj_patel@student.uml.edu
    Sean Gillis, UMass Lowell Computer Science, sean_gillis1@student.uml.edu
    Copyright (c) 2021 Kunj Patel, Sean Gillis. All rights reserved.

    Last Modified: 04/26/2021
-->

<?php

    require_once "/var/www/html/gui2/Database/sqlConn.php";
    session_start();

    // Handle post request to add session to DB
    if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
        addSession($_SESSION['username'], $_POST['startTime'], $_POST['endTime'], $_POST['zoomLink'], $_POST['username']);
    }
?>