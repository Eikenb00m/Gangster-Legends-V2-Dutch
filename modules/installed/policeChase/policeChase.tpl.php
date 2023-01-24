<?php

    class policeChaseTemplate extends template {
    
        public $policeChase = '

            <div class="alert alert-warning">
                De Poltie heeft opgemerkt dat je in een gestolen auto rijdt, beter schudt je ze af!
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Welke kant wil je op?</div>
                <div class="panel-body">
                    <form method="post" action="?page=policeChase&action=move">
                        <input type="hidden" name="_CSFR" value="{_CSFRToken}" />
                        <div style="text-align:center;">
                            <input type="submit" class="button-fixed-width btn btn-default" value="Rechtdoor" />
                            <br />
                            <input type="submit" class="button-fixed-width btn btn-default" value="Links" />
                            <span class="button-fixed-width move-icon">
                                <i class="glyphicon glyphicon-fullscreen"></i>
                            </span>
                            <input type="submit" class="button-fixed-width btn btn-default" value="Rechts" />
                            <br />
                            <input type="submit" class="button-fixed-width btn btn-default" value="Omdraaien" /></a></p>
                        </div>
                    </form>
                </div>
            </div>
        ';
        
    }

