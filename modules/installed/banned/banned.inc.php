<?php

    class banned extends module {
        
        public $allowedMethods = array();
        
        public $pageName = '';
        
        public function constructModule() {
            $this->html .= $this->page->buildElement("error", array("text" => "Dit account is verbannen!"));
        }
        
    }

