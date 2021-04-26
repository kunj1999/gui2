<?php

    require_once "/var/www/html/gui2/Database/sqlConn.php";
    session_start();

    if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
        addSession($_SESSION['username'], $_POST['startTime'], $_POST['endTime'], $_POST['zoomLink'], $_POST['username']);
        return error_get_last();
    }
?>