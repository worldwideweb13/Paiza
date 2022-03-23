<?php
/*　回答方針 
    * (1) $N,$M,$Kを変数に,枚毎に$cardsArrを配列化($cardsArr)
    * (2) K回,$cardsArrsを引数にカードシャッフルをする関数を実行
    * (3) $cardsArrを画面に出力
    */
    
    // (1) $N,$M,$Kを変数に,枚毎に$cardsArrを配列化($cardsArr)
    [$N,$M,$K] = array_map('intval', explode(" ", trim(fgets(STDIN))));
    // M枚未満の束の枚数=remainder
    $remainder = $N % $M;
    $roupCount = $remainder >= 1 ? (int)floor(($N / $M)) + 1 : $N / $M;
    for ($i = 0; $i < $N; $i++) {
        $cardsArr[] = $i + 1;
    }
    $lastKey = count($cardsArr);
    
    // (2) K回,$cardsArrsを引数にカードシャッフルをする関数を実行
    for ($i = 0; $i < $K; $i++) {
        $cardsArr = cardBundle($cardsArr,$roupCount,$remainder,$lastKey,$M);
    }    
    
    // (3) $cardsArrを画面に出力
    foreach ($cardsArr as $card) {
        echo $card.PHP_EOL;
    }
    
  
    // (2) K回,$cardsArrsを引数にカードシャッフルをする関数を実行    
    function cardBundle($cardsArr,$roupCount,$remainder,$lastKey,$M){
        $rightCounter = 0;
        $leftCounter = $lastKey;
        for ($i = 0; $i < $roupCount; $i++) {
            
            // 最後のカードの束がM枚未満の場合
            if($remainder >= 1 && $i === 0){
                for($i_s = 0; $i_s < $remainder; $i_s++){
                    // 束のシャッフル後,カードのi番目は,シャッフル前カードの一番後ろの束から数えてi番目
                    $newCardsArr[$i_s] = $cardsArr[$leftCounter - ($remainder - $i_s)];
                }
                // 次のループでは、cardsArr[]のindex位置を、remainder分ずらして、データ取得
                $leftCounter-=$remainder;
                 // 次のループでは、cardsArr[]のindex位置を、remainder分ずらして、データ追加              
                $rightCounter+=$remainder;
            }else{
                for ($i_s = 0; $i_s < $M; $i_s++) {
                    // 束のシャッフル後,カードのi番目は,シャッフル前カードの一番後ろの束から数えてi番目
                    $newCardsArr[$i_s + $rightCounter] = $cardsArr[$leftCounter - ($M - $i_s)];
                }
                // 次のループでは、cardsArr[]のindex位置を、M分ずらして、データ取得
                $leftCounter-=$M;
                // 次のループでは、cardsArr[]のindex位置を、M分ずらして、データ追加
                $rightCounter+=$M;
            }
            
        }
        return $newCardsArr;
    }

?>
