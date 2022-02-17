<?php
    /*　回答方針 
    * (1) アルファベットを繋げて名前を作成(２パターン用意)
    * (2) (1)を数字配列と照らし合わせて数字配列に変換
    * (3) (2)から相性を算出してans_1,ans_2を作成。
    * (4) ans_1,ans_2を比較して高い数字を出力
    */

    // (1) アルファベットを繋げて名前を作成(２パターン用意)
    [$s,$t] = explode(" ", trim(fgets(STDIN)));
    $alphabet = range('a', 'z');
    $st =  str_split($s.$t);
    $ts =  str_split($t.$s);
   
    // (2) (1)を数字配列と照らし合わせて数字配列に変換
    $st = calAns($st,$alphabet);
    $ts = calAns($ts,$alphabet);

    function calAns($str,$alphabet){
        $parseArr = [];
        for ($i = 0; $i < count($str); $i++) {
            $parseArr[$i] = array_search($str[$i],$alphabet) + 1;
        }
        return $parseArr;
    }
    
    //  (3) $st,$tsから相性を算出してans_1,ans_2を作成。
    $ans_1 = loveCheck($st);
    $ans_2 = loveCheck($ts);
    
    function loveCheck($arr){
        $count = count($arr) - 1;
        for ($i = 0; $i < $count; $i++) {
            $arr = calArr($arr);
        }
        return $arr[0];
    }
    
    
    function calArr($arr){
        $newArr = [];
        // 配列の最後は加算不要なので配列個数-1 
        for ($i = 0; $i < count($arr) - 1; $i++) {
            $newArr[$i] = $arr[$i] + $arr[$i + 1];
            if ($newArr[$i] >= 101) {
                $newArr[$i] = $newArr[$i] - 101;
            }
        }
        return $newArr;
    }
    
    // (4) ans_1,ans_2を比較して高い数字を出力
    $ans = $ans_1 > $ans_2 ? $ans_1 : $ans_2;
    echo $ans;
?>