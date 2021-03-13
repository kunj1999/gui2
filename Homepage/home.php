<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E-Tutor</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="home.css">
    </head>

    <body class="text-center">
        <div class="bg">

            <div class="container">
                <!-- Nav bar containing website logo and sign in and sign up options -->
                <nav class="navbar navbar-light col-md-12 col-sm-12">
                    <a class="navbar-brand" href="index.html">
                        <!-- Website Logo -->
                        <img src="logo.png">
                    </a>
                    <ul class="navbar-nav ml-auto auth">
                        <!-- Navigation to Login page -->
                        <li class="nav-item">
                            <a class="nav-link text-light" href="calendar.php">Calendar</a>
                        </li>
                        <!-- Navigation to registration Page -->
                        <li class="nav-item ml-2">
                            <a class="btn btn-primary" href="index.html" role:"button">Log out</a>
                        </li>
                    </ul>

                </nav>
            </div>

            <div class="container text-center center p-3">
                <img src="logo.png">

                <h1>Welcome First Name</h1>
                <h2>Looking for help?</h2>
                <h2>Search from thousands of tutors</h2>

                <div>
                    <input class="searchbar">
                    <input class="searchbutton" type="button">
                </div>
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