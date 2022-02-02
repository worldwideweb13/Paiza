<?php
    /*　回答方針 
    * (1) 行毎 (a_ij)の配列を作成
    * (2) 行毎にK×K の値を取り出して平均値を計算 
    * (3) (2)の結果を行毎に配列で保持
    * (4) (3)を行毎に表示
    */
    [$N,$K] = array_map('intval', explode(" ", trim(fgets(STDIN))));
    $rowCount = $N / $K;
    $TotalRoupCount = ($N / $K) ** 2;
    
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
    // var_dump($calArray);
    $columnIndex = 0;
    // ブロックの個数分ループ文を廻して、各ブロックの合計値を算出
    for ($i_1 = 0; $i_1 < $N ; $i_1 += $K) {

        for($i_2 = 0; $i_2 < $rowCount; $i_2++){
            // echo " i_2は".$i_2.PHP_EOL;
            // ブロック内の配列個数分for文を廻して、ブロック内の合計値を算出
            $pixels = 0;            
            for ($i_3 = 0; $i_3 < $K; $i_3++) {
                $pixels += $calArray[$i_1 + $i_3][$i_2];
                // echo "i_1は".$i_1." i_2は".$i_2." i_3は".$i_3.PHP_EOL;
            }
            // var_dump("計算結果は".$pixels." 答えは".intdiv($pixels,$K**2));
            $pixels = intdiv($pixels,$K**2);
            array_push($shrinkPixelArray,$pixels);
        }

    }
    // var_dump($shrinkPixelArray);

    $count_c = ($N / $K);
    $output_r = 0;
    for($i = 0;$i <  $count_c ;$i++ ){
        $echoArray = array_slice($shrinkPixelArray,$output_r,$count_c);
        echo implode(" ",$echoArray).PHP_EOL;
        $output_r += $count_c;
    }
    
?>