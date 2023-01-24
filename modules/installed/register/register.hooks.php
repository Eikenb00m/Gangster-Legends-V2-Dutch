<?php

	
    new hook("loginMenu", function () {
        return array(
            "url" => "?page=register", 
            "text" => "Registreer", 
            "sort" => 200
        );
    });