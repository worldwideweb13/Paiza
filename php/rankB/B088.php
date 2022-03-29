<?php
    /*　回答方針 
    * (1) H,Wを変数化,s_Hを行毎に配列化(massArrs), ロボの初期値を配列化(RoboArr)
    * (2) RoboArrを引数にロボが進行した結果(RoboArr)をかえす関数実行
    *  (2-1) 進行方向が↑の時: 
                進行方向の配列が"#"の時: 1.進行方向を→に 2.ダメなら←に 3.ダメなら現在地を取得. 
                進行方向の配列が"."の時: 進行方向を引数に関数実行
    *  (2-1) 進行方向が→の時: x＋=1
                進行方向の配列が"#"の時: 1.進行方向を↓に 2.ダメなら↑に 3.ダメなら停止して現在地を取得. 
                進行方向の配列が"."の時: 進行方向を引数に関数実行 
    *  (2-1) 進行方向が↓の時: y＋=1
                進行方向の配列が"#"の時: 進行方向を←に ダメなら→に ダメなら停止して現在地を取得. 
                進行方向の配列が"."の時: 進行方向を引数に関数実行   
    *  (2-1) 進行方向が←の時: y-=1
                進行方向の配列が"#"の時: 進行方向を←に ダメなら→に ダメなら停止して現在地を取得. 
                進行方向の配列が"."の時: 進行方向を引数に関数実行    
    *  (3) RoboArrを画面に表示.
    */
    
    [$H,$W] = array_map('intval', explode(" ", trim(fgets(STDIN))));
    
    $robot = new RoboAct($H);
    
    // (2) RoboArrを引数にロボが進行した結果(RoboArr)をかえす関数実行
    do {
        // $robot->setRoboDirection();
    }while($robot->RoboFlg !== false);
    
    
    class RoboAct {
        public $RoboFlg = true;
        private $massArrs = array();
        private $roboLocation = ["x" => 0, "y" => 0, "direcion" => "↑"];
        
        public function __construct($H){
            for ($i = 0; $i < $H; $i++) {
                $this->massArrs[$i] = str_split(trim(fgets(STDIN)));
            }
        }
        
        private function setMassArrs(){
            $x = $this->roboLocation["x"];
            $y = $this->roboLocation["y"];
            $this->massArrs["y"]["x"] = "#";
        }
        
        private function setRoboLocation(){
            $location = $this->roboLocation["direction"];
            switch ($location) {
                case "↑":
                    $this->roboLocation["y"] -= 1;
                    break;
                case "→":
                    $this->roboLocation["x"] += 1;
                    break;
                case "↓":
                    $this->roboLocation["y"] += 1;
                    break;
                case "←":
                    $this->roboLocation["y"] -= 1;
                    break;
            }
        }
        
        private function searchRoboDireciton(){
            $location = $this->roboLocation["direction"];
            $x = $this->roboLocation["x"];
            $y = $this->roboLocation["y"];
            
            switch ($location) {
                case '↑':
                    if($this->massArrs[$x][$y - 1] === "#"){
                        
                    }elseif($this->massArrs[$x][$y - 1] === "."){
                        $this->setRoboLocation();
                    }
                    break;
                
                default:
                    // code...
                    break;
            }
        }
        
    }
    
?>