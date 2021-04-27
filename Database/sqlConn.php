<!-- 
    File: /Database/sqlConn.php
    E-Tutor
    Kunj Patel, UMass Lowell Computer Science, kunj_patel@student.uml.edu
    Sean Gillis, UMass Lowell Computer Science, sean_gillis1@student.uml.edu
    Copyright (c) 2021 Kunj Patel, Sean Gillis. All rights reserved.

    Last Modified: 04/26/2021
 -->

<?php

include "sqlDBInfo.php";

// Server name and databse name. This can be different depending upon how your sql database is setup
$serverName = "localhost";
$dbName = "ETutor";

// @param: None
// @retVal: Conncetion handler for mysql server
// purpose: The function is used to create the sql server connection
function connectToServer() {
    global $serverName, $sqlServerUsername, $sqlServerPassword, $dbName;
    
    // Create and return connection handle
    return (@new mysqli($serverName, $sqlServerUsername, $sqlServerPassword, $dbName));
}

// @param: email address, result (by reference)
// @return: true if successful, false if server internal error
// Purpose: The function will get the data assciated with the email address passed
function getUserRow($connhandle, $emailAdd, &$result){

    // prepare query to get all the information associated with the email
    $stmt = $connhandle->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $emailAdd);

    // If the query fails return false
    if(!$stmt->execute()) {
        return false;
    }

    // Get the query results
    $result = $stmt->get_result()->fetch_assoc();

    $stmt->reset();
    return true;
}

// @param: connection handle, username
// @return: row containing associated with the username
// Purpose: The function will check if the there exists data associated with the username.
//          Return the data if true, otherwise return false
function usernameExists($connhandle, $username) {
    
    // Prepare query to get all the data associated with the username
    $stmt = $connhandle->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $emailAdd);

    // If the query fails, return false
    if(!$stmt->execute()) {
        return false;
    }

    // Get the query results
    $result = $stmt->get_result()->fetch_assoc();

    $stmt->reset();
    return $result;
}

