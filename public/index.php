<?php
$x = 4;
$y = 4;
$seed = 0;
$points = array();

if(isset($_GET['x'])) {
    $x = $_GET['x'];
}
if(isset($_GET['y'])) {
    $y = $_GET['y'];
}
if(isset($_GET['seed'])) {
    $seed = $_GET['seed'];
}
if(isset($_GET['points'])) {
    $points = $_GET['points'];
}

//print_r([$x, $y, $seed, $points]);
//use \App;
//print_r([__LINE__,
//__FILE__,
//__DIR__,
//__FUNCTION__,
//__CLASS__,
//__TRAIT__,
//__METHOD__,
//__NAMESPACE__]);

?>
<html>
    <head>
        <title>Interactive Map</title>
        <link rel="stylesheet" type="text/css" href="style/main.css">
        <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    </head>
    <body>
        <h1>Interactive Map</h1>
        <form action="index.php" method="get">
            <input id="rows" type="text" name="x" required placeholder="Number of rows" value="<?php echo $x; ?>"><br>
            <input id="cols" type="text" name="y" required placeholder="Number of cols" value="<?php echo $y; ?>"><br>
            <input id="seed" type="text" name="seed" required placeholder="Seednumber" value="<?php echo $seed; ?>"><br>
            <input type="submit" value="Draw map">
        </form>
        <?php
            require_once("includes/autoload.php");
            $map = new Map($x, $y, $seed);
            $map->renderMap();
        ?>
        <div class="center">
            <br>
            <input id="reset" type="button" value="Reset">
            <input id="calc" type="button" value="Calculate">
            <div id="result"></div>
        </div>
    <script type="text/javascript" src="script/main.js"></script>
    </body>
</html>