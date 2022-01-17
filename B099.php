<?php
    // 自分の得意な言語で
    // Let's チャレンジ！！
    /*　回答方針 
    * (1) 各ルート毎の連想配列を作成...cf.[0:[0:100][1:200]...],]
    * (2) ルート毎の降水量を足し合わせて、閾値(M)と比較
    * (3) 域値を超えない場合は、そのルート番号を配列で保持
    * (4) (3)を空文字区切りで表示、一つもない場合は"wait"と出力
    */ 

    //(1) 各ルート毎の連想配列を作成...cf.[0:[0:100][1:200]...],]
    [$N,$border] = array_map('intval', explode(" ", trim(fgets(STDIN))));
    $calLists = [];
    $routeLists = [];
    $ansLists = [];
    
    for ($i=0; $i<$N; $i++) {
        $routes = array_map('intval', explode(" ", trim(fgets(STDIN))));
        array_push($calLists,$routes);
    }
    // 各ルート毎の連想配列を作成
    for($x=0; $x<$N; $x++){
        $route = [];
        for($y=0; $y<$N; $y++){
            array_push($route,$calLists[$y][$x]);
        }
        array_push($routeLists,$route);
    }
    
    //(2) ルート毎の降水量を、閾値(M)と比較
    foreach ($routeLists as $x => $routes) {
        foreach ($routes as $y => $route) {
            if($border <= $route){
                break;
            }elseif($y == count($routes)-1){
                array_push($ansLists,$x+1);
            }
            
        }
    }
    
    // exit;
    // (4) (3)を空文字区切りで表示、一つもない場合は"wait"と出力
    if (empty($ansLists)){
      echo 'wait';
    } else {
        echo implode(" ",$ansLists);
    }
?>