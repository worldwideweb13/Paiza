<?php
    /*　回答方針 
    * (1) カブトムシの位置を色毎に保持...x_R = 7, 
    * (2) ライトの方向(L -=, R +=)にt_1を引数にカブトムシの位置をずらす
    * (3) x_R、x_G、x_Bの位置を比較
    * (4) 全員が一致した時に画面を数字に出力,一致しない時は(2)を再度実行
    * (5) 全ての(t_N c_N)実行後、一致することがなければ"no"を画面に出力
    */
    
    //  (1) カブトムシの位置を色毎に保持...x_R = 7, 
    $N = trim(fgets(STDIN));
    [$x_R,$x_G,$x_B] = array_map('intval', explode(" ", trim(fgets(STDIN))));
    
    // (2) ライトの方向(L -=, R +=)にt_1を引数にカブトムシの位置をずらす
    for ($i = 0; $i < $N; $i++) {
        [$t_N,$c_N] = explode(" ", trim(fgets(STDIN)));
        // (2) ライトの方向(L -=, R +=)にt_1を引数にカブトムシの位置をずらす
        [$x_R,$x_G,$x_B] = setLight($t_N,$c_N,$x_R,$x_G,$x_B);
        // (3) x_R、x_G、x_Bの位置を比較
        if($x_R === $x_G && $x_G === $x_B && $x_B === $x_R){
            // (4) 全員が一致した時に画面を数字に出力,一致しない時は(2)を再度実行
           echo  $x_R.PHP_EOL;
           break;
        // (5) 全ての(t_N c_N)実行後、一致することがなければ"no"を画面に出力
        }elseif($i === $N - 1){
            echo "no".PHP_EOL;
        }else{
            continue;
        }
    }
    
    
    
    function setLight($t_N,$c_N,$x_R,$x_G,$x_B){
        // 右だったら++, 左の場合は-- にカブトムシをずらす
        $t_N = $t_N === "R" ? 1 : -1;
        //  "R", "G", "B", "Y", "M", "C", "W" 毎のカブトムシの動き
        switch ($c_N) {
            case 'R':
                $x_R += $t_N;
                break;
            case 'G':
                $x_G += $t_N;
                break;
            case 'B':
                $x_B += $t_N;
                break;
            case 'Y':
                $x_R += $t_N;
                $x_G += $t_N;
                break; 
            case 'M':
                $x_R += $t_N;
                $x_B += $t_N;
                break;
            case 'C':
                $x_G += $t_N;
                $x_B += $t_N;
                break;
            case 'W':
                $x_R += $t_N;
                $x_G += $t_N;
                $x_B += $t_N;
                break;
        }
        return [$x_R,$x_G,$x_B];
    }
    
    
?>