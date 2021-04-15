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
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    </head>

    <body>

        <div>

            <!-- Nav bar containing website logo and calendar and log out options -->
            <nav class="navbar sticky-top col-12">
                
                <a class="navbar-brand" href="../home.php">
                    <!-- Website Logo -->
                    <img src="../../logo.png" class="logoSize">
                </a>

                <!-- search bar embedded in nav bar -->
                <form class="search ml-3" action="../search/search.php" method="GET">
                    <input class="searchbar ml-2 rounded" name="s"/>
                    <button type="submit" class="btn bg-white" style="height: 40px;"><i class="fas fa-search"></i></button>
                </form>

                <ul class="navbar-nav ml-auto auth">
                    <!-- Navigation to calendar page -->
                    <li class="nav-item">
                        <a class="nav-link text-light" href="../calendar/calendar.php">Calendar</a>
                    </li>
                    <!-- Logging out of the account -->
                    <li class="nav-item">
                        <a class="nav-link text-light ml-4" href="../logout.php">Log out</a>
                    </li>
                </ul>

            </nav>

            <!-- Main contents of page -->
            <div class="container center col-6 pt-5 pb-0 pl-4 pr-4 "></div>

        </div>

        <!-- Jquery -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <!-- Bootstrap Javascript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="search.js"></script>
        <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
        </script>

        <script>
        $(document).ready(function() {
            var result = <?php echo json_encode($search_result); ?>;
            displaySearchResult(result);
        });
        </script>
    </body>

</html>