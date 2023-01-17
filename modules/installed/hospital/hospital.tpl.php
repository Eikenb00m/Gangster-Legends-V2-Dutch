<?php

    class hospitalTemplate extends template {

         public $options = '

            <form method="post" action="?page=admin&module=hospital&action=options">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="pull-left">Tijd tot 100% gezondheid (in seconden)</label>
                            <input type="number" class="form-control" name="hospitalTimeUntillFull" value="{hospitalTimeUntillFull}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="pull-left">Kosten voor 100% gezondheid (&euro;)</label>
                            <input type="number" class="form-control" name="hospitalmoneyUntillFull" value="{hospitalmoneyUntillFull}" />
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <button class="btn btn-default" name="submit" type="submit" value="1">Opslaan</button>
                </div>

            </form>
        ';

        public $hospital = '

            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">{location} ziekenhuis opname</div>
                        <div class="panel-body">

                            {#unless health}
                                Je bent volledig gezond!
                            {/unless}

                            {#if health}

                                <p>
                                    Je hebt momenteel {healthPerc}% gezondheid!
                                </p>
                                <p>
                                    De behandeling duurt {time} 
                                    {#if money}
                                        en kost {#money money}
                                    {/if}!
                                </p>
                                <p>
                                    <a href="?page=hospital&action=checkin" class="btn btn-default">
                                        Laat je behandelen
                                    </a>
                                </p>
                            {/if}

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">Patiënten</div>
                        <div class="panel-body">
                            <ul class="list-group text-left">
                                {#unless users} 
                                    <div class="text-center">
                                        <em>Er is niemand in het ziekenhuis</em>
                                    </div>
                                {/unless}
                                {#each users} 
                                    <li class="list-group-item"> 
                                        {>userName}
                                        <span data-remove-when-done="" data-timer-type="inline" data-timer="{time}" class="timer-active pull-right"></span>
                                    </li>
                                {/each}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        ';
        public $inHospital = '

            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">Patiënten</div>
                        <div class="panel-body">
                            <ul class="list-group text-left">
                                {#unless users} 
                                    <div class="text-center">
                                        <em>Er is niemand in het ziekenhuis</em>
                                    </div>
                                {/unless}
                                {#each users} 
                                    <li class="list-group-item"> 
                                        {>userName}
                                        <span data-remove-when-done="" data-timer-type="inline" data-timer="{time}" class="timer-active pull-right"></span>
                                    </li>
                                {/each}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        ';
        
    }

?>