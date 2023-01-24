<?php
new Hook("alterModuleData", function ($data) { 
    return $data; 
  });
    new hook("locationMenu", function () {
        return array(
            "url" => "?page=blackmarket", 
            "text" => "Zwarte Markt", 
            "sort" => 100
        );
    });
