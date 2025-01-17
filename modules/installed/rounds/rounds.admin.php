<?php

    class adminModule {

        private function getRounds($roundsID = "all") {
            if ($roundsID == "all") {
                $add = "";
            } else {
                $add = " WHERE R_id = :id";
            }
            
            $sql = "
                SELECT
                    R_id as 'id',  
                    R_name as 'name',  
                    R_start as 'start',  
                    R_end as 'end'
                FROM rounds" . $add . "
                ORDER BY R_name, R_end
            ";

            if ($roundsID == "all") {
                $data = $this->db->selectAll($sql);
                foreach ($data as $key => $val) {
	                $data[$key]["startDate"] = date("jS F Y H:i", $val["start"]);
	                $data[$key]["endDate"] = date("jS F Y H:i", $val["end"]);

	                $data[$key]["start"] = date("Y-m-d\TH:i:s", $val["start"]);
	                $data[$key]["end"] = date("Y-m-d\TH:i:s", $val["end"]);
                }
                return $data;
            } else {
                $data = $this->db->select($sql, array(
                    ":id" => $roundsID
                ));
                $data["start"] = date("Y-m-d\TH:i:s", $data["start"]);
                $data["end"] = date("Y-m-d\TH:i:s", $data["end"]);

                return $data;
            }
        }

        private function validateRounds($rounds) {
            $errors = array();

            if (strlen($rounds["name"]) < 1) {
                $errors[] = "De Ronde naam is te kort, dit moet minimaal 1 teken zijn!";
            }
            if (strtotime($rounds["end"]) < strtotime($rounds["start"])) {
                $errors[] = "De Start tijd van de ronde moet voor de eind tijd zijn!";
            }
            
            if (!intval($rounds["start"])) {
                $errors[] = "Geen tijden ingesteld!";
            }

            return $errors;
            
        }

        public function method_clear () {

        	if (isset($this->methodData->do)) {

        		$hook = new Hook("clearRound");
        		$hook->run();

        		$this->page->alert("Ronde data is verwijderd!", "warning");
        	} else {
        		$this->html .= $this->page->buildElement("clearData");
        	}


        }

        public function method_new () {

            $rounds = array();

            if (isset($this->methodData->submit)) {
                $rounds = (array) $this->methodData;
                $errors = $this->validateRounds($rounds);
                
                if (count($errors)) {
                    foreach ($errors as $error) {
                        $this->page->alert($error);
                    }
                } else {
                    $insert = $this->db->insert("
                        INSERT INTO rounds (R_name, R_start, R_end)  VALUES (:name, :start, :end);
                    ", array(
                        ":name" => $this->methodData->name,
                        ":start" => strtotime($this->methodData->start),
                        ":end" => strtotime($this->methodData->end)
                    ));

                    $this->page->alert("Ronde is gemaakt!", "success");

                }

            }

            $rounds["editType"] = "new";
            $this->html .= $this->page->buildElement("roundsForm", $rounds);
        }

        public function method_edit () {

            if (!isset($this->methodData->id)) {
                return $this->page->alert("Geen ronde id gevonden");
            }

            $rounds = $this->getRounds($this->methodData->id);

            if (isset($this->methodData->submit)) {
                $rounds = (array) $this->methodData;
                $errors = $this->validateRounds($rounds);

                if (count($errors)) {
                    foreach ($errors as $error) {
                        $this->page->alert($error);
                    }
                } else {
                    $update = $this->db->update("
                    	UPDATE rounds 
                    	SET R_name = :name, R_start = :start, R_end = :end 
                    	WHERE R_id = :id
                    ", array(
                        ":name" => $this->methodData->name, 
                        ":start" => strtotime($this->methodData->start), 
                        ":end" => strtotime($this->methodData->end), 
                        ":id" => $this->methodData->id
                    ));

                    $this->page->alert("Deze ronde is bijgewerkt!");

                }

            }

            $rounds["editType"] = "edit";
            $this->html .= $this->page->buildElement("roundsForm", $rounds);
        }

        public function method_delete () {

            if (!isset($this->methodData->id)) {
                return $this->page->alert("Geen ronde ID gevonden");
            }

            $rounds = $this->getRounds($this->methodData->id);

            if (!isset($rounds["id"])) {
                return $this->page->alert("Deze ronde bestaat niet!");
            }

            if (isset($this->methodData->commit)) {
                $delete = $this->db->delete("DELETE FROM rounds WHERE R_id = :id;", array(
                    ":id" => $this->methodData->id
                ));
                header("Location: ?page=admin&module=rounds");
            }


            $this->html .= $this->page->buildElement("roundsDelete", $rounds);
        }

        public function method_view () {
            
            $this->html .= $this->page->buildElement("roundsList", array(
                "rounds" => $this->getRounds()
            ));

        }

    }
