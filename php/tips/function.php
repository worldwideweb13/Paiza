<?php

/* 最小公倍数と最大公約数 */
// ユークリッド互助法により最大公約数を求めた後、最大公倍数を取得する
    function checkMinimum($A,$B){
        $A_ = $A;
        $result = (int)floor($B / $A);
        $remainder =  (int)floor($B % $A);
        
        while($remainder !== 0){
            $remainder_ = $remainder;
            // 前回割った数($A_)を前回の余り(remainer)で割る
            $result = (int)floor($A_ / $remainder);
            $remainder = (int)floor($A_ % $remainder);
            // 前々回の余りを$A_にセットする
            $A_ = $remainder_;
        }
        
        // 最大公倍数の求め方...$A * $B / 最大公約数($A_) 
        return ($A * $B) / $A_;
    }


