<?php
    /*　回答方針 
    * (1-1) [[[0]:[一行目],[1]:[二行目]...]の横の２次元配列を作成する...DataRowArr
    * (1-2) [[[0]:[一列目],[1]:[二列目]...]の縦の２次元配列を作成する...DataColArr
    * (2) DataColArrから各列の最長の文字数を取得...strlen() → 配列化(strlenArr)
    * (3-1) DataRowArrをimplode()＋str_pad(strlenArr[i])で出力
    * (3-2) ただし２行目の時は"-"で穴埋め
    */
    
    // (1-1) [[[0]:[一行目],[1]:[二行目]...]の横の２次元配列を作成する...DataRowArr
    $W = (int)trim(fgets(STDIN));
    $DataRowArr[] = explode(" ", trim(fgets(STDIN)));
    $H = (int)trim(fgets(STDIN));
    for ($i = 0; $i < $H; $i++) {
        $DataRowArr[] = explode(" ", trim(fgets(STDIN)));
    }
    
    // (1-2) [[[0]:[一列目],[1]:[二列目]...]の縦の２次元配列を作成する...DataColArr
    for ($i_c = 0; $i_c < $W; $i_c++) {
        for ($i_r = 0; $i_r <= $H; $i_r++) {
             $DataColArr[$i_c][$i_r] = $DataRowArr[$i_r][$i_c];
        }
    }
    
    // (2) DataColArrから各列の最長の文字数を取得...strlen() → 配列化(strlenArr)
    foreach ($DataColArr as $colArr) {
        $strLen = 0;
        
        foreach ($colArr as $i_y => $val) {
            if($i_y === 0) {
                $strLen = mb_strlen($val);
            }else{
                if($strLen < mb_strlen($val)) $strLen = mb_strlen($val);
                // echo $i_y."行目 値=".mb_strlen($val)." 前回値=".mb_strlen($colArr[$i_y - 1])." strLen=".$strLen.PHP_EOL;
            }
        }
        $strlenArr[] = $strLen;
    }
    
    
    // (3-1) DataRowArrをimplode()＋str_pad(strlenArr[i])で出力
    foreach ($DataRowArr as $i_c => $rowArr) {
        $output = "";
        $template = "";
        for ($i_r = 0; $i_r < count($rowArr); $i_r++) {
            // (3-2) ただし２行目の時は"-"で穴埋め
            if ($i_c === 1) $template .= str_pad("-",$strlenArr[$i_r] + 2,"-")."|";
            // (3-1) 出力する形式に整形
            $output .= " ".str_pad($rowArr[$i_r], $strlenArr[$i_r])." |";
            str_pad($output,$strlenArr[$i_c]);
        }
        if ($i_c === 1) echo "|".$template.PHP_EOL;
        $output = "|".$output;
        echo $output.PHP_EOL;
    }
    

?>