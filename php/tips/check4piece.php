<?php
    /* 
    * (1)  幅優先探索(BFS)のプログラム / 以下のデータ入力を想定　データを以下に変換します
    * H W X Y  5 5 4 2
      s_1      .#..#        . # 2 1 #
      s_2      #.###    →   # . # 0 #
      ...      ##...        # # 2 1 2
      s_H      #..#.        # 4 3 # 3
               #.###        # 5 # # #
    * 
    */
    
    //  (1) $H,$Wを変数化, ダンジョンを2次元配列化($dungeonArr),現在地を配列化($postion)
    [$H,$W, $X, $Y] = array_map('intval', explode(" ", trim(fgets(STDIN))));
    for ($i = 0; $i < $H; $i++) {
        $dungeonArr[] = str_split(trim(fgets(STDIN)));
    }
    
    $position[0][0]["x"] = $X - 1;
    $position[0][0]["y"] = $Y - 1;
    $position[0][0]["val"] = 0;
    $ans = 0;
    // 初期値に最初のカウント(0番目)を挿入
    $dungeonArr[$position[0][0]["y"]][$position[0][0]["x"]] = 0;
    
    // (2) 幅優先探索(BFS)を実行して、ダンジョン内で到達可能なマスに数字を入れていく
    //  (2-1)スタート地点、キュー(行番号,列番号)を取り出して上下左右のマスを探索
    while(is_array($position) && !empty($position)){
        $positionArr = array_pop($position);
        foreach ($positionArr as $val) {
            // 上下左右の配列のindex番号取得
            $up["x"] = $val["x"];
            $up["y"] = $val["y"] - 1;
            $down["x"] = $val["x"];
            $down["y"] = $val["y"] + 1;
            $right["x"] = $val["x"] + 1;
            $right["y"] = $val["y"];
            $left["x"] = $val["x"] - 1;
            $left["y"] = $val["y"];
            $val = $val["val"];

            // 上下左右のマスに「もとのマスの数+1」を書く(もしすでに数字が書いていれば無視)
            if($dungeonArr[$up["y"]][$up["x"]] === "."){
                $position[0][0]["x"] = $up["x"];
                $position[0][0]["y"] = $up["y"];
                [$dungeonArr,$position[0][0]["val"]] = goLoad($up,$val,$dungeonArr);
            }
            
            if($dungeonArr[$down["y"]][$down["x"]] === "."){
                $position[0][1]["x"] = $down["x"];
                $position[0][1]["y"] = $down["y"];
                [$dungeonArr,$position[0][1]["val"]] = goLoad($down,$val,$dungeonArr);
            }
            
            if($dungeonArr[$right["y"]][$right["x"]] === "."){
                $position[0][2]["x"] = $right["x"];
                $position[0][2]["y"] = $right["y"];   
                [$dungeonArr,$position[0][2]["val"]] = goLoad($right,$val,$dungeonArr);
            }
            
            if($dungeonArr[$left["y"]][$left["x"]] === "."){
                $position[0][3]["x"] = $left["x"];
                $position[0][3]["y"] = $left["y"]; 
                [$dungeonArr,$position[0][3]["val"]] = goLoad($left,$val,$dungeonArr);
            }
            
            // 配列内のindex番号を整理
            if($position[0] !== null){
               $position[0] = array_values($position[0]);
               $ans = $position[0][0]["val"];
            }
        }
    }
    
    // 動作確認用 配列をvar_dumapで表示
    foreach ($dungeonArr as $val) {
        echo implode(" ",$val).PHP_EOL;
    }
    
    // ダンジョンに数字を入れる関数
    function goLoad($arr,$val,$dungeonArr){
        $dungeonArr[$arr["y"]][$arr["x"]] = $val + 1;
        return [$dungeonArr,$val + 1];
    }
    
    

?>