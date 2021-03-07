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

    if ($infoArr['isTutor'] == 'yes') {
        $stmt->bind_param("sssssis", $username, $infoArr['Email'], $infoArr['password'], $infoArr['First Name'], $infoArr['Last Name'], $a = 1, $infoArr['subjects']);
    } else {
        $stmt->bind_param("sssssis", $username, $infoArr['Email'], $infoArr['password'], $infoArr['First Name'], $infoArr['Last Name'], $a = 0, "");
    }

    if(!$stmt->execute()) {
        return false;
    }

    return true;
}
?>