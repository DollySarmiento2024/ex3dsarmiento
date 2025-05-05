<?php

require_once("autoload.php");
$lighting = new Lighting();
$lamp_id = isset($_GET["lamp_id"]) && is_numeric($_GET["lamp_id"]) ? (int)$_GET["lamp_id"] : null;
$status = isset($_GET["status"]) ? $_GET["status"] : null;

if ($status == "on") {
    $new_status = 1;
    //$lighting->changeStatus($lamp_id, 1);
} else {
    $new_status = 0;
    //$lighting->changeStatus($lamp_id, 0);
}

$lighting->changeStatus($lamp_id, $new_status);


header("location: index.php");
