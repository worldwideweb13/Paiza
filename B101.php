<?php
    // 自分の得意な言語で
    // Let's チャレンジ！！
    
    // $children...子供の人数,$candyBox...各箱のキャンディの数
    $children = (int)(fgets(STDIN));
    $candyBox = array_map('intval', explode(" ", trim(fgets(STDIN))));
    // var_dump($candyBox);

    //  $ascArray...昇順のキャンディの箱, $descArray...降順のキャンディの箱,
    [$ascArray,$descArray] = sortCandy($children,$candyBox);
    
    // 回答結果を取得して表示
    $answer = ans($ascArray,$descArray,$children);
    echo $answer;
    
    function sortCandy($children,$candyBox){
        // 昇順の配列($ascArray)と降順の配列($descArray)を作成
        $ascArray = $candyBox;
        $descArray = $candyBox;
        sort($ascArray);
        rsort($descArray);
        return [$ascArray,$descArray];
    }
    
    
    function ans($ascArray,$descArray,$children){
        $calcArray = [];
        // 配列の最小値($descArray[i])と最大値($ascArray[i])を順に足し合わせる
        for ($i = 0; $i < $children; $i++) {
            array_push($calcArray,$ascArray[$i] + $descArray[$i]);
        }
        // 回答結果を降順に並びかえる
        rsort($calcArray);
        // 最大値($calcArrayの先頭行)から最小値($calcArrayの末尾)を引く
        return $calcArray[0] - $calcArray[count($calcArray)-1];
    }

?>