<?php
    // 自分の得意な言語で
    // Let's チャレンジ！
    [$x,$y] = array_map('intval', explode(" ", trim(fgets(STDIN))));
    $roboInfo["x"] = $x;
    $roboInfo["y"] = $y;
    $roboInfo["currentDirection"] = "F";
    [$F,$R,$B,$L] = array_map('intval', explode(" ", trim(fgets(STDIN))));
    $roboInfo["m"] =  array($F,$R,$B,$L);
    $positionArray = array("F","R","B","L");
    //recordArray...[[ロボットの移動OR転換, 方向（上、右、後、左）]...]
    $recordArray = [];
    // N...ロボットの移動回数
    $N = (int)trim(fgets(STDIN));
    for($i=0; $i < $N; $i++ ){
        [$e_1,$c_1] = explode(" ", trim(fgets(STDIN)));
        $recordArray [$i]= array("order" => $e_1,"direction" => $c_1);
    }
    
    // var_dump($recordArray);
    // exit; OK!
    roboMove($recordArray, $positionArray);
    
    echo $roboInfo["x"]." ".$roboInfo["y"];

    function roboMove($recordArray, $positionArray){

        foreach ($recordArray as $record) {
            // var_dump($GLOBALS["roboInfo"]["x"].",".$GLOBALS["roboInfo"]["y"]);
            if($record["order"]=="t"){
                roboDirection($record["direction"],$positionArray);
                // var_dump($GLOBALS["roboInfo"]);
                // exit; OK!                  
            }elseif($record["order"]=="m"){
                switch($GLOBALS["roboInfo"]["currentDirection"]){
                    case "F":
                            // var_dump($GLOBALS["roboInfo"]);
                            // exit; OK! 
                        if($record["direction"]=="F"){
                            $GLOBALS["roboInfo"]["y"] += $GLOBALS["roboInfo"]["m"][0];
                            // var_dump($GLOBALS["roboInfo"]);
                            // exit; OK!                    
                        }elseif($record["direction"]=="R"){
                            $GLOBALS["roboInfo"]["x"] += $GLOBALS["roboInfo"]["m"][1];
                        }elseif($record["direction"]=="B"){
                            $GLOBALS["roboInfo"]["y"] -= $GLOBALS["roboInfo"]["m"][2];
                        }elseif($record["direction"]=="L"){
                            $GLOBALS["roboInfo"]["x"] -= $GLOBALS["roboInfo"]["m"][3];
                        }
                        // var_dump($GLOBALS["roboInfo"]);
                        // exit; OK!
                        break;
                    case "R":
                        if($record["direction"]=="F"){
                            // var_dump($GLOBALS["roboInfo"]);
                            $GLOBALS["roboInfo"]["x"] += $GLOBALS["roboInfo"]["m"][0];
                            // var_dump($GLOBALS["roboInfo"]);
                            // exit; ok!
                        }elseif($record["direction"]=="R"){
                            $GLOBALS["roboInfo"]["y"] -= $GLOBALS["roboInfo"]["m"][1];
                        }elseif($record["direction"]=="B"){
                            $GLOBALS["roboInfo"]["x"] -= $GLOBALS["roboInfo"]["m"][2];
                        }elseif($record["direction"]=="L"){
                            $GLOBALS["roboInfo"]["y"] += $GLOBALS["roboInfo"]["m"][3];
                        }
                        break;
                    case "B":
                        if($record["direction"]=="F"){
                            $GLOBALS["roboInfo"]["y"] -= $GLOBALS["roboInfo"]["m"][0];
                        }elseif($record["direction"]=="R"){
                            $GLOBALS["roboInfo"]["x"] -= $GLOBALS["roboInfo"]["m"][1];
                        }elseif($record["direction"]=="B"){
                            $GLOBALS["roboInfo"]["y"] += $GLOBALS["roboInfo"]["m"][2];
                        }elseif($record["direction"]=="L"){
                            $GLOBALS["roboInfo"]["x"] += $GLOBALS["roboInfo"]["m"][3];
                        }
                        break;
                    case "L":
                        if($record["direction"]=="F"){
                            $GLOBALS["roboInfo"]["x"] -= $GLOBALS["roboInfo"]["m"][0];
                        }elseif($record["direction"]=="R"){
                            $GLOBALS["roboInfo"]["y"] += $GLOBALS["roboInfo"]["m"][1];
                        }elseif($record["direction"]=="B"){
                            $GLOBALS["roboInfo"]["x"] += $GLOBALS["roboInfo"]["m"][2];
                        }elseif($record["direction"]=="L"){
                            $GLOBALS["roboInfo"]["y"] -= $GLOBALS["roboInfo"]["m"][3];
                        }
                        break;                        
                }
            }
            
        }    
    }
    
    function roboDirection($e_1,$positionArray){
        $i = array_search($GLOBALS["roboInfo"]["currentDirection"],$positionArray);
        // var_dump($GLOBALS["roboInfo"]["currentDirection"]);
        // var_dump($positionArray);
        // var_dump($i);
        // exit; OK!
        switch($e_1){
            case "R":
                if($i == 3){
                    $GLOBALS["roboInfo"]["currentDirection"]  = $positionArray[0];
                }else{
                    $GLOBALS["roboInfo"]["currentDirection"]  = $positionArray[$i + 1];
                }
         
                break;
            case "L":
                if($i == 0){
                    $GLOBALS["roboInfo"]["currentDirection"]  = $positionArray[3];
                }else{
                    $GLOBALS["roboInfo"]["currentDirection"]  = $positionArray[$i - 1];
                }                
                break;                
            case "B":
                if($i == 2){
                    $GLOBALS["roboInfo"]["currentDirection"]  = $positionArray[0];
                }elseif($i == 3){
                    $GLOBALS["roboInfo"]["currentDirection"]  = $positionArray[2];
                }else{
                    $GLOBALS["roboInfo"]["currentDirection"]  = $positionArray[$i + 2];                    
                }
                break;
        }
    }
?>