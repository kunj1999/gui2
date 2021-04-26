<?php

    require_once "/var/www/html/gui2/Database/sqlConn.php";

    if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
        addReview($_POST['username'], $_POST['comment'], $_POST['fiveRating']);
    }
?>