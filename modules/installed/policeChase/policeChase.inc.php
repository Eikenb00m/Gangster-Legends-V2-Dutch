<?php

    class policeChase extends module {
        
        public $pageName = 'Politie achtervoling';
        public $allowedMethods = array('move'=>array('type'=>'get'));
        
        public function constructModule() {
            
            if (!$this->user->checkTimer('chase')) {
                $time = $this->user->getTimer('chase');
                $crimeError = array(
                    "timer" => "chase",
                    "text"=>'Je kan een nieuwe achtervolging proberen als je uitgerust bent. Dit duur nog:',
                    "time" =>$this->user->getTimer("chase")
                );
                $this->html .= $this->page->buildElement('timer', $crimeError);
            }

            $this->html .= $this->page->buildElement('policeChase', array());
            
        }
        
        public function method_move() {

            if (!$this->checkCSFRToken()) return;
            
            if ($this->user->checkTimer('chase')) {
                
                $rand = mt_rand(1, 4);
                
                if ($rand == 1) {
                
                    $winnings = mt_rand(150, 850) * $this->user->info->US_rank;
                    
                    $u = $this->db->prepare("
                        UPDATE 
                            userStats 
                        SET 
                            US_money = US_money + $winnings, 
                            US_exp = US_exp + 3 
                        WHERE 
                            US_id = ".$this->user->id);
                    $u->execute();
                    
                    $this->user->updateTimer('chase', 300, true);
                    
                    $this->alerts[] = $this->page->buildElement('success', array("text"=>'Het is gelukt, je hebt het volgend verdient: ' . $this->money($winnings).'!'));

                    $actionHook = new hook("userAction");
                    $action = array(
                        "user" => $this->user->id, 
                        "module" => "chase", 
                        "id" => 0, 
                        "success" => true, 
                        "reward" => $winnings
                    );
                    $actionHook->run($action);
                    
                } else if ($rand == 3) {
                                    
                    $this->user->updateTimer('jail', 150, true);
                    $this->user->updateTimer('chase', 300, true);
                    
                    $this->alerts[] = $this->page->buildElement('error', array("text"=>'Je bent gecrasht en opgepakt!'));

                    $actionHook = new hook("userAction");
                    $action = array(
                        "user" => $this->user->id, 
                        "module" => "chase", 
                        "id" => 0, 
                        "success" => false, 
                        "reward" => 0
                    );
                    $actionHook->run($action);
                    
                } else {
                    
                    $this->alerts[] = $this->page->buildElement('info', array("text"=>'Je bent nog bezig met je achtervolging! Welke kant op?'));
                
                }
                
            }
            
        }
        
    }

