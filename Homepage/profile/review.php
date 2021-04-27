<!--
    File: /Homepage/profile/review.php
    E-Tutor
    Kunj Patel, UMass Lowell Computer Science, kunj_patel@student.uml.edu
    Sean Gillis, UMass Lowell Computer Science, sean_gillis1@student.uml.edu
    Copyright (c) 2021 Kunj Patel, Sean Gillis. All rights reserved.

    Last Modified: 04/26/2021
-->

<?php

    require_once "/var/www/html/gui2/Database/sqlConn.php";
    // Handle post request to add review to DB
    if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
        addReview($_POST['username'], $_POST['comment'], $_POST['fiveRating']);
    }
?>