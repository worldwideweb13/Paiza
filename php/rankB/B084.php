<?php
    /*　回答方針 
    * (1) N,M,Kを変数化,s_i行を配列化(playerArr), t_{i, j}を2次元配列化userArrs
    * (2) userArrsを行毎に取り出し(userArr), 自分と好みが似ているか確認。
          好みが似ていた場合、以下の関数実行
    *  (2-1) 
    *  (2-3) (2-2)がtrueの時、s_iが0 かつ t_iが３の配列番号を取得(Ans)
    *  (2-4) Ansを配列化
    * (3) Ansを画面に出力
    */
    
    // (1) N,M,Kを変数化,s_i行を配列化(playerArr), t_{i, j}を2次元配列化userArrs
    [$N,$M,$K] = array_map('intval', explode(" ", trim(fgets(STDIN))));
    $playerArr = array_map('intval', explode(" ", trim(fgets(STDIN))));
    for ($i = 0; $i < $M; $i++) {
        $userArrs[] = array_map('intval', explode(" ", trim(fgets(STDIN))));
    }
    $ansArr = array();
    
    
    foreach ($playerArr as $i => $val) {
        // userArrsのreview 0(行ったことのないお店)の配列番号と
        // userArrsのreview 3(高評価のお店)の配列番号を取得
        if($val === 0){
            $playerUnratedArr[] = $i;
        }else{
            if($val === 3){
                $playerHighlyRatedArr[] = $i;
            }else{
                continue;
            }
        }
    }
    
    // (2) userArrsを行毎に取り出し(userArr), 自分と好みが似ているか確認。
    foreach ($userArrs as $userArr) {
        if(checkUser($K,$userArr,$playerHighlyRatedArr)){
            // echo "以下のuserArrの時に通りました----".PHP_EOL;
            // var_dump($userArr);
            // echo "--------------------".PHP_EOL;
            //好みが似ていた場合、以下の関数実行 
            $ansArr = checkReview($playerArr,$userArr,$playerUnratedArr,$ansArr);
        }
    }
    
    // (3) Ansを画面に出力
    if (is_array($ansArr) && empty($ansArr)) {
        echo "no".PHP_EOL;
    }else{
        // 配列を小さい順に並び替える
        sort($ansArr);
        echo implode(" ",$ansArr).PHP_EOL;
    }
    
    
    // (2) K,playerArr,userArrsから以下の関数実行
    function checkUser($K,$userArr,$playerHighlyRatedArr){
        // var_dump($playerHighlyRatedArr);
        $counter = 0;
        foreach ($playerHighlyRatedArr as $index) {
            if($userArr[$index] === 3){
                // echo "indexは $index userArは".$userArr[$index]."counterをプラス".PHP_EOL;
                $counter++;
            }else{
                continue;
            }
        }
        $flg = $K <=  $counter ? true : false;
        return $flg;         
    }
    
    //好みが似ていた場合、以下の関数実行 
    function checkReview($playerArr,$userArr,$playerUnratedArr,$ansArr){
        foreach ($playerUnratedArr as $index) {
            $ans = $index + 1;
            // $bool = in_array($ans,$ansArr);
            // echo $ans."は答えの配列に存在するか？".PHP_EOL;
            // var_dump($ansArr);
            // echo "答えは";
            // var_dump($bool);
            if($userArr[$index] === 3 && !in_array($ans,$ansArr)){
                $ansArr[] = $ans;
            }else{
                continue;
            }
        }
        return $ansArr;
    }
?>