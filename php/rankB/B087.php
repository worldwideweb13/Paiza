<?php
    /*　回答方針 
    * (1) 行,列(S_i,j)毎の配列を作成...rowArr,colArr
    * (2) (1)の配列,桁数を引数に最大値を調べる関数を作成
    * (3) (2)の結果を列、行毎に取得して比較
    * (4) (3)の結果、大きい方の数字を表示
    */
    
    // (1) 行,列(S_i,j)毎の配列を作成...rowArr,colArr
    // 行配列作成
    [$h,$w,$k] = array_map('intval', explode(" ", trim(fgets(STDIN))));
    for ($i = 0; $i < $h; $i++) {
        $rowArr[$i] = str_split(trim(fgets(STDIN)));
    }
    // 列配列作成
    for ($i_r = 0; $i_r < $w; $i_r++) {
        for ($i_h = 0; $i_h < $h; $i_h++) {
            $colArr[$i_r][$i_h] = $rowArr[$i_h][$i_r];
        }
    }
    
    // (2) (1)の配列,桁数を引数に最大値を調べる関数を作成
    // (3) (2)の結果を列、行毎に取得して比較
    $ansCol = checkMaxVal($k,$colArr);
    $ansRow = checkMaxVal($k,$rowArr);
    
    // (4) (3)の結果、大きい方の数字を表示
    $ansCol < $ansRow ? print $ansRow : print $ansCol;

    function checkMaxVal($k,$arr){
        foreach ($arr as $arrVal) {
            $resultArr[] = makeArr($arrVal,$k);
        }
        return max($resultArr);
    }
    
    
    function makeArr($arrVal,$k){
        $count = 0;
        for ($i_s = $k; $i_s <= count($arrVal); $i_s++) {
            $val = "";
            for ($i_c = 0 + $count; $i_c < $k + $count; $i_c++) {
                $val .=  $arrVal[$i_c];
            }
            $checkArr[] =  (int)$val;
            $count++;
        }
        // var_dump(max($checkArr));
        return max($checkArr);
        
    }
    
    
?>