// @param: Conneciton handle, username, array of information from the signup form
// @retval: true on sucess, false if internal error occurs
// purpose: Adds the newly registred user to the database
function addUser($connhandle, $username, $infoArr){

    // Every user will have this row containing basic information
    $stmt = $connhandle->prepare("INSERT INTO user (username, email, pass, firstname, lastname, isTutor, review) VALUES (?, ?, ?, ?, ?, ?, ?)");

    // Check if we are registering a tutor or a student
    if ($infoArr['Tutor'] == 'yes') {

        // If the tutor, then set isTutor = true
        $a = 1;
        $b = "[]";
        $stmt->bind_param("sssssis", $username, $infoArr['Email'], $infoArr['password'], $infoArr['FirstName'], $infoArr['LastName'], $a, $b);

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

        // Add time slots to the table called registered
        $stmt->reset();
        $stmt = $connhandle->prepare("INSERT INTO registered (username, startTime, endTime, zoomLink, tutorUsername) VALUES(?, ?, ?, ?, ?)");

        //Generate time slots for next 60 days
        $timeSlots = generateTimeStamps($infoArr['day']);

        foreach ($timeSlots as $time) {

            // Format date and time correctly to be added to DB
            $startT = date("y-m-d H:i:s", strtotime($time. " " . $infoArr['startTime']));
            $endT = date("y-m-d H:i:s", strtotime($time. " " . $infoArr['endTime']));

            $stmt->bind_param("sssss", $username, $startT, $endT, $infoArr['zoomLink'], $username);
            if(!$stmt->execute()) {
                return false;
            }
        }

    } else {
        // If the registering student, set isTutor = false
        $a = 0;
        $b = "[]";
        $stmt->bind_param("sssssis", $username, $infoArr['Email'], $infoArr['password'], $infoArr['FirstName'], $infoArr['LastName'], $a, $b);
        if(!$stmt->execute()) {
            return false;
        }
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
// purpose: it will search the database for keyword entered by the user
function search_keyword_in_sql($key) {
    $connhandle = connectToServer();
    if ($connhandle->connect_errno) {
        return NULL;
    }

    // Search the DB where key is a substring of firstname, lastname or subject
    $stmt = $connhandle->prepare("SELECT firstname, lastname, day, startTime, endTime, subjects, username from user NATURAL JOIN avail WHERE (isTutor=1) AND (subjects LIKE ? OR lastname LIKE ? OR firstname LIKE ?)"); 
    $likeKey = "%".$key."%";
    $stmt->bind_param("sss", $likeKey, $likeKey, $likeKey);

    if(!$stmt->execute()) {
        return NULL;
    }

    // Get the query results
    $result = $stmt->get_result()->fetch_all();
    $stmt->reset();
    $connhandle->close();
    return $result;
}

// @param: username to search by in table
// @return: time slots a user has added to their calendar
// purpose: function will return registered events for given user
function search_registration_table($user) {
    $connhandle = connectToServer();
    if ($connhandle->connect_errno) {
        return NULL;
    }

    // Get all slots user has registered for
    $stmt = $connhandle->prepare("SELECT id, startTime, endTime, zoomLink, tutorUsername from user NATURAL JOIN registered WHERE (username=?)");
    $stmt->bind_param("s", $user);

    if(!$stmt->execute()) {
        return NULL;
    }

    // Get the query results
    $result = $stmt->get_result()->fetch_all();
    $stmt->reset();

    // Get the firstname and lastname of tutor
    $stmt = $connhandle->prepare("SELECT firstname, lastname from user WHERE username=?");

    // Append firstname and lastname of the tutor to each registered session
    for ($i = 0; $i < count($result); $i++) {
        $stmt->bind_param("s", $result[$i][4]);
        $stmt->execute();
        $tempresult = $stmt->get_result()->fetch_all();
        $result[$i][4] = $tempresult[0][0] . " ". $tempresult[0][1];
    }

    $stmt->reset();
    $connhandle->close();
    return $result;
}

// @param: username, comments, rating(1-5)
// @return: (none)
// purpose: function will add review and rating to the DB
function addReview($username, $comments, $rating) {
    $connhandle = connectToServer();
    if ($connhandle->connect_errno) {
        return NULL;
    }

    // Create json object for review
    $myJSON->comments = $comments;
    $myJSON->rating = $rating;
    $jsonEncoded = json_encode($myJSON);
    
    // Update the user table to append the new revie
    $stmt = $connhandle->prepare("UPDATE user SET review = JSON_ARRAY_APPEND(review, '$', CAST('$jsonEncoded' AS JSON)) WHERE username=?");
    $stmt->bind_param("s", $username);

    if(!$stmt->execute()) {
        return NULL;
    }

    $stmt->reset();
    $connhandle->close();
}

// @param: username
// @return: return tutor information from user, avail, registered tables
// purpose: information used to show tutor profile page
function tutorPublicProfile($username) {
    $connhandle = connectToServer();
    if ($connhandle->connect_errno) {
        return NULL;
    }

    // Get the basic tutor information 
    $stmt = $connhandle->prepare("SELECT firstname, lastname, review, subjects from user NATURAL JOIN avail WHERE (isTutor=1) AND username=?");
    $stmt->bind_param("s", $username);

    if(!$stmt->execute()) {
        return NULL;
    }

    // Get the query results
    $result = $stmt->get_result()->fetch_all();
    $stmt->reset();

    // Get the sessions available for a tutor
    $stmt = $connhandle->prepare("SELECT startTime, endTime, zoomLink from registered WHERE username=? and tutorUsername=?");
    $stmt->bind_param("ss", $username, $username);

    if(!$stmt->execute()) {
        return NULL;
    }

    // Get the query results
    $sessions = $stmt->get_result()->fetch_all();

    // Append subjects to each session
    for ($i=0; $i < count($sessions); $i++) {
        array_push($sessions[$i], $result[0][3]);
    }

    $connhandle->close();
    return [$result, $sessions];
}

// @param: username, starttime, endtime, zoom link, tutor username
// @return: (none)
// purpose: Add the session to registered table
function addSession($username, $startTime, $endTime, $zm, $tutorUsername){
    $connhandle = connectToServer();
    if ($connhandle->connect_errno) {
        return NULL;
    }

    // Add a new entry to registered table
    $stmt = $connhandle->prepare("INSERT INTO registered (username, startTime, endTime, zoomLink, tutorUsername) VALUES(?, ?, ?, ?, ?)");

    // Format start and end time
    $startT = date("y-m-d H:i:s", strtotime($startTime));
    $endT = date("y-m-d H:i:s", strtotime($endTime));

    $stmt->bind_param('sssss', $username, $startT, $endT, $zm, $tutorUsername);

    if(!$stmt->execute()) {
        return NULL;
    }

    $connhandle->close();
}

?>