<?php
    /* 回答方針...宝の位置(P)を引数に 方法1,2の動きを関数で取得する
    * (1) 方法1...abs(宝の位置) × 2 = 移動回数. 移動回数分,足算を繰り返す...ans1
    * (2-1) 方法2...P/2を何回繰り返せるかをカウント(n). n 回以下の配列を作成 
    *       ※ 0の場合を除く 
    * (2-2) [[n_1:[x:座標],[distance:総移動距離][n_i:]]の形式で配列作成...xArrs
    * (2-3)  xArrs[n-1][x] <= P >= xArrs[n][x]のindex(key)を
    * (2-4) abs(xArrs[key][distance]-P)で移動距離を計算...ans2
    * (3) ans1,ans2を画面に表示
    */ 
    
    
    // (1) 方法1...abs(宝の位置) × 2 = 移動回数. 移動回数分,足算を繰り返す...ans1
    $P = (int)trim(fgets(STDIN));
    $moveDistance = $P * 2;
    // 宝の座標($P)が-の時は、往復する回数は($P * 2) - 1回になる。
    $moveDistance  = $moveDistance < 0 ? abs($moveDistance) : $moveDistance - 1;
    
    
    if($P === 0){
        $ans_1 = 0;
    }else{
        $x1_Arrs[0] = ["key" => 1,"distance" => 1];
        for ($i = 1; $i < $moveDistance; $i++) {
            $pre_key = abs($x1_Arrs[$i - 1]["key"]);
            $key = $i % 2 === 0 ? $pre_key + 1 : -$pre_key;
            $x1_Arrs[$i] = ["key" => $key,"distance" => abs($key) + $pre_key + $x1_Arrs[$i - 1]["distance"]];
        }

        $ans_1 = $P > 0 ? $x1_Arrs[$i - 1]["distance"] : $x1_Arrs[$i - 1]["distance"];
    }
    
    

    // (2-1) $P == 0 の場合を除き以下の処理を実行
    if ($P === 0){
        $ans_2 = 0;
    }else{
        // (2-1) 方法2...P/2を何回繰り返せるかをカウント(n). n 回以下の配列を作成
        $count = 0;
        $cal_P = abs($P);
        while( $cal_P > 0){
            $cal_P = floor($cal_P /= 2);
            $count++;
        }
        
        // (2-2) [[n_1:[x:座標],[distance:総移動距離][n_i:]]の形式で配列作成...xArrs
        $x2_Arrs[0] = [0 => ["key" => 1,"distance" => 1],1 => ["key" => -1,"distance" => 3]];
    
        for ($i = 1; $i <= $count; $i++) {
            $pre_key = $x2_Arrs[$i - 1][0]["key"];
            $key = $pre_key * 2;
            $pre_distance = $x2_Arrs[$i - 1][1]["distance"];
            
            $x2_Arrs[$i][0]["key"] = $key;
            $x2_Arrs[$i][0]["distance"] = $pre_distance + $pre_key + $key;
            $x2_Arrs[$i][1]["key"] = -$key;
            $x2_Arrs[$i][1]["distance"] = $x2_Arrs[$i][0]["distance"]  + $x2_Arrs[$i][0]["key"] + $key;
        }
        
        // (2-3) n - 1番目の位置から $x2_Arrs[n-1][x] <= P >= xArrs[n][x]のindex(key)を取得
        if($x2_Arrs[$count - 1][0]["key"] === abs($P) ){
            $ans_2 = $P > 0 ? $x2_Arrs[$count - 1][0]["distance"] : $x2_Arrs[$count - 1][1]["distance"];
        }else{
            $ans_2 = $P > 0 ? $x2_Arrs[$count][0]["distance"] - ($x2_Arrs[$count][0]["key"] - $P) : $x2_Arrs[$count][1]["distance"] - abs($x2_Arrs[$count][1]["key"] - $P);
        }

    }
    
    echo $ans_1." ".$ans_2.PHP_EOL;
    
?>