<?php
    /*
    // 行列の連想配列[[列:行]..]を以下の形式で出力
        #___
        #_#_
        ####
        _#__
    */

    foreach ($massArr as $massRow) {
        echo implode($massRow).PHP_EOL;
    }

?>