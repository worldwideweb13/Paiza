<?php
    /*　回答方針 
    * (1) 入力文字列を配列化...$handArr
    * (2) array_count_valuesを用いて、(1)の重複文字チェック
    * (2-1) ノーペア...*がなく、配列数が4件の時
    * (2-1) ワンペア...*を含み配列数が4件 or *なし、配列数が3件
    * (2-1) ツーペア...*なし、配列数が2件で値が2,2
    * (2-1) スリーペア...*を含み配列数が3件 or *なし、配列数が2件値が3,1
    * (2-1) フォーカード...*を含み配列数が2件 or *なし、配列数が1件
    */
    
    // (1) 入力文字列を配列化...$handArr
    $handArr= str_split(trim(fgets(STDIN)));
    // var_dump($handArr);
    
    // (2) array_count_valuesを用いて、(1)の重複文字チェック
    cardCheck($handArr);
    
    function cardCheck($handArr){
        $checkArr = array_count_values($handArr);
        $arrCount = count($checkArr);
        $wildCard = array_key_exists("*",$checkArr);
        
        // (2-1) ノーペア...*がなく、配列数が4件の時
        if ($arrCount == 4 && !$wildCard) {
            echo "NoPair";
        // (2-1) ワンペア...*を含み配列数が4件 or *なし、配列数が3件
        }elseif(($arrCount == 4 && $wildCard) || ($arrCount == 3 && !$wildCard))  {
            echo "OnePair";
        // (2-1) ツーペア...*なし、配列数が2件で値が2,2
        }elseif($arrCount == 2 && !$wildCard && in_array(2,$checkArr)){
            echo "TwoPair";
        // (2-1) スリーペア...*を含み配列数が3件 or *なし、配列数が2件値が3,1
        }elseif (($arrCount == 3 && $wildCard) || ($arrCount == 2 && !$wildCard && in_array(3,$checkArr))) {
            echo "ThreeCard";
        // (2-1) フォーカード...*を含み配列数が2件 or *なし、配列数が1件
        }elseif(($arrCount == 2 && $wildCard) || ($arrCount == 1 && !$wildCard)){
            echo "FourCard";
        }
    }

?>