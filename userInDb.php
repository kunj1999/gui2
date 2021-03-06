<?php 

require_once 'Database/sqlConn.php';

// @param: email, password, errmessage(by reference)
// @return: bool
function user_authenticated($email, $password, &$errMessage) {

    $resultFromDB = null;
    if (!getUserRow($email, $resultFromDB)) {
        $errMessage = "Server Internal Error!";
    }

    if ($resultFromDB) {
        $errMessage = "Something is wrong";
    }

    var_dump($resultFromDB);
    return false;
}
$err = "";
user_authenticated("1999kunj@gmail.com", "1234", $err);
?>