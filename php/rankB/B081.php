<?php
    // 自分の得意な言語で
    // Let's チャレンジ！！
    // [1]必要な変数を連想配列形式で格納
        // line = 行 row = 列,edgeNum = 正方形の辺の数, edgeNumCount = 隣接する辺の数
        // lineArray = 行の値の連想配列 rowArray = 列の値の連想配列 
    // [2]必要な変数を連想配列形式で格納
        // line = 行 row = 列 lineArray = 行の値の連想配列 rowArray = 列の値の連想配列
    // [3]lineArray,rowArrayを一つずつ取り出して関数実行
        //#が隣接する場合はedgeNumCount+2 
        // edgeNum - edgeNumCount = 答えになる
    // 行,列
    [$line,$row] = explode(" ", trim(fgets(STDIN)));
    
    // lineArray = 行の値の連想配列 
    $lineArray = array();
    for($i=0; $i < $line; $i++){
        $rowStr = trim(fgets(STDIN));
        // 列を配列化
        $lineArray_1 = str_split($rowStr);
        array_push($lineArray,$lineArray_1);
    }
    // rowArray = 列の値の連想配列
    $rowArray = array();
    for($x=0; $x < $row; $x++){
        $rowArray_1 = array();
        for($i=0; $i < count($lineArray); $i++){
            $rowArray_1[] =  $lineArray[$i][$x];
        }
        array_push($rowArray,$rowArray_1);
    }

    // edgeNum = 正方形の辺の数, edgeNumCount = 隣接する辺の数
    // edgeNum - edgeNumCount = 答え
    $edgeNum;
    $edgeNumCount;
    // 列のロープの数を調べる
    foreach ($lineArray as $val) {
            // echo "配列毎に取り出し"."\n";
            // 配列の一番最初の要素が#だった場合は$edgeNumを＋
            if($val[0]=="#"){
                $edgeNum += 4;
            }
        // 配列の右隣りの値が"#"だった時
        // $edgeNum+=4, $edgeNumCount += 2
        for($i=0; $i < $row -1; $i++){
            if($val[$i]=="." && $val[$i+1]=="."){
                continue;
            }
            
            if($val[$i]=="." && $val[$i+1]=="#"){
                $edgeNum +=  4;
                // echo "edgeNum: ".$edgeNum."\n";
                continue;
            }
            
            if($val[$i]=="#" && $val[$i+1]=="#"){
                $edgeNum +=  4;
                $edgeNumCount += 2;
                // echo "edgeNum: ".$edgeNum."\n";
                // echo "edgeNumCount: ".$edgeNumCount."\n";
                continue;
            }
        }
    }
    
    // 行のロープの数を調べる
    foreach($rowArray as $val){
        
        for($i=0; $i < $line -1; $i++){
            // 配列の右隣りの値が"#"だった時
            // $edgeNumCount += 2
            if($val[$i]=="#" && $val[$i+1]=="#"){
                $edgeNumCount += 2;
            }
            
        }
        
    }
    $answer = $edgeNum - $edgeNumCount;
    echo $answer;
?>