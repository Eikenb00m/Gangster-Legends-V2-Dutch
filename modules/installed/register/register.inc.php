<?php

    class register extends module {
        
        public $regError = "";

        public $allowedMethods = array(
            'ref'=>array('type'=>'get'),
            'password'=>array('type'=>'post'),
            'cpassword'=>array('type'=>'post'),
            'username'=>array('type'=>'post'),
            'email'=>array('type'=>'post')
        );
        
        public function constructModule() {
            
            global $regError;

            if(isset($this->user->loggedin)){
                $this->page->redirectTo($this->page->landingPage);
            }

            $settings = new settings();
            $this->page->addToTemplate("loginSuffix", $settings->loadSetting("registerSuffix"));
            $this->page->addToTemplate("loginPostfix", $settings->loadSetting("registerPostfix"));
            
            $ref = false;
            if (isset($this->methodData->ref)) {
                $ref = $this->methodData->ref;
            }
            
            $this->html .= $this->page->buildElement('registerForm', array(
                "text" => $this->regError, 
                "ref" => $ref
            ));
            
        }
        
        public function method_register() {

            //if (!$this->checkCSFRToken()) return;
            
            $this->regError = '';
            
            $user = @new user();
            $round = new Round();
            $settings = new settings();
            
            if(preg_match("/^[a-zA-Z0-9]+$/", $this->methodData->username) != 1) {
                $this->regError =  $this->page->buildElement('error', array(
                    "text" => 'Voer een geldige gebruikersnaam in!'
                )); 
            } else if (!filter_var($this->methodData->email, FILTER_VALIDATE_EMAIL)) {
                $this->regError =  $this->page->buildElement('error', array(
                    "text" => 'Voer een geldig mail adres in!'
                )); 
            } else if (strlen($this->methodData->username) < 3) {
                $this->regError =  $this->page->buildElement('error', array(
                    "text" => 'Je gebruikersnaam moet minimaal uit 3 tekens bestaan!'
                )); 
            } else if (
                !empty($this->methodData->password) && ($this->methodData->password == $this->methodData->cpassword)
            ) {

                $makeUser = $user->makeUser(
                    $this->methodData->username, 
                    $this->methodData->email, 
                    $this->methodData->password
                );
                
                if (!ctype_digit($makeUser)) {
                    $this->regError = $this->page->buildElement('error', array(
                        "text" => $makeUser
                    ));
                } else {

                    $actionHook = new hook("userAction");
                    $action = array(
                        "user" => $makeUser, 
                        "module" => "registreren", 
                        "id" => $makeUser, 
                        "success" => true, 
                        "reward" => 0
                    );
                    $actionHook->run($action);

                    $_SESSION["userID"] = $makeUser;

                    if ($round->currentRound) {
                        header("Location:?");
                        $this->regError =  $this->page->buildElement('success', array(
                            "text" => 'Je hebt succesvol een account geregistreerd, je kan nu inloggen.'
                        ));
                    } else {
                        $this->error("Je hebt je geregistreerd voor de volgende ronde!", "success");
                    }
                }
                
            } else if (isset($this->methodData->password)) {
                $this->regError =  $this->page->buildElement('error', array(
                    "text" => 'Je wachtwoorden komen niet overeen!'
                ));    
            }
            
        }
        
    }

