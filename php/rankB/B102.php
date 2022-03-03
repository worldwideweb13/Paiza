<?php
    /*　回答方針 
    * (1) 列毎の配列(DataArr),"operation"を配列化(opeArr)
    * (2) operationを引数に膨張/縮小結果のDataArrを返す関数を実行
    *  (2-1) 左上隅: 配列[0][0]が指定色の場合, [0][1],[1][0]を変更
    *  (2-1) 右上隅: 配列[0][W]が指定色の場合, [0][w-1],[1][w]を変更
    *  (2-1) １行目: [0][0<j<w]が指定色の場合, [0][j-1],[0][j+1],[1][j]を変更
    *  (2-1) 中行: [0<i<H][0<j<W]が指定色の場合, [i-1][j],[i][j+1],[i+1][j],[i][j-1]を変更
    *  (2-1) 左中隅: [0<i<H][0]が指定色の場合, [i-1][0],[i][1],[i+1][0]を変更
    *  (2-1) 右中隅: [0<i<H][W-1]が指定色の場合, [i-1][W-1],[i][j-1],[i+1][W-1]を変更
    *  (2-1) 左下隅: 配列[H-1][0]が指定色の場合, [H-2][0],[H-1][1]を変更
    *  (2-1) 最終行: [H-1][0<j<w]が指定色の場合, [H-1][j-1],[H-2][j],[H-1][j+1]を変更
    *  (2-1) 右下隅: [H-1][W-1]が指定色の場合, [H-2][W-1],[H-1][W-2]を変更
    * (3) (2)をopeArr回数実行
    * (4) DataArrを画面に表示
    */
    
    // (1) 列毎の配列(DataArr),"operation"を配列化(opeArr)
    [$H,$W,$N] = array_map('intval', explode(" ", trim(fgets(STDIN))));
    
    for ($i = 0; $i < $H; $i++) {
        $DataArr[$i] = str_split(trim(fgets(STDIN)));
    }
    
    $opeArr = str_split(trim(fgets(STDIN)));

    // (3) (2)をopeArr回数実行
    
    foreach ($opeArr as $ope) {
        $DataArr = pictureEdit($ope,$DataArr,$H,$W);
    }
    
    function pictureEdit($_ope,$_DataArr,$H,$W){
        $color = $_ope === "D" ? "#" : ".";
        $newData = array();
                
        foreach ($_DataArr as $i => $_data) {
            
            for ($j = 0; $j < $W; $i++) {
                
                if ($_DataArr[$i][$j] == $color) {
                    $newData = changePix($color,$_DataArr,$i,$j,$newData,$H,$W);
                }else{
                    continue;
                }
            }
        }
        var_dump($newData);
    }
    
    function changePix($_color,$_DataArr,$_i,$_j,$_newData,$_H,$_W){
        
        // (2-1) 左上隅: 配列[0][0]が指定色の場合, [0][1],[1][0]を変更
        if ($_i === 0 && $_j  === 0) {
            $_newData[$_i][$_j + 1] = $_color;
            $_newData[$_i + 1][$_j] = $_color;
            return $_newData;
        // (2-1) 右上隅: 配列[0][W]が指定色の場合, [0][w-1],[1][w]を変更    
        }elseif ($_i === 0 && $_j  === $_W - 1) {
            $_newData[$_i][$_j - 1] = $_color;
            $_newData[$_i + 1][$_j] = $_color;
        // (2-1) １行目: [0][0<j<w]が指定色の場合, [0][j-1],[0][j+1],[1][j]を変更
        }elseif ($_i === 0 && 0 < $_j && $_W > $_j) {
            $_newData[$_i][$_j - 1] = $_color;
            $_newData[$_i][$_j + 1] = $_color;            
            $_newData[$_i + 1][$_j] = $_color;
        // (2-1) 左中隅: [0<i<H][0]が指定色の場合, [i-1][0],[i][1],[i+1][0]を変更
        }elseif (0 > $_i && $_H > $_i && $_j === 0) {
            $_newData[$_i - 1][$_j] = $_color;
            $_newData[$_i][$_j + 1] = $_color;
            $_newData[$_i + 1][$_j] = $_color;
        }
        
    }
    
    
?>