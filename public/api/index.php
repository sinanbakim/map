<?php
require_once("../includes/autoload.php");

if(isset($_POST['data'])) {
    $data = json_decode($_POST['data']);
    $map = new Map($data->x, $data->y, $data->seed);
    if(!empty($data->points)) {
        $map->setStops($data->points);
        $map->initAllPairs();
        $map->calculateBeeLines();
        $map->calcutatePaths();
        $map->getValues();
    }
}
?>