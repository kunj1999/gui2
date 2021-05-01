<!-- 
    File: signUp.php
    E-Tutor
    Kunj Patel, UMass Lowell Computer Science, kunj_patel@student.uml.edu
    Sean Gillis, UMass Lowell Computer Science, sean_gillis1@student.uml.edu
    Copyright (c) 2021 Kunj Patel, Sean Gillis. All rights reserved.

    Last Modified: 04/26/2021
 -->

<?php
    // If the session already exists, redirect the user to proper webpage
    session_start();
    if(isset($_SESSION['username'])) {
        header("Location: Homepage/home.php");
        die();
    }


    require_once 'Debug.php';
    require_once 'userInDb.php';

    // Will hold error message
    $err = "";
    
    // When the form submission occurs, proceed to registring the user
    if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
        echo logConsole(gettype($_POST['startTime']));

        // If the user registration successful, redirect user to proper webpage
        if(user_registration($_POST, $err)){
            header("Location: Homepage/home.php");
            die();
        }

        // free up the post request data
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

                    <!-- Navbar button that will be displyed when the webpage is accessed from smaller screen -->
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
                <!-- Sign up Form -->
                <form class="signUpForm col-sm-11 text-center center p-3 rounded" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" id="signUp">
                    <h4 class="mt-2 mb-4 font-weight-bold">Sign Up</h4>

                    <!-- Error message if something goes wrong -->
                    <span class="text-danger" id="displayError"><?php echo $err; ?></span> <br>

                    <!-- Input boxes for first and last name -->
                    <label class= "mr-3 col-12 col-sm-2">Name</label>
                    <input type="text" class="mt-2 mb-2 col-sm-3 signUpInputBox" name="FirstName" placeholder="First Name" required>
                    <input type="text" class="mt-2 mb-2 col-sm-3 signUpInputBox" name="LastName" placeholder="Last Name" required> <br>

                    <!-- Input box for entering email -->
                    <label class= "mr-3 col-12 col-sm-2">Email</label>
                    <input type="email" class="mt-2 mb-2 col-sm-6 signUpInputBox" name="Email" placeholder="Email" required><br>

                    <!-- Password -->
                    <label class= "mr-3 col-12 col-sm-2">Password</label>
                    <input type="password" class="mt-2 mb-2 col-sm-6 signUpInputBox" name="password" id="password" placeholder="Password" required><br>

                    <!-- Radio button for selecting if a person signing up is a tutor -->
                    <div class="mt-3 mb-3">
                        <span class="mr-3">Are you a Tutor?</span>
                        <input type="radio" id="yes" name="Tutor" value="yes"><label class="mr-2" for="yes">Yes</label>
                        <input type="radio" id="no" name="Tutor" value="no"><label for="no">No</label> <br>
                    </div>

                    <div id="tutor-settings" class="text-center" style="display:none;">

                        <!-- Subjects a person is interested in tutoring -->
                        <label class= "mr-3 col-12 col-sm-2">Subject</label>
                        <input type="text" class="mt-2 mb-2 col-sm-6 signUpInputBox" name="subjects"><br>

                        <!-- Zoom link to attend the virtual session -->
                        <label class="mr-3 col-12 col-sm-2">Zoom Link</label>
                        <input type="url" class= "mt-2 mb-2 col-sm-6 signUpInputBox" name="zoomLink"><br>

                        
                        <!-- Entering the schedule: Day of the week -->
                        <label class="mr-3 col-12 col-sm-3 mt-3 mb-3">Schedule</label><br>
                        <span class="text-danger" id="timeValidation"></span><br>
                        <div class="row text-right text-sm-center col-sm-12">
                            <div class="col-sm-4 mb-2">
                                <select class="col-10 col-sm-10 signUpInputBox h-100" id="day" name="day">
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                </select>
                            </div>

                            <!-- Input start time -->
                            <div class="col-sm-4 mb-2">
                                <label class="mr-1">start</label><input type="time" class= "col-10 col-sm-8 signUpInputBox" name="startTime" id="startTime">
                            </div>

                            <!-- Input end time -->
                            <div class="col-sm-4 mb-2">
                                <label class="mr-1">end</label><input type="time" class= "col-10 col-sm-8 signUpInputBox" name="endTime" id="endTime"><br>
                            </div>
                        </div>

                    </div>

                    <!-- Form submission  -->
                    <button type="submit" class="btn-primary mt-3 mb-3 col-sm-5 signUpInputBox"> Sign Up</button> <br> <br>

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
            // prevent sign up form from submission on reload
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        </script>
    </body>

</html>
