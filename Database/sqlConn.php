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
function getUserRow($emailAdd, &$result){
    $conn = connectToServer();
    
    if($conn->error) {
        return false;
    }

    $stmt = $conn->prepare("SELECT * FROM user WHERE email=?");

    $stmt->bind_param("s", $emailAdd);

    $stmt->execute();

    $stmt->bind_result($result);

    $stmt->fetch();

    $stmt->close();
    
    $conn->close();

    return true;
}
?>