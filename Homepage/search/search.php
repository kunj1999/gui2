<!--
    File: /Homepage/search/search.php
    E-Tutor
    Kunj Patel, UMass Lowell Computer Science, kunj_patel@student.uml.edu
    Sean Gillis, UMass Lowell Computer Science, sean_gillis1@student.uml.edu
    Copyright (c) 2021 Kunj Patel, Sean Gillis. All rights reserved.

    Last Modified: 04/26/2021
-->

<?php 

    require_once '../../Debug.php';
    require_once '../../Database/sqlConn.php';

    // If the user hasn't been authenticated, deny entry to this page
    session_start();
    if(!isset($_SESSION['username'])) {
        header("Location: ../signIn.php");
        die();
    }

    $search_result = NULL;

    // If this webpage was requested via GET request, we for the keyward user passed in our DB
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        $search_result = search_keyword_in_sql($_GET['s']);
    }
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E-Tutor</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="search.css">
        <link rel="stylesheet" href="../navbar.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    </head>

    <body>

        <div>

            <!-- Include the navbar code  -->
            <?php include("../navbar.php");?>

            <!-- Main contents of page -->
            <div class="container center col-12 col-sm-6 pt-5 pb-0 pl-4 pr-4 ">

                <!-- https://getbootstrap.com/docs/4.0/components/dropdowns/ -->
                <div class="dropdown">
                    <span class="btn bg-transparent" id="sortByMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sort by <i class="fas fa-angle-down"></i>
                    </span>

                    <!-- Sort by interface (not funtional. coming Soon!) -->
                    <div class="dropdown-menu" aria-labelledby="sortByMenu">

                        <a class="dropdown-item" href="#">Highest rating first</a>
                        <a class="dropdown-item" href="#">Lowest rating first</a>
                        <a class="dropdown-item" href="#">Lowest price first</a>
                        <a class="dropdown-item" href="#">Highest price first</a>
                        
                    </div>
                </div>
            </div>

        </div>

        <!-- Jquery -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <!-- Bootstrap Javascript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="search.js"></script>
        <script>
            // prevent form submission on reload
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        </script>

        <script>
            // Results we got from DB passed to a function to be displayed to user
            $(document).ready(function() {
                var result = <?php echo json_encode($search_result); ?>;
                displaySearchResult(result);
            });
        </script>
    </body>

</html>