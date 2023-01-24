<?php

    class searchTemplate extends template {

        public $userSearch = '

            <div class="panel panel-default">
                <div class="panel-heading">Zoek speler</div>
                <div class="panel-body">
                    <form method="post" action="#">
                        <input type="text" name="user" class="form-control form-control-inline" placeholder="Gebruikersnaam" />
                        <button class="btn btn-default">Zoek</button>
                    </form>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Resultaten</div>
                <div class="panel-body">
                    {#unless results}
                        <em> Geen gebruikers gevonden </em>
                    {/unless}
                    {#each results}
                        <div class="crime-holder"> 
                            <p> 
                                <span class="action"> 
                                    {>userName}
                                </span> 
                                <span class="cooldown"> {status} </span> 
                            </p> 
                        </div>
                    {/each}
                </div>
            </div>
        ';
        
    }

?>