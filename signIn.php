<?php
    // If the session already exists, redirect the user to proper webpage
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tutor Anywhere</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="index.css">
    </head>

    <body class="text-center">
        <div class="bg">
            <div class="container">
                <!-- Nav bar containing website logo and sign in and sign up options -->
                <nav class="navbar navbar-light col-md-12 col-sm-12">
                    <a class="navbar-brand" href="index.html">
                        <!-- Insert website logo here -->
                        <span>Tutor Anywhere</span>
                    </a>
                    <ul class="navbar-nav ml-auto auth">
                        <li class="nav-item">
                            <a class="nav-link text-light" href="signIn.php">Sign In</a>
                        </li>
                        <li class="nav-item ml-2">
                            <a class="btn btn-primary" href="signUp.php" role:"button">Sign Up</a>
                        </li>
                    </ul>

                </nav>
            </div>

            <div class="container">
                <!-- Sign in form that will take input of username and password -->
                <form class="signInForm text-center center ">
                    <h5 class="mt-2 mb-4">Sign In</h5>
                    <span class="text-danger"></span>
                    <input type="text" class="mt-2 mb-2" name="username" placeholder="Username" required>
                    <input type="password" class="mt-2 mb-2" name="passowrd" placeholder="Password" required>
                    <button type="submit" class="btn-primary mt-2 mb-2"> Sign In</button> <br> <br>
                    <span> Don't have an account? <a class="text-primary" href="signUp.php">Sign Up</a></span>
                </form>
            </div>

        </div>

        <!-- Jquery -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <!-- Bootstrap Javascript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    </body>

</html>
