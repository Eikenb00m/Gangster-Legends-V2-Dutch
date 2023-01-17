<?php

    /**
    * This module allows users to vote for your site on the GL Directory
    *
    * @package GL Directory
    * @author Chris Day
    * @version 1.0.0
    */

    new hook("actionMenu", function ($user) {
        if ($user) return array(
            "url" => "?page=glDirectory", 
            "text" => "Stem voor " . _setting("game_name"), 
            "sort" => 1000
        );
    });

    new hook("adminWidget-alerts", function ($user) {
        global $db, $page;
        $key = _setting("voteKey1");
        if (!$key) return array( 
            "type" => "info", 
            "text" => 'Om je game aan te melden in de Gangster Legends Toplijsten kun je site <a href="https://directory.glscript.net/" target="_blank">hier</a> registreren. <br />
            Als je geregistreerd bent, kan je <a href="?page=admin&module=glDirectory">hier je instellingen aanpassen.</a><br />
            Wanneer je niet in de toplijst geregistreerd wilt zijn, kun je deze module uitschakelen en/of verwijderen.'
        );
        return false;
    });