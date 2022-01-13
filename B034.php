<?php
    // 自分の得意な言語で
    // Let's チャレンジ！
    [$x,$y] = array_map('intval', explode(" ", trim(fgets(STDIN))));
    $roboInfo["position"] = array("currentDirection"=>"F","x"=>$x,"y"=>$y);
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
    
    var_dump($positionArray);
    
    function roboMove($roboInfo, $recordArray){
        
        foreach ($recordArray as $record) {
            
            if($record["order"]=="t"){
                roboDirection($record["direction"],$roboInfo["position"]["currentDirection"]);
            }elseif($record["order"]=="m"){
                switch($record["direction"]){
                    case "R":
                        if($roboInfo["position"]["currentDirection"]=="R" | $roboInfo["position"]["currentDirection"]=="L"){
                            
                        }
                    case "L":
                        
                        break;
                    case "B":
                    case "F":
                        
                        break;                
                }
            }
            
        }    
    }
    
    function roboDirection($e_1,$currentDirection,$positionArray){
        $i = array_search($currentDirection,$positionArray);
        switch($e_1){
            case "R":
                if($i == 3){
                    $roboInfo["position"]["currentDirection"]  = $positionArray[0];
                }else{
                    $roboInfo["position"]["currentDirection"]  = $positionArray[$i + 1];
                }
                $roboInfo["m"][0] = $roboInfo["m"][1];
                $roboInfo["m"][1] = $roboInfo["m"][2];
                $roboInfo["m"][2] = $roboInfo["m"][3];
                $roboInfo["m"][3] = $roboInfo["m"][0];
                break;
            case "L":
                if($i == 0){
                    $roboInfo["position"]["currentDirection"]  = $positionArray[3];
                }else{
                    $roboInfo["position"]["currentDirection"]  = $positionArray[$i - 1];
                }                
                $roboInfo["m"][0] = $roboInfo["m"][3];
                $roboInfo["m"][1] = $roboInfo["m"][0];
                $roboInfo["m"][2] = $roboInfo["m"][1];
                $roboInfo["m"][3] = $roboInfo["m"][2];
                break;                
            case "B":
            case "F":
                if($i == 2){
                    $roboInfo["position"]["currentDirection"]  = $positionArray[0];
                }elseif($i == 3){
                    $roboInfo["position"]["currentDirection"]  = $positionArray[2];
                }else{
                    $roboInfo["position"]["currentDirection"]  = $positionArray[$i + 2];                    
                }
                $roboInfo["m"][0] = $roboInfo["m"][2];
                $roboInfo["m"][1] = $roboInfo["m"][3];
                $roboInfo["m"][2] = $roboInfo["m"][0];
                $roboInfo["m"][3] = $roboInfo["m"][1];
                break;
        }
    }
?>