<?php
    // If the session already exists, redirect the user to proper webpage
    session_start();
    if(isset($_SESSION['username'])) {
        header("Location: Homepage/home.php");
        die();
    }

    require_once "Debug.php";
    require_once "userInDb.php";

    $err = "";

    // If proceed to user authentication only if there is post request
    if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
        $dataCap = $_POST;

        // Check the email password against the database and respond accordingly
        if (user_authenticated($dataCap['email'], $dataCap['password'], $err)) {
            header("Location: Homepage/home.php");
            die();
        }

        unset($dataCap);
    }
    
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E-Tutor</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    </head>

    <body class="text-center">
        <div class="bg">
            <div class="container">
                <!-- Nav bar containing website logo and sign in and sign up options -->
                <!-- Code derived from  https://getbootstrap.com/docs/4.0/components/navbar/-->
                <nav class="navbar navbar-expand-sm navbar-light bg-transparent">
                    <a class="navbar-brand" href="index.html">
                        <!-- Insert website logo here -->
                        <img src="logo.png">
                    </a>

                    <button type="button" class="btn btn-navbar navBtn bg-light" data-toggle="collapse" data-target=".navbar-collapse">
                        <i class="fas fa-bars fa-2x"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarText">
                      <ul class="navbar-nav ml-auto">
                        <!-- Link to the sign in page -->
                        <li class="nav-item active">
                          <a class="nav-link text-light" href="signIn.php">Sign In</a>
                        </li>
                        <!-- Link to the sign up page -->
                        <li class="nav-item">
                          <a class="btn btn-primary nav-link text-light" href="signUp.php">Sign Up</a>
                        </li>
                      </ul>
                      
                    </div>
                </nav>

                <hr class="bg-white m-0"/>
            </div>

            <div class="container">
                <!-- Sign in form that will take input of email and password -->
                <form action="<?php echo $_SERVER['PHP_SELF']?>" class="signInForm text-center center pt-4 pb-4 rounded" method="post">
                    <h4 class="mb-4 font-weight-bold">Sign In</h4>
                    <span class="text-danger"><?php echo $err;?></span>
                    <input type="email" class="form-control-lg mt-2 mb-2 col-10 col-sm-8 inputBox" name="email" placeholder="email" required><br>
                    <input type="password" class="form-control-lg mt-2 mb-2 col-10 col-sm-8 inputBox" name="password" placeholder="Password" required><br>
                    <button type="submit" class="form-control-lg btn-primary mt-2 mb-2 col-10 col-sm-8 inputBox"> Sign In</button> <br> <br>

                    <!-- Another link to navigate to registration page -->
                    <span> Don't have an account? <a class="text-primary" href="signUp.php">Sign Up</a></span>
                </form>
            </div>

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
