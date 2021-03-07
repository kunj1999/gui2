<?php 

require_once 'Database/sqlConn.php';

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

    // If the user does exists in the database
    if ($resultFromDB) {
        $errMessage = "Something is wrong";
        // match the passowrd, if not matched return false with error message
        // Store the useful info in the session superrglobal
        $conn->close();
        return true;
    } else {
        $conn->close();
        return false;
    }
}

function user_registration($reqArr) {

    // Get the connection handle and check if any errors encountered
    $conn = connectToServer();
    if ($conn->connect_errno) {
        $errMessage = "Server Internal Error!";
        return false;
    }

    // Check if the user already exists
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

    // Generate the random username and make sure that doesn't exist
    $username = "";
    while (1) {
        $username = $reqArr['First Name'] . $reqArr['Last Name'] . strval(rand(1,5000));
        $response = usernameExists($conn, $username);
        if($response === false) {
            $errMessage = "Server Internal Error!";
            $conn->close();
            return false;
        } else if ($response === null) {
            break;
        }
    }

    if(!addUser($conn, $username, $reqArr)) {
        $errMessage = "Server Internal Error!";
        $conn->close();
        return false;
    }
    // Form a query and add the user to database

    // Return
}

$arr = array();
$arr['First Name'] = 'Kunj';
$arr['Last Name'] = 'Patel';
$arr['password'] = "1234";
$arr['Email'] = 'example@gmail.com';
$arr['isTutor'] = 'no';

user_registration($arr);
?>