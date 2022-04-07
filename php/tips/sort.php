<?php

    $N = (int)trim(fgets(STDIN));
    
    for ($i = 0; $i < 2; $i++) {
        if($i === 0){
            $math = array_map('intval', explode(" ", trim(fgets(STDIN))));;
        }else{
            $english = array_map('intval', explode(" ", trim(fgets(STDIN))));;
        }
    }
    
    for ($i = 0; $i < $N; $i++) {
        $studentArr[$i]["no"] = $i + 1;
        $studentArr[$i]["score"] = $math[$i] + $english[$i];
        $studentArr[$i]["math"] = $math[$i];
        $studentArr[$i]["english"] = $english[$i];
    }
    
    $SortPrimaryKey = array_column($studentArr, "score");
    $SortSecondKey = array_column($studentArr, "math");
    $SortThirdKey = array_column($studentArr, "no");

    
    array_multisort($SortPrimaryKey, SORT_DESC, 
    $SortSecondKey,SORT_DESC,
    $SortThirdKey,SORT_ASC,
    $studentArr);
    
    $ans = array_column($studentArr, "no");
    echo implode(" ",$ans).PHP_EOL;
?>