<?php 

    new hook("adminWidget-alerts", function ($user) {
        global $db, $page;
        $gameName = _setting("game_name");
       	if ($gameName == "Game Name") return array( 
            "type" => "info", 
            "text" => "De naam van het spel is niet ingesteld! Ga naar de <a href='?page=admin&module=themeManager'>thema manager</a>!"
        );
       	return false;
    });