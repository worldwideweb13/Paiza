<?php
    /*　回答方針 
    * (1) 0~N段の配列を作成(N_Arr)
          0からA刻み~N段の配列を作成(A_Arr)
          0からB刻み~N段の配列を作成(A_Arr)
    * (2) N_ArrとA_Arr,A_Arrの差分を取得して配列化(ans_Arr)
    * (3) (2)を画面に表示
    */
    
    // (1) 0~N段の配列を作成(N_Arr)
        // 0からA刻み~N段の配列を作成(A_Arr)
        // 0からB刻み~N段の配列を作成(B_Arr)
    $N = (int)trim(fgets(STDIN));
    [$A,$B] = array_map('intval', explode(" ", trim(fgets(STDIN))));
    $AB = $A + $B;
    
    for ($i = 0; $i <= $N; $i++) {
        $N_Arr[$i] = $i;
        
        if($i % $A === 0){
            $A_Arr[$i] = $i;
        }
        
        if($i % $B === 0){
            $B_Arr[$i] = $i;
        }
        
        if($i % $AB === 0){
            $AB_Arr[$i] = $i;
        }
        
        if($i === $N){
            $A_Arr[$i] = $i;
            $B_Arr[$i] = $i;
            $AB_Arr[$i] = $i;
        }
        
    }
    
    // (2) N_ArrとA_Arr,A_Arrの差分を取得して配列化(ans_Arr)
    $halfWay_Ans = array_diff($N_Arr,$A_Arr,$B_Arr,$AB_Arr);
    
    foreach ($halfWay_Ans as $i => $val) {
        
        if($AB < $val){
            $count = (int)floor($val / $A);
            $remain_A = $val % $A;
            for ($i = 0; $i < $count; $i++) {
                // echo "通りました----- Aは".$A." valは$val".PHP_EOL;
                // var_dump($count);
                $remain_A += $A;
                // var_dump($remain_A);
                if($remain_A % $B === 0){
                    $A_B_Arr[] = $val;
                    break;
                }
            }
        }
        
    }


    
    if($A_B_Arr !== null){
        $ans_Arr = array_diff($halfWay_Ans,$A_B_Arr);
    }else{
        $ans_Arr = $halfWay_Ans;
    }

    echo count($ans_Arr).PHP_EOL;

    
?>