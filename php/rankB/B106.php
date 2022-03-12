<?php
    /*　回答方針 
    * (1) H,W,Nを変数化、生徒の席番(studentArr),行を配列化(rowArrs = [[rowArr_1],rowArr_2])
    * (2)  rowArrs[rowArr]に(studentArrのkey(i))を挿入。以下の式を実行
    *  (2-1) 1行目に生徒が座っている時: rowArr = [[座席番号:生徒の番号]..]
    *           ※ 生徒がいない時は[座席番号:0]
    *  (2-2) 2行目以降の時、前列が0だった時に前列の rowArr = [座席番号:生徒の番号]
    *           ※ 前列に生徒がいた場合は、現在の行にrowArr = [座席番号:生徒の番号]
    * (3) rowArrsを画面に表示
    */
    
    // (1) H,W,Nを変数化、生徒の席番(studentArr),行を配列化(rowArrs = [[rowArr_1],rowArr_2])
    [$H,$W,$N] = array_map('intval', explode(" ", trim(fgets(STDIN))));
    for($i=1; $i<= $N; $i++){
        $studentArr[$i] = (int)trim(fgets(STDIN));
    }
    
    $rowArrs = array();
    $index = 1;
    // 行配列
    for ($h = 1; $h <= $H; $h++) {
        for ($w = 1; $w <= $W; $w++) {
           $rowArrs[$h][$index] = 0;
           $index++;
        }
    }
    
    // 列配列
    for ($row = 0; $row < $W; $row++) {
        $index = $row + 1;
        for ($col = 0; $col < $H; $col++) {
             $colArrs[$row][$col]["seatNo"] = $index;
            //  $colArrs[$row][$col]["student"] = 0;
             $index += $W;
        }        
    }
    

    // (2)  rowArrs[rowArr]に(studentArrのkey(i))を挿入。以下の式を実行
    
    $colArrs = setSeat($studentArr,$colArrs);
    $colArrs = packSeat($colArrs,$H);
    answer($colArrs,$H,$W);

    
    function setSeat($studentArr,$colArrs){
        foreach ($colArrs as $row => $colArr) {
            // 生徒の座席番号を調べて記録.
            foreach ($studentArr as $studentNo => $seatNo) {
                $key = array_search($seatNo, array_column( $colArr, "seatNo"));
                // echo "keyは$key studentNoは$studentNo".PHP_EOL;
                if($key !== false){
                    // echo "出力: ".$colArrs[$row][$key]["student"].PHP_EOL;
                    $colArrs[$row][$key]["student"] = $studentNo;
                }else{
                    continue;
                }
            }
        }
        return $colArrs;
    }
    
    function packSeat($colArrs,$H){
        foreach ($colArrs as $w => $colArr) {
            $str = implode(",",array_column($colArr, 'student'));
            $strArr = explode(",",$str);
            for($i = 0; $i < $H; $i++) {
                if($str && $i < count($strArr)){
                    // echo "通った".PHP_EOL;
                    $colArrs[$w][$i]["student"] = (int)$strArr[$i];
                }else{
                    // echo "else通った".PHP_EOL;
                    $colArrs[$w][$i]["student"] = 0;
                }
            }            
        }
        return $colArrs;
    }
    
    
    function answer($colArrs,$H,$W){
        for ($row = 0; $row < $H; $row++) {
            $answer = "";
            for ($col = 0; $col < $W; $col++) {
                $answer .= $col === $W - 1 ? $colArrs[$col][$row]["student"] : $colArrs[$col][$row]["student"]." ";
            }
            echo $answer.PHP_EOL;
        }
    }
    
    
?>
