<!-- 
    File: userInDb.php
    E-Tutor
    Kunj Patel, UMass Lowell Computer Science, kunj_patel@student.uml.edu
    Sean Gillis, UMass Lowell Computer Science, sean_gillis1@student.uml.edu
    Copyright (c) 2021 Kunj Patel, Sean Gillis. All rights reserved.

    Last Modified: 04/26/2021
 -->

<?php 

require_once 'Database/sqlConn.php';
require_once 'Debug.php';

// @param: email, password, errmessage(by reference)
// @return: bool; True if email & password match, false otherwise
// purpose: verify if the email and password entered by the user are in the database
function user_authenticated($email, $password, &$errMessage) {

    // Get the connection handle and check if any errors encountered
    $conn = connectToServer();
    if ($conn->connect_errno) {
        $errMessage = "Server Internal Error!";
        return false;
    }

    // Get the user info from the database and verify that no queries were rejected
    $resultFromDB = null;
    if (!getUserRow($conn, $email, $resultFromDB)) {
        $errMessage = "Server Internal Error!";
    }

    // If the user does exists in the database
    if ($resultFromDB) {

        // match the passowrd, if not matched return false with error message
        if ($resultFromDB['pass'] == $password) {

            //Store session data
            session_start();
            $_SESSION['username'] = $resultFromDB['username'];
            $_SESSION['firstName'] = $resultFromDB['firstname'];
            $_SESSION['lastName'] = $resultFromDB['lastname'];
            $_SESSION['email'] = $email;

            $conn->close();
            return true;
        } else {
            $errMessage = "Username and password combination Invalid!";
            $conn->close();
            return false;
        }

    } else {
        // If user doesn't exist, return error
        $errMessage = "Username and password combination Invalid!";
        $conn->close();
        return false;
    }
}

// @param: array containing the information from signup page, err message
// @return; True on success, false otherwise
// purpose: Add the user to the database
function user_registration($reqArr, &$errMessage) {

    // Get the connection handle and check if any errors encountered
    $conn = connectToServer();
    if ($conn->connect_errno) {
        $errMessage = "Server Internal Error!";
        return false;
    }

    // Check if the user already exists with the same email
    $resultFromDB = null;
    if (!getUserRow($conn, $reqArr['Email'], $resultFromDB)) {

        // If the query was rejected, inform server error
        $errMessage = "Server Internal Error!";
        $conn->close();
        return false;
    } else if ($resultFromDB) {

        // If someone already signed up with the email, inform the user
        $errMessage = "Account already exists for the given email address";
        $conn->close();
        return false;
    }

    // Generate the random username and make sure that doesn't exists in the database
    $username = "";
    while (1) {

        // Username simply consist of first name last name and random number
        $username = $reqArr['FirstName'] . $reqArr['LastName'] . strval(rand(1,5000));
        $response = usernameExists($conn, $username);
        if($response === false) {
            $errMessage = "Server Internal Error!";
            $conn->close();
            return false;
        } else if ($response === null) {
            break;
        }
    }

    // Add the user to the database
    if(!addUser($conn, $username, $reqArr)) {
        $errMessage = "Server Internal Error!";
        $conn->close();
        return false;
    }

    // store session data for later usage
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['firstName'] = $reqArr['FirstName'];
    $_SESSION['lastName'] = $reqArr['LastName'];
    $_SESSION['email'] = $reqArr['Email'];

    return true;
}

?>