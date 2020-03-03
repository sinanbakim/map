<?php
//namespace Game;

class Map {
    public $biomMap = Array();
    public $delayMap = Array();
    public $stops = Array();
    public $beeLines = Array();
    public $shortPaths = Array();
    public $fastPaths = Array();
    public $allPairs = Array();

    function __construct($x, $y, $seed) {
        $this->createBiomMap($x, $y);
        $this->randMapBySeed($seed);
        $this->createDelayMap();
    }

    private function randMapBySeed($n) {
        srand($n);
        srand(rand());
        foreach($this->biomMap as $y => $row) {
            foreach($row as $x => $cell) {
                $this->biomMap[$y][$x] = rand(0, 4);
            }
        }
    }

    private function createBiomMap($x, $y) {
        $row = array_fill(0, $x, 0);
        $this->biomMap = array_fill(0, $y, $row);
    }

    private function createDelayMap() {
        foreach($this->biomMap as $y => $row) {
            foreach($row as $x => $cell) {
                $this->delayMap[$y][$x] = $this->getDelayByID($cell);
            }
        }
    }

    private function getColorByID($id) {
        switch($id) {
            case 0: return "desert"; break;
            case 1: return "water"; break;
            case 2: return "forest"; break;
            case 3: return "plain"; break;
            case 4: return "mountain"; break;
        }
    }

    private function getDelayByID($id) {
        switch($id) {
            case 0: return 2; break; //dessert
            case 1: return 10; break; //water
            case 2: return 3; break; //forest
            case 3: return 1; break; //plain
            case 4: return 5; break; //mountain
        }
    }

    private function initAllPairs() {
        $this->allPairs = Array();
        $a = Array();
        $n = count($this->stops);
        for($i = 0; $i < $n; $i++) {
            for($j = $i + 1; $j < $n; $j++) {
                array_push($a, Array($i, $j));
            }
        }
        foreach($a as $i => $cord) {
            $this->allPairs[$i][0] = $this->stops[$cord[0]];
            $this->allPairs[$i][1] = $this->stops[$cord[1]];
        }
    }

    private function convert2base26($n) {
        $a = Array();
        do {
            $r = ($n % 26);
            array_unshift($a, $r);
            $n = ($n - $r) / 26;
        } while ($n > 0);
        if(count($a) > 1) {
            $a[0]--;
        }
        return $a;
    }

    private function convertCellID2Cords($id) {
        preg_match_all("/([A-Z]+)([0-9]+)/", $id, $match);
        $alpha = str_split($match[1][0]);
        $alpha = $this->alpha2dec($alpha);
        if(count($alpha) > 1) {
            $alpha[0]++;
        }

        $sum = 0;
        $len = count($alpha);
        for($i = 0; $i < $len; $i++) {
            $sum += pow(26, $len - $i - 1) * $alpha[$i];
        }
        return Array($sum, $match[2][0]);
    }

    private function dec2alpha($na) {
        $func = function($value) {
            return chr($value + 65);
        };
        return array_map($func, $na);
    }

    private function alpha2dec($na) {
        $func = function($value) {
            return ord($value) -65;
        };
        return array_map($func, $na);
    }
    

    private function mapPos2ID($y, $x) {
        $a = implode("", $this->dec2alpha($this->convert2base26($y)));
        return $a;
    }

    private function findShortesPath() {

    }

    public function setStops($stops) {
        foreach($stops as $key => $value) {
            $cord = $this->convertCellID2Cords($value);
            array_push($this->stops, $cord);
        }
    }

    public function calculateBeeLines() {
        foreach($this->allPairs as $key => $value) {
            $dx = abs($value[0][0] - $value[1][0]);
            $dy = abs($value[0][1] - $value[1][1]);
            $this->beeLines[$key] = sqrt($dx * $dx + $dy * $dy);
        }
    }

    public function calcutatePaths() {
        foreach($this->allPairs as $key => $value) {
            $this->findShortesPath($value);
        }
    }

    public function renderMap() {
        echo '<div id="map-wrapper">';
            foreach($this->biomMap as $y => $row) {
                echo '<div class="row">';
                foreach($row as $x => $cell) {
                    echo '<div id="'.$this->mapPos2ID($y, $x).$x.'" class="cell '.$this->getColorByID($this->biomMap[$y][$x]).'"></div>';
                }
                echo '</div>';
            }
        echo '</div>';
    }

    public function renderResultAsJSON() {
        /*

        $arr = array('beeLines' => $this->beeLines);

        echo json_encode($arr);*/

        $this->initAllPairs();
        $this->calculateBeeLines();
        $this->calcutatePaths();

        print_r($this->beeLines);
    }
}
?>