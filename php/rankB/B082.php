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
        // (2-2) scheduleArrの2番目の"work"から"off"に(以下略) $offDaysを$offDaysArrに追加
         [$editArr,$index] = editArr($scheduleArr,$M,$index);
         $ans = countArr($editArr);
        $ansArr[] = $ans;
    }

    // (3) $countArrの中で最も大きい数字を出力
    echo max($ansArr).PHP_EOL;
    
    function editArr($scheduleArr,$M,$index){
        // 働く日のkey配列を取得
        $workDays = array_keys($scheduleArr,"work");
        
        // workの数 - M + 1回 配列を置き換える
            for ($i_i = 0; $i_i < $M; $i_i++) {
                // $workDaysのindexの開始位置を1個ずつずらす
                $scheduleArr[$workDays[$i_i + $index]] = "off"; 
            }
            $index++;
            return [$scheduleArr,$index];
    }
    
    function countArr($editArr){
        $ans = 0;
        $count = 0;
        $arr_last_key = array_key_last($editArr);
        foreach ($editArr as $i => $shift) {
            if ($shift === "off") {
                $count++;
                // 配列の最後の時は前回のoffの連続回数と比較
                if($i === $arr_last_key && $ans <= $count){
                    $ans = $count;
                }
            }else{
                $ans = $ans <= $count ? $count : $ans;
                $count = 0;
            }
        }
        return $ans;
    }
    
?>