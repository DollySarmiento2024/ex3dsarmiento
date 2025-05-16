<?php

require_once("autoload.php");
$lighting = new Lighting();
$lampId = isset($_GET["lampId"]) && is_numeric($_GET["lampId"]) ? (int)$_GET["lampId"] : null;
$status = isset($_GET["status"]) ? $_GET["status"] : null;

if ($status == "on") {
    $newStatus = 1; 
    //$lighting->changeStatus($lamp_id, 1);
} else {
    $newStatus = 0;
    //$lighting->changeStatus($lamp_id, 0);
}

//cambiar estado led
$lighting->changeStatus($lampId, $newStatus);

//rediriir a index.php
header("location: index.php");
