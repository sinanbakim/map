<?php
require_once("../objects/map.php");
if(isset($_GET["points"])) {
    $map = new Map($_GET['x'], $_GET['y'], $_GET['seed']);
    $map->setStops($_GET["points"]);
    echo $map->renderResultAsJSON();
}
?>