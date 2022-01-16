<?php
    // 自分の得意な言語で
    // Let's チャレンジ！！
    /*　回答方針 
    * (1) 各木に備えつけられた電球の数の配列を用意
    * (2) 調査区間毎の連想配列を用意
    * (3) (2)を一つずつ取り出して、電球追加後の値に(1)を更新
    * (4) (3)を出力
    */
    [$N,$average] = array_map('intval', explode(" ", trim(fgets(STDIN))));
    $areaArray = array_map('intval', explode(" ", trim(fgets(STDIN))));
    $Q = (int)trim(fgets(STDIN));
    $researchArea = [];
    for($i=0; $i< $Q; $i++){
        [$S_i,$E_i] = array_map('intval', explode(" ", trim(fgets(STDIN))));
        $research = array("start" => $S_i-1, "end" => $E_i-1, "range" => ($E_i - $S_i) + 1 );
        array_push($researchArea,$research);
    }
    // (3) (2)を一つずつ取り出して、電球追加後の値に(1)を更新
    // 手順
    // 1.$researchAreaのstart,endの配列を取り出して平均の電球の数の平均値を取得
    // 2.$average-1 をする。
    // 3. 2.がマイナス値でない場合、区間の電球の数を追加
    foreach ($researchArea as $research) {
        $areas = array_slice($areaArray,$research["start"],$research["range"] );
        $score = floor(array_sum($areas) / $research["range"]);
        $diff = $average - $score;
        if($diff > 0){
            for($i=$research["start"]; $i <= $research["end"]; $i++){
                $areaArray[$i] += $diff;
            }
        }
    }
    
    // 回答結果を出力
    echo implode(" ",$areaArray);

?>