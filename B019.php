<?php
    /*　回答方針 
    * (1) 行毎 (a_ij)の配列を作成
    * (2) 行毎にK×K の値を取り出して平均値を計算 
    * (3) (2)の結果を行毎に配列で保持
    * (4) (3)を行毎に表示
    */
    [$N,$K] = array_map('intval', explode(" ", trim(fgets(STDIN))));
    $roupCount = ($N / $K) ** 2;
    
    $pixelArray = [];
    for($i=0; $i< $N; $i++){
        $pixels = array_map('intval', explode(" ", trim(fgets(STDIN))));
        array_push($pixelArray,$pixels);
    }
    
    $calArray = [];
    foreach ($pixelArray as $pixels) {
        $shrinkRow = 0; //行毎
        $shrinkPixels = [];
        
        // ピクセル一つずつを取り出して足し合わせる(行)
        foreach ($pixels as $i => $pixel) {
            $shrinkRow += $pixel;
            // var_dump($i + 1);
            // var_dump($K);
            // K回目毎に配列を作成
            if(($i + 1) % $K == 0){
               array_push($shrinkPixels,$shrinkRow);
               $shrinkRow = 0;
            }
        }
       array_push($calArray,$shrinkPixels);
    }
    
    $shrinkPixelArray = [];
    var_dump($calArray);
    $countColumn = 0;
    // ブロックの個数分ループ文を廻して、各ブロックの合計値を算出
    for ($i = 0; $i < $roupCount * 2 ; $i+=2) {
        // ブロック内の配列個数分for文を廻して、ブロック内の合計値を算出
        $pixels = 0;
        // 計算するブロックの列が変わる時は、ブロック配列のindexを変更
        if(($i + 1) % ($N / $K) == 0){
            $countColumn += $K;
        }
        
        for ($i_c = 0; $i_c <= $K; $i_c++) {
            echo "countColumnは$countColumn"." iは$i"." i_cは$i_c".PHP_EOL;
            $pixels = $calArray[$countColumn + $i][$i_c] + $calArray[$countColumn + $i + 1][$i_c];
            var_dump("計算する値は".$calArray[$countColumn + $i_c][$i]."と".$calArray[$countColumn + $i_c + 1][$i]);
            var_dump("計算結果は".$pixels." 答えは".$pixels /= floor($K*$K));
        }
        $pixels /= floor($K*$K);
        array_push($shrinkPixelArray,$pixels);
    }
    exit;
    
    $count_c = ($N / $K);
    $output_r = 0;
    $output_c =  $count_c;
    for($i = 0;$i <  $count_c ;$i++ ){
        $echoArray = array_slice($shrinkPixelArray,$output_r,$output_c);
        echo implode(" ",$echoArray).PHP_EOL;
        $output_r += $count_c;
        $output_c += $count_c;
    }
    
?>