<?php
    /* 
    * 以下のようなデータ入力を想定します。"S"を初期値とし、Sの位置はデータ入力毎に変わります。
    * H W X Y     5 5 4 2   --想定されるデータ入力--
      s_1         .#..#        . # . . #
      s_2     →   #.###    →   # . # # #
      ...         ##...        # # 3 2 1
      s_H         #..#S        # 5 4 # S
                  #.###        # 6 # # #
    * 想定されるデータ入力を連想配列 [列:[行]...]の形式で持つ。($dungeonArr)
    * 配列の4片に数字が入っていた場合、YESと出力 / 入っていない場合Noと出力
    */ 

    $NoFlg = true;
    for ($i = 0; $i < 5; $i++) {
        if($NoFlg){
             switch ($i) {
                 // 一番上の列に数字が入っているかを確認
                 case 0:
                     foreach ($dungeonArr[0] as $val) {
                         if(is_int($val) || $val === "S"){
                             echo "YES".PHP_EOL;
                             $NoFlg = false;
                             break 3;
                         };
                     }
                     break;
                 // 一番下の列に数字が入っているかを確認
                 case 1:
                     foreach ($dungeonArr[count($dungeonArr) - 1] as $val) {
                         if(is_int($val) || $val === "S"){
                             echo "YES".PHP_EOL;
                             $NoFlg = false;
                             break 3;
                         };
                     }
                     break;
                 // 一番右の行に数字が入っているかを確認
                 case 2:
                     foreach ($dungeonArr as $valArr) {
                         if(is_int($valArr[count($valArr) - 1]) || $valArr[count($valArr) - 1] === "S"){
                             echo "YES".PHP_EOL;
                             $NoFlg = false;
                             break 3;
                         };
                     }
                     break;
                // 一番左の行に数字が入っているかを確認
                 case 3:
                     foreach ($dungeonArr as $valArr) {
                         if(is_int($valArr[0]) || $valArr[0] === "S"){
                             echo "YES".PHP_EOL;
                             $NoFlg = false;                      
                             break 3;
                         }else{
                             // 上下左右に数字がない場合は、flgをfalseに切り替え
                             $NoFlg = false;                             
                         }
                     }
                     break;
             }
        }else{
            echo "NO".PHP_EOL;       
        }
    }

