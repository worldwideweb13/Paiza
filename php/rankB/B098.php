<?php
    /*　回答方針 
    * (1) N,M,T,Kを変数化,発言毎の配列(commentArrs)を作成
    * (2-1) 発言毎にT回、連続して配列の値を足し合わせて(totlaComments) >= K かチェック
    * (2-2) (2-1)がtrueだった時,配列の最後のindex番号を取得,値を配列で保存(ansArrs)
    * (2-2) (2-1)がfalseだった時,(2-1)を再度実行。
                 その時,indexの開始位置を一つずらす。
      (2-3) (2-1)を(M-T＋1)回繰り返して,totlaComments >= K にならなかった時
            ansArrsに"no","0"を保存
      (3) ansArrsを画面に表示        
    */ 
    
    
    // (1) N,M,T,Kを変数化,発言毎の配列(commentArrs)を作成
    [$N,$M,$T,$K] = array_map('intval', explode(" ", trim(fgets(STDIN))));
    
    for ($i = 0; $i < $M; $i++) {
        $dataArr = array_map('intval', explode(" ", trim(fgets(STDIN))));
        for ($i_i = 0; $i_i < $N; $i_i++) {
            $commentArrs[$i_i][$i] = $dataArr[$i_i];
        }
    }
    
    foreach ($commentArrs as $i => $commentArr) {
        
        [$ansArrs[$i]["answer"],$ansArrs[$i]["score"]] = bazzCheck($commentArr,$M,$T,$K);
    }
    
    // ansArrsを画面に表示
    foreach ($ansArrs as $ansArr) {
        echo $ansArr["answer"]." ".$ansArr["score"].PHP_EOL;
    }

    // (2-1) 発言毎にT回、連続して配列の値を足し合わせて(totlaComments) >= K かチェック
    function bazzCheck($commentArr,$M,$T,$K){
        $roupCounter = $M - $T + 1;
        $counter = 0;
        for ($i_1 = 0; $i_1 < $roupCounter; $i_1++) {
            $ans = 0;
            for ($i_2 = 0; $i_2 < $T; $i_2++) {
                $ans +=  $commentArr[$i_2 + $counter];
                // (2-2) (2-1)がtrueだった時,配列の最後のindex番号を取得,値を配列で保存(ansArrs)                
                if($ans >= $K){
                    return ["yes", $i_2 + $counter + 1];                  
                }
            }
            // (2-2) (2-1)がfalseだった時,(2-1)を再度実行。
            // その時,indexの開始位置を一つずらす。            
            $counter++;
            // (2-3) (2-1)を(M-T＋1)回繰り返して,totlaComments >= K にならなかった時
            // ansArrsに"no","0"を保存            
            if($counter === $roupCounter){
                return  ["no", 0];
                continue;
            }
        }
    }
    
?>