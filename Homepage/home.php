<?php

    // If the user hasn't been authenticated, deny entry to this page
    session_start();
    if(!isset($_SESSION['username'])) {
        header("Location: ../signIn.php");
        die();
    }

    $name = $_SESSION['firstName'];


?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E-Tutor</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="home.css">
        <link rel="stylesheet" href="navbar.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    </head>

    <body>
        
        <!-- Include the navbar code  -->
        <?php include("navbar.php");?>

        <!-- Main contents of page -->
        <div class="container text-center center mt-5 p-3 ">

            <!-- Main page text -->
            <h1 class="mt-5 text-dark">Welcome <?php echo $name;?>! </h1>
            <p class="mb-0 mt-5 text-dark" style="font-size: 20px;">Looking for help?</p>
            <p class="mb-5 text-dark" style="font-size: 20px;">Search from thousands of tutors</p>

            <!-- Search bar -->
            <form class="search" action="search/search.php" method="GET">
                <div class="input-group">
                    <input class="searchbar rounded-left" name="s" required/>
                    <div class="input-group-append">
                        <input type="submit" class="searchbutton pl-4 pr-4 rounded-right" style="height: 33px;" type="button" value="Search">
                    </div>
                </div>
            </form>
        </div>


        <!-- Jquery -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <!-- Bootstrap Javascript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <script>

        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
        </script> 
    </body>

</html>