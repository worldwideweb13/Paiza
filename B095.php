<?php
    // 自分の得意な言語で
    // Let's チャレンジ！！
    
    // $members...歌う人数,$songLength...曲の長さ
    [$members,$songLength] = array_map('intval', explode(" ", trim(fgets(STDIN))));
    // $correctInterval...正しい音程
    $correctInterval = [];
    // $userIntervals...歌った人毎の音程の減点結果
    $intervalScores = [];
    
    for($x=0; $x <= $members; $x++){
        // $userInterval...歌った人(個人)の音程
        $userScore = 0;
        
        for($y=0; $y < $songLength; $y++){
            if($x == 0){
                array_push($correctInterval, (int)(fgets(STDIN)));
            }else{
                $intervalScore =  abs($correctInterval[$y] - (int)(fgets(STDIN)));
                $intervalScore = calScore($intervalScore);
                // array_push($userScore, $intervalScore);
                $userScore += $intervalScore;
            }
        }
        if($x != 0){
            array_push($intervalScores, 100 - $userScore);
        }
    }
    
    // var_dump($correctInterval);
    // echo "ユーザー入力値".PHP_EOL;
    // var_dump($intervalScores);
    
    // ユーザー毎の採点結果を取得
    function calScore($userScore){
        if($userScore <= 5){
            return 0;
        }elseif($userScore <= 10){
            return 1;
        }elseif ($userScore <= 20) {
            return 2;
        }elseif($userScore <= 30){
            return 3;
        }else {
            return 5;
        }
    }
    
    // 答えの出力
    if(max($intervalScores) < 0){
        echo 0;
    }else {
        echo max($intervalScores);
    }  
?>