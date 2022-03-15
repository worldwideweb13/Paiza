<?php
    /* 回答方針 
    * (1) フィールドを配列化...fieldArrs
    * (2) fieldArrsを行毎に取り出し以下の処理を実行
    * (2-1) "#"の時、行,列の"."を"X"に変更
    * (3) fieldArrsの"."の数を数える。...fields
    * (4) フィールドのマス目総数 - fields を画面に出力
    */
    
    // (1) フィールドを配列化...fieldArrs
    [$H,$W] = array_map('intval', explode(" ", trim(fgets(STDIN))));
    for ($h = 0; $h < $H; $h++) {
         $rowsArr = str_split(trim(fgets(STDIN)));
         $FieldsArrs[] = $rowsArr;
    }
    
    // (2) fieldArrsを行毎に取り出し以下の処理を実行
    for ($i_col = 0; $i_col < $H; $i_col++) {
        $bombFlg = false;
        for ($i_row = 0; $i_row < $W; $i_row++) {
             if ($FieldsArrs[$i_col][$i_row] === "#") {
                //  echo "$i_row 周目の $i_row 回目で実行".PHP_EOL;
                 [$FieldsArrs,$bombFlg] = bomb($i_col,$i_row,$FieldsArrs,$bombFlg);
             }else{
                 continue;
             }
        }
    }
    

    //  (3) fieldArrsの"."の数を数える。...fields
    $fields = 0;
    foreach ($FieldsArrs as $FieldsArr) {
        $countArr = array_count_values($FieldsArr);
        $fields += $countArr["."];
    }
    
    // (4) フィールドのマス目総数 - fields を画面に出力
    // echo ($H * $W) - $answer;
    echo ($H * $W) - $fields;
    
    // 行の爆発を実行する関数
    function explodeBomb($field){
        if($field === "."){
            $field = "X";
        }
        return $field;
    }     
   
    // (2-1) "#"の時、行,列の"."を"X"に変更
    function bomb($i_col,$i_row,$FieldsArrs,$bombFlg){

        // (2-1) "#"の時、行,列の"."を"X"に変更
        if($bombFlg == false){
            // echo "通った";
            $FieldsArrs[$i_col] = array_map('explodeBomb',$FieldsArrs[$i_col]);
            $bombFlg = true;
        }
        
        // 列の爆発を実行
        for ($i = 0; $i < count($FieldsArrs); $i++) {
            // echo "$i 列目の $i_row 番目は".PHP_EOL;
            // var_dump($FieldsArrs[$i][$i_row]);
            if($FieldsArrs[$i][$i_row] === "."){
                $FieldsArrs[$i][$i_row] = "X";
            }else{
                continue;
            }
        }
        return [$FieldsArrs,$bombFlg];
        
    }
    
?>