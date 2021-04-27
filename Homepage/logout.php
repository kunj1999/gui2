<!-- 
    File: /Homepage/logout.php
    E-Tutor
    Kunj Patel, UMass Lowell Computer Science, kunj_patel@student.uml.edu
    Sean Gillis, UMass Lowell Computer Science, sean_gillis1@student.uml.edu
    Copyright (c) 2021 Kunj Patel, Sean Gillis. All rights reserved.

    Last Modified: 04/26/2021
 -->

<?php

    // Destroy session data and redirect the user to landing page
    session_start();
    session_destroy();
    header("Location: ../index.html");
?>