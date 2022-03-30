<?php
    /*　回答方針 
    * (1) H,Wを変数化,s_Hを行毎に配列化(massArrs), ロボの初期値を配列化(RoboArr)
    * (2) RoboArrを引数にロボが進行した結果(RoboArr)をかえす関数実行
    *  (2-1) 進行方向が↑の時: 
                進行方向の配列が"#"の時: 1.方向転換 2.方向転換 3.2回目以降の方向転換は停止 
                進行方向の配列が"."の時: 進行方向を引数に関数実行
    *  (2-1) 進行方向が→の時: x＋=1
                進行方向の配列が"#"の時: 1.方向転換 2.方向転換 3.2回目以降の方向転換は停止 
                進行方向の配列が"."の時: 進行方向を引数に関数実行 
    *  (2-1) 進行方向が↓の時: y＋=1
                進行方向の配列が"#"の時: 1.方向転換 2.方向転換 3.2回目以降の方向転換は停止  
                進行方向の配列が"."の時: 進行方向を引数に関数実行   
    *  (2-1) 進行方向が←の時: y-=1
                進行方向の配列が"#"の時: 1.方向転換 2.方向転換 3.2回目以降の方向転換は停止 
                進行方向の配列が"."の時: 進行方向を引数に関数実行    
    *  (3) RoboArrを画面に表示.
    */
    
    // (1) H,Wを変数化,s_Hを行毎に配列化(massArrs), ロボの初期値を配列化(RoboArr)
    [$H,$W] = array_map('intval', explode(" ", trim(fgets(STDIN))));
    
    for ($i = 0; $i < $H; $i++) {
        $massArrs[$i] = str_split(trim(fgets(STDIN)));
    }
    // 最初にロボットがいる位置を塗りつぶす
    $massArrs[0][0] = "#";
    
    
    $RoboFlg = true;
    $roboLocation =  ["x" => 0, "y" => 0, "direction" => "→", "counter" => 0];
    
    // (2) RoboArrを引数にロボが進行した結果(RoboArr)をかえす関数実行
    do {
        //robotの移動先を確定させる
        [$RoboFlg,$roboLocation,$massArrs] = CheckDirection($RoboFlg,$roboLocation,$massArrs);
    }while($RoboFlg !== false);

    // (3) RoboArrを画面に表示.
    echo $roboLocation["x"]." ".$roboLocation["y"].PHP_EOL;

    
    
    /* (2-1) 進行方向が↑の時: 
                進行方向の配列が"#"の時: 1.方向転換 2.方向転換 3.2回目以降の方向転換は停止 
                進行方向の配列が"."の時: 進行方向を引数に関数実行
    *  (2-1) 進行方向が→の時: x＋=1
                進行方向の配列が"#"の時: 1.方向転換 2.方向転換 3.2回目以降の方向転換は停止 
                進行方向の配列が"."の時: 進行方向を引数に関数実行 
    *  (2-1) 進行方向が↓の時: y＋=1
                進行方向の配列が"#"の時: 1.方向転換 2.方向転換 3.2回目以降の方向転換は停止  
                進行方向の配列が"."の時: 進行方向を引数に関数実行   
    *  (2-1) 進行方向が←の時: y-=1
                進行方向の配列が"#"の時: 1.方向転換 2.方向転換 3.2回目以降の方向転換は停止 
                進行方向の配列が"."の時: 進行方向を引数に関数実行
    */  
    function CheckDirection($RoboFlg,$roboLocation,$massArrs){
        $direction = $roboLocation["direction"];
        $counter = $roboLocation["counter"];
        $x = $roboLocation["x"];
        $y = $roboLocation["y"];
        switch ($direction) {

            case '↑':
                if($massArrs[$y - 1][$x] === "#" || $massArrs[$y - 1][$x] === null){
                    switch ($counter) {
                        // 進行方向を転換していなかった場合は右向きに
                        case 0:
                            $roboLocation["direction"] = "→";
                            $RoboFlg = true;
                            break; 
                        // 進行方向を一度転換していた場合は下向きに("←"の2回目)
                        case 1:
                            $roboLocation["direction"] = "↓";
                            $RoboFlg = true;
                            break;
                        // 進行方向を二度転換していた場合は、roboを止める。
                        case 2:
                            $RoboFlg = false;
                    }
                    // 進行方向転換をしたのでカウンター++
                    $roboLocation["counter"]++;
                // 一マス先が"." だった時は進む 
                }elseif($massArrs[$y - 1][$x] === "."){
                    [$roboLocation,$massArrs] = setRoboLocation($roboLocation,$massArrs);
                }
            break;
            
            case '→':
                if($massArrs[$y][$x + 1] === "#" || $massArrs[$y][$x + 1] === null){
                    switch ($counter) {
                        // 進行方向を転換していなかった場合は右向きに
                        case 0:
                            $roboLocation["direction"] = "↓";
                            $RoboFlg = true;
                            break; 
                        // 進行方向を一度転換していた場合は上向きに("↑"の2回目)
                        case 1:
                            $roboLocation["direction"] = "←";
                            $RoboFlg = true;
                            break;
                        // 進行方向を二度転換していた場合は、roboを止める。
                        case 2:
                            $RoboFlg = false;
                    }
                    // 進行方向転換をしたのでカウンター++
                    $roboLocation["counter"]++;
                // 一マス先が"." だった時は進む 
                }elseif($massArrs[$y][$x + 1] === "."){
                    [$roboLocation,$massArrs] = setRoboLocation($roboLocation,$massArrs);
                }
            break;
            
            case '↓':
                if($massArrs[$y + 1][$x] === "#" || $massArrs[$y + 1][$x] === null){
                    switch ($counter) {
                        // 進行方向を転換していなかった場合は右向きに
                        case 0:
                            $roboLocation["direction"] = "←";
                            $RoboFlg = true;
                            break; 
                        // 進行方向を一度転換していた場合は上向きに("→"の2回目)
                        case 1:
                            $roboLocation["direction"] = "↑";
                            $RoboFlg = true;
                            break;
                        // 進行方向を二度転換していた場合は、roboを止める。
                        case 2:
                            $RoboFlg = false;
                    }
                    // 進行方向転換をしたのでカウンター++
                    $roboLocation["counter"]++;
                // 一マス先が"." だった時は進む 
                }elseif($massArrs[$y + 1][$x] === "."){
                    [$roboLocation,$massArrs] = setRoboLocation($roboLocation,$massArrs);
                }
            break;
            
            case '←':
                if($massArrs[$y][$x - 1] === "#" || $massArrs[$y][$x - 1] === null){
                    switch ($counter) {
                        // 進行方向を転換していなかった場合は右向きに
                        case 0:
                            $roboLocation["direction"] = "↑";
                            $RoboFlg = true;
                            break; 
                        // 進行方向を一度転換していた場合は右向きに("↓"の2回目)
                        case 1:
                            $roboLocation["direction"] = "→";
                            $RoboFlg = true;
                            break;
                        // 進行方向を二度転換していた場合は、roboを止める。
                        case 2:
                            $RoboFlg = false;
                    }
                    // 進行方向転換をしたのでカウンター++
                    $roboLocation["counter"]++;
                // 一マス先が"." だった時は進む 
                }elseif($massArrs[$y][$x - 1] === "."){
                    [$roboLocation,$massArrs] = setRoboLocation($roboLocation,$massArrs);
                }
            break;
        }
        return [$RoboFlg,$roboLocation,$massArrs];
    }
    

    function setRoboLocation($roboLocation,$massArrs){
        // coutnerを初期化
        $roboLocation["counter"] = 0;
        $location = $roboLocation["direction"];
        switch ($location) {
            case "↑":
                $roboLocation["y"] -= 1;
                break;
            case "→":
                $roboLocation["x"] += 1;
                break;
            case "↓":
                $roboLocation["y"] += 1;
                break;
            case "←":
                $roboLocation["x"] -= 1;
                break;
        }
        // ロボが進んだ箇所を#に塗りつぶす.
        $massArrs[$roboLocation["y"]][$roboLocation["x"]] = "#";
        return [$roboLocation,$massArrs];
    }
    
?>