<?php
    // If the session already exists, redirect the user to proper webpage
    session_start();
    if(isset($_SESSION['username'])) {
        header("Location: Homepage/home.php");
        die();
    }


    require_once 'Debug.php';
    require_once 'userInDb.php';

    $err = "";
    
    // When the form submission occurs, proceed to registring the user
    if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
        echo logConsole(gettype($_POST['startTime']));
        if(user_registration($_POST, $err)){
            header("Location: Homepage/home.php");
            die();
        }
        unset($_POST);
    }
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E-Tutor</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="index.css">
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
                            <a class="nav-link text-light" href="signIn.php">Sign In</a>
                        </li>
                        <!-- Navigation to registration Page -->
                        <li class="nav-item ml-2">
                            <a class="btn btn-primary" href="signUp.php" role:"button">Sign Up</a>
                        </li>
                    </ul>

                </nav>
            </div>

            <div class="container">
                <!-- Sign up Form -->
                <form class="signUpForm text-center center p-3" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                    <h5 class="mt-2 mb-4">Sign Up</h5>
                    <!-- Error message if something goes wrong -->
                    <span class="text-danger"><?php echo $err; ?></span> <br>

                    <!-- Input boxes for first and last name -->
                    <label class= "mr-3 col-2">Name</label>
                    <input type="text" class="mt-2 mb-2 w-25 signUpInputBox" name="FirstName" placeholder="First Name" required>
                    <input type="text" class="mt-2 mb-2 w-25 signUpInputBox" name="LastName" placeholder="Last Name" required> <br>

                    <!-- Input box for entering email -->
                    <label class= "mr-3 col-2">Email</label>
                    <input type="email" class="mt-2 mb-2 w-50 signUpInputBox" name="Email" placeholder="Email" required><br>

                    <!-- Password -->
                    <label class= "mr-3 col-2">Password</label>
                    <input type="password" class="mt-2 mb-2 w-50 signUpInputBox" name="password" placeholder="password" required><br>

                    <!-- Radio button for selecting if a person signing up is a tutor -->
                    <span class="mr-3">Are you a Tutor?</span>
                    <input type="radio" id="yes" name="Tutor" value="yes"><label class="mr-2" for="yes">Yes</label>
                    <input type="radio" id="no" name="Tutor" value="no"><label for="no">No</label> <br>

                    <div id="tutor-settings">
                        <!-- Subjects a person is interested in tutoring -->
                        <label class= "mr-3 col-2">List subjects you tutor</label>
                        <input type="text" class="mt-2 mb-2 w-50 signUpInputBox" name="subjects"><br>

                        <!-- Zoom link to attend the virtual session -->
                        <label class="mr-3 col-2"> Zoom Link </label>
                        <input type="url" class= "mt-2 mb-2 w-50 signUpInputBox" name="ZoomLink"><br>

                        <!-- Entering the schedule: Day of the week, start and end time -->
                        <label class="mr-3 col-2"> Schedule </label><br>
                        <select class="col-2" id="day" name="day">
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                        </select>
                        <label class="mr-1">start</label><input type="time" class= "col-2" name="startTime">
                        <label class="mr-1">end</label><input type="time" class= "col-2" name="endTime"><br>
                    </div>

                    <!-- Form submission  -->
                    <button type="submit" class="btn-primary mt-2 mb-2"> Sign Up</button> <br> <br>

                    <!-- Link to navigate to login page -->
                    <span> Already have an account? <a class="text-primary" href="signIn.php">Sign In</a></span>
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
