<?php
    /*　回答方針 
    * (1) 設問毎の回答配列を作成...questionArrs
    *  (1-1) マイナス、文字列の場合は、配列から除外する 
    * (2) 配列の数と数から平均値を算出する 
    * (3) (2)の結果を画面に出力 
    */
    
    // (1) 設問毎の回答配列を作成...questionArrs
    [$N,$M] = explode(" ", trim(fgets(STDIN)));
    for ($i = 0; $i < $N; $i++) {
         $array = explode(" ", trim(fgets(STDIN)));
        // (1-1) マイナス、文字列の場合は、配列から除外する 
         foreach ($array as $q) {
            $q = $q == "0" ? 0 : preg_replace('/^0+/','', $q);
            if(preg_match("/^[0-9]+$/",$q) && (int)$q <= 100){
                $qusestionArr[] = (int)$q;
            }else{
                $qusestionArr[] = null;
            }
         }
         $qusestionArrs[] = $qusestionArr;
         $qusestionArr = null;             
         continue;
    }
    
    // 設問毎の回答配列に再修正
    for ($y = 0; $y < $M; $y++) {
         for ($x = 0; $x < $N; $x++) {
             $userAnsArrs[$y][$x] = $qusestionArrs[$x][$y];
         }
    }
    
    // (2) 配列の数と数から平均値を算出する
    foreach ($userAnsArrs as $i => $userAnsArr) {
        foreach ($userAnsArr as $key => $val) {
          if(!isset($val)){
              unset($userAnsArr[$key]);
          }
        }
        //Indexを詰める
        $userAnsArr = array_values($userAnsArr);
        // (3) (2)の結果を画面に出力 
        // $userAnsArrs[$i] = $userAnsArr;
        $userAnsArr == null ? print(0).PHP_EOL : print(floor(array_sum($userAnsArr) / count($userAnsArr))).PHP_EOL;
    }
    
?>