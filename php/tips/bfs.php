<?php
    /* 
    * (1)  幅優先探索(BFS)のプログラム / 以下のデータ入力を想定
    * H W  7 6
      s_1  ######
      s_2  #....#
      ...  #.##.#
      s_H  #.#S.#
           #.####
           #.....
           ######
    * (2) 
    */
    
    //  (1) $H,$Wを変数化, ダンジョンを2次元配列化($dungeonArr),現在地を配列化($postion)
    [$H,$W] = array_map('intval', explode(" ", trim(fgets(STDIN))));
    for ($i = 0; $i < $H; $i++) {
        $dungeonArr[] = str_split(trim(fgets(STDIN)));
        $key = array_search("S",$dungeonArr[$i]);
        if($key){
            $position[0][0]["x"] = $key;
            $position[0][0]["y"] = $i;
            $position[0][0]["val"] = 0;
        }
    }
    
    // (2) 幅優先探索(BFS)を実行して、ダンジョン内で到達可能なマスに数字を入れていく
    //  (2-1)スタート地点、キュー(行番号,列番号)を取り出して上下左右のマスを探索
    while(is_array($position) && !empty($position)){
        $positionArr = array_pop($position);
        foreach ($positionArr as $i => $val) {
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
                $position[0][$i]["x"] = $up["x"];
                $position[0][$i]["y"] = $up["y"];
                [$dungeonArr,$position[0][$i]["val"]] = goLoad($up,$val,$dungeonArr);
            }
            
            if($dungeonArr[$down["y"]][$down["x"]] === "."){
                $position[0][$i]["x"] = $down["x"];
                $position[0][$i]["y"] = $down["y"];
                [$dungeonArr,$position[0][$i]["val"]] = goLoad($down,$val,$dungeonArr);
            }
            
            if($dungeonArr[$right["y"]][$right["x"]] === "."){
                $position[0][$i]["x"] = $right["x"];
                $position[0][$i]["y"] = $right["y"];   
                [$dungeonArr,$position[0][$i]["val"]] = goLoad($right,$val,$dungeonArr);
            }
            
            if($dungeonArr[$left["y"]][$left["x"]] === "."){
                $position[0][$i]["x"] = $left["x"];
                $position[0][$i]["y"] = $left["y"]; 
                [$dungeonArr,$position[0][$i]["val"]] = goLoad($left,$val,$dungeonArr);
            }
        }
    }
    
    
    // (3) ４隅に数字が入っていた場合、YESと出力 / 入っていない場合Noと出力
    $NoFlg = true;
    for ($i = 0; $i < 5; $i++) {
        if($NoFlg){
             switch ($i) {
                 // 一番上の列に数字が入っているかを確認
                 case 0:
                     foreach ($dungeonArr[0] as $val) {
                         if(is_int($val) || $val === "S"){
                             echo "YES".PHP_EOL;
                             $NoFlg = false;
                             break 3;
                         };
                     }
                     break;
                 // 一番下の列に数字が入っているかを確認
                 case 1:
                     foreach ($dungeonArr[count($dungeonArr) - 1] as $val) {
                         if(is_int($val) || $val === "S"){
                             echo "YES".PHP_EOL;
                             $NoFlg = false;
                             break 3;
                         };
                     }
                     break;
                 // 一番右の行に数字が入っているかを確認
                 case 2:
                     foreach ($dungeonArr as $valArr) {
                         if(is_int($valArr[count($valArr) - 1]) || $valArr[count($valArr) - 1] === "S"){
                             echo "YES".PHP_EOL;
                             $NoFlg = false;
                             break 3;
                         };
                     }
                     break;
                // 一番左の行に数字が入っているかを確認
                 case 3:
                     foreach ($dungeonArr as $valArr) {
                         if(is_int($valArr[0]) || $valArr[0] === "S"){
                             echo "YES".PHP_EOL;
                             $NoFlg = false;                      
                             break 3;
                         }else{
                             // 上下左右に数字がない場合は、flgをfalseに切り替え
                             $NoFlg = false;                             
                         }
                     }
                     break;
             }
        }else{
            echo "NO".PHP_EOL;       
        }
    }
    

    function goLoad($arr,$val,$dungeonArr){
        $dungeonArr[$arr["y"]][$arr["x"]] = $val + 1;
        return [$dungeonArr,$val + 1];
    }
    

?>