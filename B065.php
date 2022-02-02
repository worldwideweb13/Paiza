<?php
    // 自分の得意な言語で
    // Let's チャレンジ！！
    /*　回答方針 
    * (1) マス配列、ルール配列、マス結果配列を作成。
    * (2) マス配列、ルール配列
    * (3) (2)の結果を行毎に配列で保持
    * (4) (3)を行毎に表示
    */
    
    //(1) マス配列、ルール配列、マス結果配列を作成
    [$S,$T] = explode(" ", trim(fgets(STDIN)));
    $massArr = str_split($S);
    $ruleArr = str_split($T);
    $resultArr = $massArr;
    $ans = "NO";
    
    /* (2) マス配列、ルール配列
    * 2の10乗=1024,1024回ループさせることで10ますの全てのパターンを網羅
    */
    for ($i = 0; $i < 1024; $i++) {
        // massGame...前回のマスゲームの結果と更新ルールを引数にマスゲーム結果配列を作成
        $resultArr = massGame($resultArr,$ruleArr);
        // 初期状態のマス配列とゲーム結果配列を比較。初期状態と一致した時点で結果を出力
        $ansArr = array_diff_assoc($resultArr,$massArr);
        if (is_array($ansArr) && empty($ansArr)) {
            $ans = "YES";
            break;
        }else{
            continue;
        }
    }
    
    echo $ans;
    
    function massGame($massArr,$ruleArr){
        $_resultArr = [];
        for ($i = 0; $i < 10; $i++) {
            $left = "";
            $right = "";
            if($i == 0){
                $left = $massArr[9];
                $right = $massArr[$i + 1];
            }elseif($i == 9){
                $left = $massArr[$i - 1];
                $right = $massArr[0];
            }else{
                $left = $massArr[$i - 1];
                $right = $massArr[$i + 1];
            }
            //マス左右の組み合わせを照合
            $key = massChange($left,$right);
            $ans = $ruleArr[$key];
            array_push($_resultArr,$ans);
        }
        return $_resultArr;
    }
    
    function massChange($left,$right){
        $leftRight = $left.$right;
        switch ($leftRight) {
            case '--':
                // "左右" = "--"
                return 0;
                break;
            case '-+':
                // "左右" = "-+"
                return 1;
                break;
            case '+-':
                // "左右" = "+-"
                return 2;
                break;
            case '++':
                // "左右" = "++"
                return 3;
                break;                
        }
    }
    
    
?>