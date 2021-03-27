<?php

include "sqlDBInfo.php";

$serverName = "localhost";
$dbName = "ETutor";

//@retVal: Conncetion handler for mysql server
// purpose: The function is used to create the sql server connection
function connectToServer() {
    global $serverName, $sqlServerUsername, $sqlServerPassword, $dbName;
    return (@new mysqli($serverName, $sqlServerUsername, $sqlServerPassword, $dbName));
}

// @param: email address, result (by reference)
// @return: true if successful, false if server internal error
// Purpose: The function will get the data assciated with the email address passed
function getUserRow($connhandle, $emailAdd, &$result){

    $stmt = $connhandle->prepare("SELECT * FROM user WHERE email = ?");

    $stmt->bind_param("s", $emailAdd);

    // If the query fails return false
    if(!$stmt->execute()) {
        return false;
    }

    $result = $stmt->get_result()->fetch_assoc();

    $stmt->reset();
    return true;
}

// @param: connection handle, username
// @return: row containing associated with the username
// Purpose: The function will check if the there exists data associated with the username.
//          Return the data if true, otherwise return false
function usernameExists($connhandle, $username) {
    
    $stmt = $connhandle->prepare("SELECT * FROM user WHERE username = ?");

    $stmt->bind_param("s", $emailAdd);

    if(!$stmt->execute()) {
        return false;
    }
    $result = $stmt->get_result()->fetch_assoc();

    $stmt->reset();
    return $result;
}

// @param: Conneciton handle, username, array of information from the signup form
// @retval: true on sucess, false if internal error occurs
// purpose: Adds the newly registred user to the database
function addUser($connhandle, $username, $infoArr){

    // Every user will have this row containing basic information
    $stmt = $connhandle->prepare("INSERT INTO user (username, email, pass, firstname, lastname, isTutor) VALUES (?, ?, ?, ?, ?, ?)");

    // Check if we are registering a tutor or a student
    if ($infoArr['Tutor'] == 'yes') {

        // If the tutor, then set isTutor = true
        $a = 1;
        $stmt->bind_param("sssssi", $username, $infoArr['Email'], $infoArr['password'], $infoArr['FirstName'], $infoArr['LastName'], $a);

        if(!$stmt->execute()) {
            return false;
        }

        // Enter the availability of the tutor to the table called avail
        $stmt->reset();
        $stmt = $connhandle->prepare("INSERT INTO avail (username, day, startTime, endTime, zoomLink, subjects) VALUES (?, ?, ?, ?, ?, ?)");
        
        // Format the time correctly and add it the table avail
        $start = date("G:i",strtotime($infoArr['startTime']));
        $end = date("G:i",strtotime($infoArr['endTime']));
        $stmt->bind_param("ssssss", $username, $infoArr['day'], $start, $end, $infoArr['zoomLink'], $infoArr['subjects']);

        if(!$stmt->execute()) {
            return false;
        }

        //Generate time slots for next 60 days
        $stmt->reset();
        $stmt = $connhandle->prepare("INSERT INTO registered (username, startTime, endTime, zoomLink) VALUES(?, ?, ?, ?)");

        $timeSlots = generateTimeStamps($infoArr['day']);

        foreach ($timeSlots as $time) {
            $startT = date("y-m-d H:i:s", strtotime($time. " " . $infoArr['startTime']));
            $endT = date("y-m-d H:i:s", strtotime($time. " " . $infoArr['endTime']));

            $stmt->bind_param("ssss", $username, $startT, $endT, $infoArr['zoomLink']);
            if(!$stmt->execute()) {
                return false;
            }
        }

    } else {
        // If the registering student, set isTutor = false
        $a = 0;
        $stmt->bind_param("sssssi", $username, $infoArr['Email'], $infoArr['password'], $infoArr['FirstName'], $infoArr['LastName'], $a);
    }

    if(!$stmt->execute()) {
        return false;
    }

    return true;
}

// @param: Day of the week(monday....Sunday)
// @return: array containing dates
// purpose: will generate dates for next 60 days that fall on the day of the week.
function generateTimeStamps($dayOfTheWeek) {
    $retVal = array();
    for ($i = 0; $i<60; $i +=7){
        array_push($retVal, date("y-m-d", strtotime($dayOfTheWeek . "+" . strval($i). "days")));
    }
    return $retVal;
}

// @param: Keyword entered by the user
// @return: return tutor profiles that match the keyword
// @purpose: it will search the database for keyword entered by the user
function search_keyword_in_sql($key) {
    $connhandle = connectToServer();
    if ($connhandle->connect_errno) {
        return NULL;
    }

    $stmt = $connhandle->prepare("SELECT firstname, lastname, day, startTime, endTime, subjects, username from user NATURAL JOIN avail WHERE (isTutor=1) AND (subjects LIKE ? OR lastname LIKE ? OR firstname LIKE ?)");
    
    $likeKey = "%".$key."%";

    $stmt->bind_param("sss", $likeKey, $likeKey, $likeKey);

    if(!$stmt->execute()) {
        return NULL;
    }
    $result = $stmt->get_result()->fetch_all();
    $stmt->reset();
    $connhandle->close();
    return $result;
}

?>