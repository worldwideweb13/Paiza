<?php
    /*　回答方針 
    * (1) 戻るボタン($historyIndex)を定義後、$nを取得して以下の処理をn回実行
    * (2-1) "go to"の場合、ページ名を表示して配列のhistoryIndex番目の値を上書き、$historyIndex++
    * (2-2) "use the back button"の時、以下の条件式を実行
    *  (2-2-1) $historyIndex-1が0の時、配列を初期化,0番目にblank pageを代入
    *  (2-2-2) それ以外の場合は$historyIndex-1の配列の値を画面に表示,$historyIndex--
    */
    
    // (1) 戻るボタン($historyIndex)を定義後、$nを取得して以下の処理をn回実行
    $n = (int)trim(fgets(STDIN));
    $historyArr = array();
    $historyIndex = 0;
    
    for ($i = 0; $i < $n; $i++) {
        $page = explode(" ", trim(fgets(STDIN)));
        [$history,$historyIndex] = searchPage($page,$historyArr,$historyIndex,$i);
        
        if (isset($history)) {
            if($history == "reset"){
                $historyArr = array();
                $historyArr[] = "blank page";
            }else{
                $historyArr[$historyIndex] = $history;
            }
        }
    }
    
    function searchPage($page,$historyArr,$historyIndex,$i){
        // (2-1) "go to"の場合、ページ名を表示して配列のhistoryIndex番目の値を上書き、$historyIndex++
        if ($page[0] === "go") {
            $history = implode(" ", array_slice($page,2));
            // 初回はindex番号を0にする
            if ($i != 0) $historyIndex++;
            echo $history.PHP_EOL;
            return [$history,$historyIndex];
        }else{
            //(2-2) "use the back button"の時、以下の条件式を実行            
            [$Flg,$historyIndex] = useBack($page,$historyArr,$historyIndex);
            return [$Flg, $historyIndex];
        }
    }
    
    function useBack($page,$historyArr,$historyIndex){
        $Flg = null;
        // (2-2-1) $historyIndex-1が0の時、配列を初期化,0番目にblank pageを代入
        // (2-2-2) それ以外の場合は$historyIndex-1の配列の値を画面に表示,$historyIndex--    
        $historyIndex--;
        if ($historyIndex === 0) $Flg = "reset";
        echo $historyArr[$historyIndex].PHP_EOL;
        return [$Flg, $historyIndex];
    }
    
?>