<?php
if(isset($_GET['x']))
    $x = $_GET['x'];
else
    $x = 4;
if(isset($_GET['y']))
    $y = $_GET['y'];
else
    $y = 4;
if(isset($_GET['seed']))
    $seed = $_GET['seed'];
else
    $seed = 0;
if(isset($_GET['points']))
    $points = $_GET['points'];

require_once("objects/map.php");
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