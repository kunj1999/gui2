<?php
function logConsole($dataDump) {
    $js_log = "<script> console.log(" . json_encode($dataDump) . ")</script>";
    return $js_log;
}
?>