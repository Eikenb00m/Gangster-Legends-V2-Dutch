<?php

    class profile extends module {
            
        public $allowedMethods = array(
            'view'=>array('type'=>'get'),
            'user'=>array('type'=>'post'),
            'old'=>array('type'=>'post'),
            'new'=>array('type'=>'post'),
            'confirm'=>array('type'=>'post'),
            'bio'=>array('type'=>'post'),
            'pic'=>array('type'=>'post'), 
            'submit'=>array('type'=>'post')
        );
    
        public $pageName = '';
        
        public function constructModule() {
            
            if (isset($this->methodData->view) && $this->methodData->view != $this->user->id) {
                $user = $this->methodData->view;
                if (ctype_digit($user)) {
                    $profile = new user($user);
                } else {
                    $profile = new user(false, $user);
                }

                if (!isset($profile->info->US_id)) {
                    return $this->error("Deze gebruiker bestaat niet");
                }
                
                $this->pageName = 'Bekijken '.$profile->info->U_name.'\'s Profiel';
                $edit = false;
            } else {
                $profile = $this->user;
                $this->pageName = 'Mijn profiel';
                $edit = true;
            }


            $bio =  ((strlen($profile->info->US_bio)>0)?($profile->info->US_bio):false);
            
            // Make sure it is an image
            $pic = $profile->getProfilePicture();

            $killedBy = false;

            if ($profile->info->US_shotBy) {
                $killer = new User($profile->info->US_shotBy);
                if (isset($killer->info->U_id)) {
                    $killedBy = "Vermoord door " . $this->page->username($killer);
                }
            }

            $links = new Hook("profileLink");
            $stats = new Hook("profileStat");

            $this->html .= $this->page->buildElement('profile', array(
                "picture" => $pic,
                "user" => $profile->user, 
                "killedBy" => $killedBy,
                "moneyRank" => $profile->getMoneyRank()->MR_desc, 
                "rank" => $profile->getRank()->R_name, 
                "gangID" => $profile->getGang()["id"], 
                "gang" => $profile->getGang()["name"], 
                "dead" => $profile->info->U_status == 0, 
                "laston" => $profile->getTimer("laston"), 
                "status" => $profile->getStatus(), 
                "bio" => $bio, 
                "role" => $profile->info->UR_desc,
                "showRole" => $profile->info->UR_id != 1,
                "edit" => $edit, 
                "profileLinks" => $links->run($profile), 
                "profileStats" => $stats->run($profile)
            ));
            
        }

        public function method_search() {

            $this->construct = false;

            $results = array();

            if (isset($this->methodData->user)) {

                if (strlen($this->methodData->user) < 3) {
                    $this->error("Voer minimaal 3 tekens in!");
                } else {
                    
                    $users = $this->db->selectAll("
                        SELECT * FROM users WHERE U_name LIKE :user
                    ", array(
                        ":user" => "%" . $this->methodData->user . "%"
                    ));

                    foreach ($users as $key => $value) {
                        $user = new User($value["U_id"]);
                        $results[] = array(
                            "user" => $user->user, 
                            "status" => $user->info->U_status == 0?"Dood":"Levend",
                        );
                    }

                }
            }
                
            $this->html .= $this->page->buildElement("userSearch", array(
                "results" => $results
            ));

        }
        
        public function method_password() {
            $this->construct = false;

            if (!empty($this->methodData->submit)) {

                if (strlen($this->methodData->new) < 6) {
                    $this->alerts[] = $this->page->buildElement("error", array(
                        "text" => "Het wachtwoord is te kort. Het wachtwoord moet minimaal uit 6 tekens bestaan!"
                    ));
                } else if ($this->methodData->new != $this->methodData->confirm) {
                    $this->alerts[] = $this->page->buildElement("error", array(
                        "text" => "Je wachtwoorden komen niet overeen"
                    ));
                } else {
                    $encrypt = $this->user->encrypt($this->user->info->U_id . $this->methodData->old);
                    if ($encrypt != $this->user->info->U_password) {
                        $this->alerts[] = $this->page->buildElement("error", array(
                            "text" => "Het ingevoerde wachtwoord klopt niet!"
                        ));
                    } else {
                        $new = $this->user->encrypt($this->user->info->U_id . $this->methodData->new);

                        $update = $this->db->prepare("
                            UPDATE users SET U_password = :password WHERE U_id = :id
                        ");
                        $update->bindParam(":password", $new);
                        $update->bindParam(":id", $this->user->info->US_id);
                        $update->execute();
                        $this->alerts[] = $this->page->buildElement("success", array(
                            "text" => "Je wachtwoord is bijgewerkt"
                        ));
                    }
                }
            }

            $this->html .= $this->page->buildElement("editPassword");
        }
        
        public function method_edit() {
            
            if (!empty($this->methodData->submit)) {
                $this->user->set("US_bio", $this->methodData->bio);
                $this->user->set("US_pic", $this->methodData->pic);
                $this->error('Profiel bijgewerkt, <a href="?page=profile">Bekijk</a>.', "success");
            }
            
            $this->construct = false;
            
            $this->pageName = 'Bewerkt profiel';
        
            $this->html .= $this->page->buildElement("editProfile", array(
                "bio" => $this->user->info->US_bio, 
                "picture" => $this->user->info->US_pic
            ));
            
        }
        
    }

