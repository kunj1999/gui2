<!--
    File: /Homepage/profile/tutorProfile.php
    E-Tutor
    Kunj Patel, UMass Lowell Computer Science, kunj_patel@student.uml.edu
    Sean Gillis, UMass Lowell Computer Science, sean_gillis1@student.uml.edu
    Copyright (c) 2021 Kunj Patel, Sean Gillis. All rights reserved.

    Last Modified: 04/26/2021
-->

<?php 

    require_once "/var/www/html/gui2/Database/sqlConn.php";
    require_once "../../Debug.php";

    // If the user is not authenticated, deny entry
    session_start();
    if(!isset($_SESSION['username'])) {
        header("Location: ../../signIn.php");
        die();
    }

    // Get the query string, which is a username of a tutor
    $profileUsername = $_SERVER['QUERY_STRING'];

    // Get tutor's profile info and sessions
    $dataFromDb = tutorPublicProfile($profileUsername);

    $result = $dataFromDb[0];
    $sessions = $dataFromDb[1];

    // used later in the webpage to display name and subject
    $name = $result[0][0] . " " . $result[0][1];
    $subject = $result[0][3];

?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E-Tutor</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="tutorProfile.css">
        <link rel="stylesheet" href="../navbar.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/starrr@2.0.4/dist/starrr.css" integrity="sha256-MRQmcV2Nep+PVrETQUuphebjP5tpTA1dlgunqQRZnCM=" crossorigin="anonymous">
    </head>

    <body>

        <div>

            <?php include("../navbar.php");?>

            <!-- Main contents of page -->
            <div class="container center pt-5">
                <div class="header">
                    <i class="headerPic fas fa-user fa-8x"></i>
                    <div class="headerText">

                        <!-- Load name of the tutor -->
                        <p class="tutorName"><?php echo $name;?></p>

                        <!-- General location of residence -->
                        <p> Location: (Coming Soon)</p>
                    </div>
                </div>
            </div>

            <div class="container" style="margin-top: -13px;">
                <div id="profileTabs" class="p-0">

                    <!-- List of tabs -->
                    <ul id="Tablist" class="pTab">
                        <li><a href="#About" class="tabs">About</a></li>
                        <li><a href="#Sessions" class="tabs">Sessions</a></li>
                        <li><a href="#Reviews" class="tabs">Reviews</a></li>
                    </ul>

                    <div id="About">
                        <!-- Introduction -->
                        <h5>Introduction</h5>
                        <p style="height:50px;">Coming Soon!</p>

                        <!-- Subjects -->
                        <h5>Subjects</h5>
                        <p><?php echo $subject;?></p>

                        <!-- Education -->
                        <h5>Education</h5>
                        <p>Coming Soon!</p>

                        <!-- Skills -->
                        <h5>Skills</h5>
                        <p style="height:50px;">Coming Soon!</p>

                        <!-- Industry experience if any -->
                        <h5>Experience</h5>
                        <p>Coming Soon!</p>

                    </div>

                    <div id="Sessions">
                        <div class="table-responsive">

                            <!-- Table to display sessions -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Time</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>

                                <tbody id='sessionsBody'>
                                    <!-- Rows of sessions will be added dynamically (see tutorProfile.js) -->
                                </tbody>
                            </table>
                        </div>
                        
                    </div>

                    <div id="Reviews">
                        <button id="newReview" class="col-12 btn-primary"> <i class="fas fa-plus"></i> Add Review</button>

                        <div class="mt-2" id="postReview">
                            <h6 class="font-weight-bold m-3 text-center">Write a Review</h6>

                            <!-- Form to post review -->
                            <form class="text-center m-3" id="reviewForm">

                                <!-- Input area for the user to share their experience -->
                                <textarea name="comment" id="comment" class="col-11 m-3" rows="5" style="resize:none;" placeholder="Write about your experience!"></textarea>
                                
                                <!-- User can rate their experience on standard five star rating system -->
                                <p class="mb-0">Rate your experience</p>
                                <div class="starRating"></div>
                                <input name="fiveRating" id="fiveRating" style="display:none;"></input>

                                <!-- Tutor's username is stored here for easy access when submmiting form -->
                                <input name="tutorUsername" id="tutorUsername" style="display:none;" value="<?php echo $profileUsername;?>"></input>
                                
                                <!-- Option to post their review or cancel -->
                                <button type="submit" id="post" class="btn-primary">Post</button>
                                <button id="cancel">Cancel</button>
                            </form>
                        </div>

                        <div id="reviewPanel"></div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Jquery -->
        
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script> -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>

        <!-- Bootstrap Javascript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/starrr@2.0.4/dist/starrr.js" integrity="sha256-B0HNmtVTpAoXTFU+NwBmyqNt03Md9vZmBpGZMenxRok=" crossorigin="anonymous"></script>
        <script src="tutorProfile.js"></script>
        <script>

            // Prevent form submission on reload
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }

            $(document).ready(function() {

                // Get the reviews and sessions
                // Pass them to start function to start the process of displaying it to the user
                var result = <?php echo ($result[0][2]); ?>;
                var sessions = <?php echo json_encode($sessions); ?>;
                start(result, sessions);
            });
        </script> 
    </body>

</html>