<?php
    /*　回答方針 
    * (1) S_1,S_2を配列化(S_1Arr, S_2Arr)
    * (2-1) S_1Arr,S_2Arrを1文字ずつ取り出し５進数に変換
    * (2-2) (2-1)を１０進数に変換
    * (2-3) S_1Arr + S_2Arrを実行(Ans)
    * (3-1) Ansを５進数に変換
    * (3-2) Ansをpaiza文字列に変換
    * (3-3) 画面に表示
    */
    
    // (1) S_1,S_2を配列化(S_1Arr, S_2Arr)
    [$S_1,$S_2] = explode(" ", trim(fgets(STDIN)));
    $S_1Arr = str_split($S_1);
    $S_2Arr = str_split($S_2);
    
    // (2-1) S_1Arr,S_2Arrを1文字ずつ取り出し５進数に変換
    $S_1Arr = paiza_Five($S_1Arr);
    $S_2Arr = paiza_Five($S_2Arr);

    
    // (2-2) (2-1)を１０進数に変換
    $S_1Arr = five_Ten($S_1Arr);
    $S_2Arr = five_Ten($S_2Arr);
    // var_dump($S_1Arr);
    // var_dump($S_2Arr);
    
    // (2-3) S_1Arr + S_2Arrを実行(Ans)
    $ans = (int)array_sum($S_1Arr) + (int)array_sum($S_2Arr);
    // var_dump($ans);
    
    // (3-1) Ansを５進数に変換
    $ans = ten_Five($ans);
    // var_dump($ans);

    
    // (3-2) Ansをpaiza文字列に変換
    $ans = five_Paiza($ans);
    
    // (3-3) 画面に表示
    echo implode($ans).PHP_EOL;
    
    function paiza_Five($Arr){
        foreach ($Arr as $i => $val) {
            switch ($val) {
                case 'A':
                    $Arr[$i] = 0;
                    break;
                case 'B':
                    $Arr[$i] = 1;
                    break;
                case 'C':
                    $Arr[$i] = 2;
                    break;
                case 'D':
                    $Arr[$i] = 3;
                    break;
                case 'E':
                    $Arr[$i] = 4;
                    break;
            }
        }
        return $Arr;
    }
    
    function five_Ten($Arr){
        $rank = count($Arr) - 1;
        for ($i = 0; $i < count($Arr); $i++) {
            // 1の位は,1 * i になる
            if($rank === 0){
             continue;   
            }else{
            // ２の位以降は5のべき乗
             $Arr[$i] *= pow(5,$rank);
             $rank--;
            }
        }
        return $Arr;
    }
    
    
    function ten_Five($ans){
        $rank = null;
        
        while((int)floor($ans / 5) !== 0){
            $rank = floor($ans % 5).$rank;
            $ans = (int)floor($ans / 5);
        }
        $ans .= $rank;
        return $ans;
    }
    
    
    function five_Paiza($ans){
        $ans = str_split($ans);
        foreach ($ans as $i => $val) {
            switch ($val) {
                case "0":
                    $ans[$i] = "A";
                    break;
                case "1":
                    $ans[$i] = "B";
                    break;
                case "2":
                    $ans[$i] = "C";
                    break;
                case "3":
                    $ans[$i] = "D";
                    break;
                case "4":
                    $ans[$i] = "E";
                    break;
            }
        }
        return $ans;
    }
    
    
?>