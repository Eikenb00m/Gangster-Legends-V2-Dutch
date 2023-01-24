<?php

    class propertyManagement extends module {
        
        public $allowedMethods = array(
            "module" => array( "type" => "GET" ),
            "code" => array( "type" => "GET" ),
            "transfer" => array( "type" => "POST" ),
            "cost" => array( "type" => "POST" )
        );
        
        public $pageName = '';
        
        public function constructModule() {
            if (!isset($this->methodData->module)) {
                return $this->html .= $this->page->buildElement("error", array(
                    "text" => "Welke bezitting wil je beheren?"
                ));
            }

            $this->property = new Property($this->user, $this->methodData->module);

            $info = $this->property->getOwnership();

            if ($info["user"]["id"] != $this->user->id) {
                return $this->html .= $this->page->buildElement("error", array(
                    "text" => "Je bent helemaal niet de eigenaar van deze bezitting!"
                ));
            }

            $this->html .= $this->page->buildElement("propertyManagement", $info);
        }

        public function method_reset() {
            $this->property = new Property($this->user, $this->methodData->module);
            $info = $this->property->getOwnership();
            if ($info["user"]["id"] == $this->user->id) {
                $this->property->updateProfit(0 - $info["_profit"]);

                $this->alerts[] = $this->page->buildElement("success", array(
                    "text" => "Winst / Verlies gereset naar 0"
                ));
            }
        }

        public function method_dropDo() {

            if ($this->methodData->code != $_SESSION["DROP_CODE"]) {
                return $this->error("Je hebt geen toegang om dit te doen!");
            }

            $this->property = new Property($this->user, $this->methodData->module);
            $info = $this->property->getOwnership();

            if ($info["user"]["id"] == $this->user->id) {

                $this->db->delete(
                    "DELETE FROM properties WHERE PR_location = :location AND PR_module = :module AND PR_user = :user", 
                    array(
                        ":location" => $this->user->info->US_location, 
                        ":module" => $this->methodData->module, 
                        ":user" => $this->user->id
                    )
                );
     
                $actionHook = new hook("userAction");
                $action = array(
                    "user" => $this->user->id, 
                    "module" => "property.drop", 
                    "id" => $this->user->info->US_location, 
                    "success" => true, 
                    "reward" => $this->methodData->module
                );
                $actionHook->run($action);

                return $this->error("Eigendom van de hand gedaan.", "success");
            }

        }


        public function method_drop() {

            $_SESSION["DROP_CODE"] = mt_rand(100000, 999999);

            $this->html .= $this->page->buildElement("dropProperty", array(
                "code" => $_SESSION["DROP_CODE"], 
                "module" => $this->methodData->module
            ));
        }

        public function method_cost() {

            if (!isset($this->methodData->cost)) {
                return $this->html .= $this->page->buildElement("error", array(
                    "text" => "Geef nieuwe kosten of maximale inzet in!"
                ));
            }
            
            if ($this->methodData->cost < 100) {
                return $this->html .= $this->page->buildElement("error", array(
                    "text" => "De kosten of minimale inzet mogen niet lager zijn als &euro;100,-"
                ));
            }

            $this->property = new Property($this->user, $this->methodData->module);
            $info = $this->property->getOwnership();
            if ($info["user"]["id"] == $this->user->id) {
                $cost = $this->methodData->cost;
                $this->property->setCost($cost);
                $this->alerts[] = $this->page->buildElement("success", array(
                    "text" => "Kosten of maximale inzet bijgewerkt naar " . $this->money($cost)
                ));
            }
        }

        public function method_transfer() {

            if (!isset($this->methodData->transfer)) {
                return $this->alerts[] = $this->page->buildElement("error", array(
                    "text" => "Voer een speler in om het bezit aan over te dragen"
                ));
            }

            $user = new User(null, $this->methodData->transfer);

            if (!isset($user->info->US_id)) {
                return $this->alerts[] = $this->page->buildElement("error", array(
                    "text" => "Deze speler bestaat niet"
                ));
            }

            if ($user->info->U_status == 0) {
                return $this->alerts[] = $this->page->buildElement("error", array(
                    "text" => "Deze speler is dood"
                ));
            }

            $this->property = new Property($this->user, $this->methodData->module);
            $info = $this->property->getOwnership();

            if ($info["user"]["id"] == $this->user->id) {
                $this->property->transfer($user->info->US_id);
     
                $actionHook = new hook("userAction");
                $action = array(
                    "user" => $this->user->id, 
                    "module" => "property.transfer", 
                    "id" => $user->info->US_id, 
                    "success" => true, 
                    "reward" => $this->methodData->module
                );
                $actionHook->run($action);

                $this->alerts[] = $this->page->buildElement("success", array(
                    "text" => "Bezitting doorgegeven aan " . $user->info->U_name
                ));
            }
        }
        
    }
