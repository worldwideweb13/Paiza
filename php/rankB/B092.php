<?php
    /*　回答方針 
    * (1) 現在地とセーブポイントの座標(x,y)を取得して、それぞれ変数、配列化
    * (2) セーブポイント座標配列から、現在地座標との距離を算出
    * (3) (2)の結果配列から最小値を検索【min()】,最小値を持つ座標一覧を取得【array_keys()】
    * (4) (3)の結果配列を昇順【ksort()】にして画面に表示
    */
    
    // (1) 現在地とセーブポイントの座標(x,y)を取得して、それぞれ変数、配列化
    [$H,$W,$K] = explode(" ", trim(fgets(STDIN)));
    $N = [];
    $pointsArr = [];
    for ($i = 0; $i_y < $H; $i_y++) {
         $rowArr = str_split(trim(fgets(STDIN)));
         foreach ($rowArr as $i_x => $val) {
             if($val == "N"){
                 $N["x"] = $i_x + 1;
                 $N["y"] = $i_y + 1;
             }elseif ($val == "#") {
                 continue;
             }else{
                $pointsArr[$val]["x"] = $i_x + 1;
                $pointsArr[$val]["y"] = $i_y + 1;
             }
         }
    }
    
    // (2) セーブポイント座標配列から、現在地座標との距離を算出
    $distanceArr = calDistance($N,$pointsArr);
    
    function calDistance($N,$pointsArr){
        $distanceArr = [];
        foreach ($pointsArr as $key => $point) {
            $distance = abs($N["x"] - $point["x"]) + abs($N["y"] - $point["y"]);
            $distanceArr[$key] = $distance;
        }
        return $distanceArr;
    }
    
    // (3) (2)の結果配列から最小値を検索【min()】,最小値を持つ座標一覧を取得【array_keys()】
    $minDistanceArr = minDistance($distanceArr);
    
    function minDistance($distanceArr){
        $minDistanceArr = [];
        $minKeys = array_keys($distanceArr,min($distanceArr));
        foreach ($minKeys as $key) {
            array_push($minDistanceArr,$key);
        }
        //  (4) (3)の結果配列を昇順【ksort()】にして画面に表示
        asort($minDistanceArr);
        echo count($minDistanceArr).PHP_EOL;
        foreach ($minDistanceArr as $val) {
            echo $val.PHP_EOL;
        }        
    }
    
?>