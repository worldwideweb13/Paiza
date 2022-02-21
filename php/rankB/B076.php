<?php
    /*　回答方針 
    * (1) パンの連想配列を用意...[[価格:a_1,在庫数:b_1],[]]
    * (2) 注文(order)と焼き上げ(bake) 関数を用意。(1)を引数にq_i回、関数実行
    * (2-1) 注文(order)の時、注文合計額を出して、(1)の在庫数を減らす or -1 → 結果を表示
    * (2-1) 焼き上げ(bake)の時、(1)の在庫数を足す
    */
    
    // (1) パンの連想配列を用意...[[価格:a_1,在庫数:b_1],[]]
    [$N,$Q] = array_map('intval', explode(" ", trim(fgets(STDIN))));
    for ($i = 0; $i < $N; $i++) {
        [$price,$stock] = array_map('intval', explode(" ", trim(fgets(STDIN))));
        $bakesArr[$i]["price"] = $price;
        $bakesArr[$i]["stock"] = $stock;
    }
    // 注文配列を用意
    for ($i = 0; $i < $Q; $i++) {
        $queryArr[$i] = explode(" ", trim(fgets(STDIN)));
        foreach ($queryArr[$i] as $i_y => $val) {
            if ($i_y == 0) {
                continue;
            }else{
               $queryArr[$i][$i_y] = (int)$val;
            }
        }
    }
    // var_dump($queryArr);
    
    foreach ($queryArr as $query) {
        
        // var_dump($bakesArr);
        $query[0] == "buy" ? $bakesArr = buy($query,$bakesArr) : $bakesArr = bake($query,$bakesArr);
        // var_dump($bakesArr);
    }
    
    
    
    function bake($query,$bakesArr){
        // var_dump($bakesArr);
        foreach ($bakesArr as $i => $stock) {
            $bakesArr[$i]["stock"] += $query[$i + 1];
        }
        // echo "bake関数実行後".PHP_EOL;
        // var_dump($bakesArr);
        return $bakesArr;
    }

    function buy($query,$bakesArr){
        $price = 0;
        // 在庫の過不足チェック。足りない場合は$flgに-1
        foreach ($query as $i => $buy) {
            if ($i == 0) {
                continue;
            }else{
                ($bakesArr[$i - 1]["stock"] - $buy) < 0 ? $flg = -1 : $price += $bakesArr[$i - 1]["price"] * $buy;
            }
        }
        
        // 在庫が足りない場合は-1表示
        if ($flg == -1) {
            echo $flg.PHP_EOL;
            return $bakesArr;
        }else{
            // 注文を受けられる場合は、注文個数分、在庫から減らす。
            foreach ($query as $i => $buy) {
                if ($i == 0) {
                    continue;
                }else{
                    $bakesArr[$i - 1]["stock"] -= $buy;                
                }
            }
            // echo "buy関数実行後".PHP_EOL;
            // var_dump($bakesArr);
            echo $price.PHP_EOL;
            return $bakesArr;
        }
    }
    
    
?>