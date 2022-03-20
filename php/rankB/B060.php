<?php
    /*　回答方針 
    * (1) N,H,W,sy,sxを変数化,s(サイコロの回転..sArr),マス(massArrs),サイコロ(diceArr)を配列化
    * (2) sArr[i]を引数にmassArrsを更新する関数をN回実行
    * (3) 引数"U","D","L","R"毎にdiceArrを更新
    * (3-1)  U: top = down, up = top, down = bottom, bottom = up 
    * (3-1)  D: top = up, up = bottom, down = top, bottom = down 
    * (3-1)  L: top = right, right = bottom, left = top, bottom = left  
    * (3-1)  R: top = left, right = top, left = bottom, bottom = right
    * (4)  sy,sx,sArr[i],diceArrを引数にmassArrsを更新する
    * (4-1)  U: massArrs[sy - 1][sx] = diceArr["bottom"]
    * (4-1)  D: massArrs[sy + 1][sx] = diceArr["bottom"]
    * (4-1)  L: massArrs[sy][sx - 1] = diceArr["bottom"]
    * (4-1)  R: massArrs[sy][sx + 1] = diceArr["bottom"]
    * (5)  massArrsを画面に表示
    */
    
    //  (1) N,H,W,sy,sxを変数化,s(サイコロの回転..sArr),マスを配列化(massArrs)
    [$N,$H,$W] = array_map('intval', explode(" ", trim(fgets(STDIN))));
    [$sy,$sx] = array_map('intval', explode(" ", trim(fgets(STDIN))));
    $sArr = str_split(trim(fgets(STDIN)));
    // サイコロの初期値は頂点を1,正面を5として設定
    $diceArr = ["top" => 1, "bottom" => 6, "up" => 2, "down" => 5, "right" => 4, "left" => 3,];
    for ($i_h = 1; $i_h <= $H; $i_h++) {
        for ($i_w = 1; $i_w <= $W; $i_w++) {
            $massArrs[$i_h][$i_w] = 0;
        }
    }
    // 最初のスタート位置のサイコロ底辺(bottom)を入力
    $massArrs[$sy][$sx] = 6;
    
    //  (2) sArrを引数にmassArrsを更新する関数をN回実行
    foreach ($sArr as $s) {
        // (3) 引数"U","D","L","R"毎にdiceArrを更新
        $diceArr = rollDice($s,$diceArr);
        // var_dump($diceArr["bottom"]);
        // (4)  sy,sx,sArr[i],diceArrを引数にmassArrsを更新する
        [$massArrs,$sy,$sx] = paintDice($s,$sy,$sx,$massArrs,$diceArr["bottom"]);
    }
    
    // (5)  massArrsを画面に表示
    foreach ($massArrs as $mass) {
        echo implode( " ", $mass).PHP_EOL;
    }
    
    
    // (3) 引数"U","D","L","R"毎にdiceArrを更新
    function rollDice($s,$diceArr){
        $rolledDiceArr = array();
        switch ($s) {
            // (3-1)  U: top = down, up = top, down = bottom, bottom = up 
            case 'U':
                $rolledDiceArr["top"] = $diceArr["down"];
                $rolledDiceArr["up"] = $diceArr["top"];
                $rolledDiceArr["down"] = $diceArr["bottom"];
                $rolledDiceArr["bottom"] = $diceArr["up"];
                $rolledDiceArr["right"] = $diceArr["right"];
                $rolledDiceArr["left"] = $diceArr["left"];
                break;
            // (3-1)  D: top = up, up = bottom, down = top, bottom = down
            case 'D':
                $rolledDiceArr["top"] = $diceArr["up"];
                $rolledDiceArr["up"] = $diceArr["bottom"];
                $rolledDiceArr["down"] = $diceArr["top"];
                $rolledDiceArr["bottom"] = $diceArr["down"];
                $rolledDiceArr["right"] = $diceArr["right"];
                $rolledDiceArr["left"] = $diceArr["left"];
                break;
            // (3-1)  L: top = right, right = bottom, left = top, bottom = left
            case 'L':
                $rolledDiceArr["top"] = $diceArr["right"];
                $rolledDiceArr["up"] = $diceArr["up"];
                $rolledDiceArr["down"] = $diceArr["down"];
                $rolledDiceArr["bottom"] = $diceArr["left"];
                $rolledDiceArr["right"] = $diceArr["bottom"];
                $rolledDiceArr["left"] = $diceArr["top"];
                break;
            // (3-1)  R: top = left, right = top, left = bottom, bottom = right
            case 'R':
                $rolledDiceArr["top"] = $diceArr["left"];
                $rolledDiceArr["up"] = $diceArr["up"];
                $rolledDiceArr["down"] = $diceArr["down"];
                $rolledDiceArr["bottom"] = $diceArr["right"];
                $rolledDiceArr["right"] = $diceArr["top"];
                $rolledDiceArr["left"] = $diceArr["bottom"];
                break;
                
        }
        return $rolledDiceArr;
    }
    
    // // (4)  sy,sx,sArr[i],diceArrを引数にmassArrsを更新する
    function paintDice($s,$sy,$sx,$massArrs,$diceBottom){
        switch ($s) {
            // (4-1)  U: massArrs[sy - 1][sx] = diceArr["bottom"]
            case 'U':
                $sy--;
                $massArrs[$sy][$sx] = $diceBottom;
                break;
            // (4-1)  D: massArrs[sy + 1][sx] = diceArr["bottom"]
            case 'D':
                $sy++;
                $massArrs[$sy][$sx] = $diceBottom;
                break;
            // (4-1)  L: massArrs[sy][sx - 1] = diceArr["bottom"]
            case 'L':
                $sx--;
                $massArrs[$sy][$sx] = $diceBottom;
                break;
            //(4-1)  R: massArrs[sy][sx + 1] = diceArr["bottom"]t
            case 'R':
                $sx++;
                $massArrs[$sy][$sx] = $diceBottom;
                break;
                
        }
        return [$massArrs,$sy,$sx];
    }
    
?>