<?php

include "sqlDBInfo.php";

$serverName = "localhost";
$dbName = "ETutor";

function connectToServer() {
    global $serverName, $sqlServerUsername, $sqlServerPassword, $dbName;
    return (@new mysqli($serverName, $sqlServerUsername, $sqlServerPassword, $dbName));
}

// @param: email address, result (by reference)
// @return: array of data associated with email
function getUserRow($connhandle, $emailAdd, &$result){

    $stmt = $connhandle->prepare("SELECT * FROM user WHERE email = ?");

    $stmt->bind_param("s", $emailAdd);

    if(!$stmt->execute()) {
        return false;
    }

    $result = $stmt->get_result()->fetch_assoc();

    $stmt->reset();
    return true;
}

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

function addUser($connhandle, $username, $infoArr){
    $stmt = $connhandle->prepare("INSERT INTO user (username, email, pass, firstname, lastname, isTutor, subjects) VALUES (?, ?, ?, ?, ?, ?, ?)");

    if ($infoArr['Tutor'] == 'yes') {
        $a = 1;
        $stmt->bind_param("sssssis", $username, $infoArr['Email'], $infoArr['password'], $infoArr['FirstName'], $infoArr['LastName'], $a, $infoArr['subjects']);

        if(!$stmt->execute()) {
            return false;
        }
        $stmt->reset();

        $TutorInfo->days = strval($infoArr['day']);
        $TutorInfo->start = strval($infoArr['startTime']);
        $TutorInfo->end = strval($infoArr['endTime']);
        $TutorInfo->zoom = strval($infoArr['ZoomLink']);

        $stmt = $connhandle->prepare("UPDATE user SET avail = ? WHERE username=?");
        
        $jsonFormat = json_encode($TutorInfo);
        $stmt->bind_param("ss", $jsonFormat, $username);
    } else {
        $stmt->bind_param("sssssis", $username, $infoArr['Email'], $infoArr['password'], $infoArr['FirstName'], $infoArr['LastName'], $a = 0, $b ="");
    }

    if(!$stmt->execute()) {
        return false;
    }

    return true;
}
?>