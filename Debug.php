<!-- 
    File: Debug.php
    E-Tutor
    Kunj Patel, UMass Lowell Computer Science, kunj_patel@student.uml.edu
    Sean Gillis, UMass Lowell Computer Science, sean_gillis1@student.uml.edu
    Copyright (c) 2021 Kunj Patel, Sean Gillis. All rights reserved.

    Last Modified: 04/26/2021
 -->
<?php

// @param: Mixed type
// @retval: String containing html code to console log on browser
// purpose: used for debugging
function logConsole($dataDump) {
    $js_log = "<script> console.log(" . json_encode($dataDump) . ")</script>";
    return $js_log;
}
?>