<?php
    /*　回答方針 
    * (1) N,M,workの数(w_M)を変数化,日程を配列化...scheduleArr
    * (2-1) scheduleArrの最初の"work"から"off"にM回連続して入れ変える
            配列内のoffの最長の連続回数を数える($ans) $ansを配列化($ansArr)
    * (2-2) scheduleArrの2番目の"work"から"off"に(以下略) $offDaysを$offDaysArrに追加
            これを workの数 - M + 1回繰り返す.
    * (3) $countArrの中で最も大きい数字を出力
    */
    
    
    // (1) N,M,workの数(w_M)を変数化,日程を配列化...scheduleArr
    [$N,$M] = array_map('intval', explode(" ", trim(fgets(STDIN))));
    for ($i = 0; $i < $N; $i++) {
        $scheduleArr[] = trim(fgets(STDIN));
    }
    $w_M = array_count_values($scheduleArr)["work"];
    $index = 0;
    $count = $w_M - $M + 1;
    
    // $index開始位置を一つずつずらしながら、offをworkにM回置き換える
    // ↑の操作を$count回繰り返す
    for ($i = 0; $i < $count; $i++) {
        // (2-1) scheduleArrの最初の"work"から"off"にM回連続して入れ変える
         [$editArr,$index] = editArr($scheduleArr,$M,$w_M,$index);
        //  $ans = countArr();
    }
    
    
    
    
    function editArr($scheduleArr,$M,$w_M,$index){
        // 働く日のkey配列を取得
        $workDays = array_keys($scheduleArr,"work");
        
        // workの数 - M + 1回 配列を置き換える
            for ($i_i = 0; $i_i < $M; $i_i++) {
                // $workDaysのindexの開始位置を1個ずつずらす
                // echo "index番号は".$workDays[$i_i + $counter].PHP_EOL;
                $scheduleArr[$workDays[$i_i + $index]] = "off"; 
            }
            $index++;
            return [$scheduleArr,$index];
    }
    

    for ($i = 0; $i < $N; $i++) {
        if(!$scheduleArr[$i])
          $scheduleArr[$i] = "追加";
    }
    
    // ksort($scheduleArr);
    // print($arr);
    // foreach ($scheduleArr as $key => $val) {
    //     echo "$key = $val\n";
    // }
    

    
?>