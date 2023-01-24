<?php

    new hook("accountMenu", function () {
        return array(
            "url" => "?page=profile", 
            "text" => "Mijn profiel", 
            "sort" => 900
        );
    });
    new hook("profileLink", function ($profile) {
    	global $user;
    	if ($user->id == $profile->info->U_id) {
	        return array(
	            "url" => "?page=profile&action=edit", 
	            "text" => "Bewerk profiel"
	        );
    	}
    });
