<?php
    /*　回答方針 
    * (1) １列目1行目 - １列目2行目,２列目1行目 - ２列目2行目 の絶対値を算出
    * (2) (1)の値から１列目と２列目（縦の値）を埋める
          a_{i, j} = a_{i - 1, j} + (a_{2, j} - a_{1, j})
    * (3) (2)の結果から、各行の値を埋める
    *     a_{i, j} = a_{i, j - 1} + (a_{i, 2} - a_{i, 1})
    * (4) (3)を表示
    */
    
    // (1) １列目1行目 - １列目2行目,２列目1行目 - ２列目2行目 の絶対値を算出
    [$H,$W] = explode(" ", trim(fgets(STDIN)));
    $cellsArr = [];
    
    for ($i = 0; $i < 2; $i++) {
        $rowArr = array_map('intval', explode(" ", trim(fgets(STDIN))));
        array_push($cellsArr,$rowArr);
    }
    
    $absColArr[0] = abs($cellsArr[0][0] - $cellsArr[1][0]);
    $absColArr[1] = abs($cellsArr[0][1] - $cellsArr[1][1]);
    
    // $absRowArr[0] = abs($cellsArr[0][0] - $cellsArr[0][1]);
    // $absRowArr[1] = abs($cellsArr[1][0] - $cellsArr[1][1]);

    // (2) (1)の値から１列目と２列目（縦の値）を埋める
    for ($i_col = 2; $i_col < $H; $i_col++) {
        
        for ($i_row = 0; $i_row < 2; $i_row++) {
            
            $upCell = $cellsArr[$i_col - 2][$i_row];
            $pointCell = $cellsArr[$i_col - 1][$i_row];
            // echo $i_col."行目".$i_row."列目の"."upCellは".$upCell." pointCellは".$pointCell.PHP_EOL;
            if($upCell < $pointCell){
                $cellsArr[$i_col][$i_row] = $pointCell + $absColArr[$i_row];
                // echo $i_col."行目".$i_row."列目の値は絶対値".$absColArr[$i_row]."をpointCell".$pointCell."から足す".PHP_EOL;
            }elseif($upCell > $pointCell){
                $cellsArr[$i_col][$i_row] = $pointCell - $absColArr[$i_row];
                // echo $i_col."行目".$i_row."列目の値は絶対値".$absColArr[$i_row]."をpointCell".$pointCell."から引く".PHP_EOL;
            }else{
                $cellsArr[$i_col][$i_row] = $pointCell;
            }
        }
    }
    
    // (3) (2)の結果から、各行の値を埋める
    for ($i_col = 0; $i_col < $H; $i_col++) {
        
        for ($i_row = 2; $i_row < $W; $i_row++) {
            $leftCell = $cellsArr[$i_col][$i_row - 2];
            $pointCell = $cellsArr[$i_col][$i_row - 1];
            $absRow = abs($leftCell - $pointCell);
            if($leftCell < $pointCell){
                $cellsArr[$i_col][$i_row] = $pointCell + $absRow;
            }elseif($leftCell > $pointCell){
                $cellsArr[$i_col][$i_row] = $pointCell - $absRow;
            }else{
                $cellsArr[$i_col][$i_row] = $pointCell;
            }
        }
    }
        
    // (4) (3)を表示
    foreach ($cellsArr as $i_col => $rowsArr) {
        echo implode(" ",$rowsArr).PHP_EOL;
    }

?>