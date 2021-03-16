<?php 

require_once 'Database/sqlConn.php';
require_once 'Debug.php';

// @param: email, password, errmessage(by reference)
// @return: bool
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
    echo logConsole($password);
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
        $errMessage = "Username and password combination Invalid!";
        $conn->close();
        return false;
    }
}

// @param: array containing the information from signup page, err message
// @return; True on success, false otherwise
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
        $errMessage = "Server Internal Error!";
        $conn->close();
        return false;
    } else if ($resultFromDB) {
        $errMessage = "Account already exists for the given email address";
        $conn->close();
        return false;
    }

    // Generate the random username and make sure that doesn't exists in the database
    $username = "";
    while (1) {
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

    // Form a query and add the user to database
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

    // Return
    return true;
}

// $test['Email'] = "a2@gmail.com";
// $test['password'] = "1234";
// $test['FirstName'] = "Kunj";
// $test['LastName'] = "Patel";
// $test['Tutor'] = "yes";
// $test['subjects'] = "Discrete Math";
// $test['day'] = "Monday";
// $test['startTime'] = "15:30";
// $test['endTime'] = "16:00";
// $test['zoomLink'] = "127.0.0.1";

// $errm = "";
// try{
//     user_registration($test, $errm);
// } catch(Exception $e){
//     echo "exception: " . $e->getMessage() . "\n";
// }


?>