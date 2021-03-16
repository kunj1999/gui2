<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E-Tutor</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="home.css">
    </head>

    <body>

        <div>

            <!-- Nav bar containing website logo and sign in and sign up options -->
            <nav class="navbar col-12">
                
                <a class="navbar-brand" href="index.html">
                    <!-- Website Logo -->
                    <img src="../logo.png" class="logoSize">
                </a>

                <!-- search bar embedded in nav bar -->
                <form class="search ml-3">
                    <input class="searchbar ml-2">
                </form>

                <ul class="navbar-nav ml-auto auth">
                    <!-- Navigation to Login page -->
                    <li class="nav-item">
                        <a class="nav-link text-light" href="calendar.php">Calendar</a>
                    </li>
                    <!-- Navigation to registration Page -->
                    <li class="nav-item">
                        <a class="nav-link text-light ml-4" href="index.html">Log out</a>
                    </li>
                </ul>

            </nav>

            <!-- Main contents of page -->
            <div class="container text-center center mt-5 p-3">
                
                <!--  Website logo -->
                <img src="../logo.png">

                <!-- Main page text -->
                <h1 class="mt-5">Welcome First Name</h1>
                <p class="mb-0 mt-5">Looking for help?</p>
                <p class="mb-5">Search from thousands of tutors</p>

                <!-- Search bar -->
                <form class="search">
                    <input class="searchbar">
                    <input class="searchbutton pl-4 pr-4" type="button" value="Search">
                </form>
            </div>

        </div>

        <!-- Jquery -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <!-- Bootstrap Javascript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <!-- Javascript -->
        <script src="signUp.js"></script>
        <script>

            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        </script>
    </body>

</html>