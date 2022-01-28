<?php
    // 自分の得意な言語で
    // Let's チャレンジ！！
    [$students,$questions] = explode(" ", trim(fgets(STDIN)));
    //$point...一問あたりの配点 
    $point = 100 / $questions; 
    // $studentArray...生徒の提出日とスコアを連想配列で保持
    $studentArray = [];
    for($i=0; $i<$students; $i++){
        $array = [];
        [$deadLine,$score] = explode(" ", trim(fgets(STDIN)));
        $array["deadLine"] = $deadLine;
        $array["score"] = $score;
        array_push($studentArray,$array);
    }
    
    // $studentArrayから生徒の成績を取り出してテストの点数を計算する
    foreach ($studentArray as $i => $student) {
        $ans = $student["score"] * $point;
        if($student["deadLine"] >= 10){
            $ans = 0;
        }elseif($student["deadLine"] >= 1 && $student["deadLine"] <= 9){
            $ans = floor($ans * 0.8);
        }
        
        // score判定.回答結果を出力する
        if($ans >= 80){
            echo "A".PHP_EOL;
        }elseif($ans >= 70){
            echo "B".PHP_EOL;
        }elseif($ans >= 60){
            echo "C".PHP_EOL;
        }else{
            echo "D".PHP_EOL;
        }
    }
    
?>