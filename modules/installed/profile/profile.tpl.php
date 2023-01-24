<?php

    class profileTemplate extends template {
        
        public $online = "<strong class=\"text-success\">Online</strong>";
        public $offline = "<strong class=\"text-danger\">Offline</strong>";
        public $AFK = "<strong class=\"text-warning\">AFK</strong>";

        public $userSearch = '

            <div class="panel panel-default">
                <div class="panel-heading">Zoek speler</div>
                <div class="panel-body">
                    <form method="post" action="#">
                        <input type="text" name="user" class="form-control form-control-inline" placeholder="Gebruikersnaam" />
                        <button class="btn btn-primary">Zoek</button>
                    </form>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Resultaten</div>
                <div class="panel-body">
                    {#unless results}
                        <em> Geen spelers gevonden </em>
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

        public $editPassword = '


            <div class="panel panel-default">
                <div class="panel-heading">Wijzig wachtwoord</div>
                <div class="panel-body">

                    <ul class="nav nav-tabs nav-justified">
                        <li><a href="?page=profile&action=edit">Profiel</a></li>
                        <li class="active"><a href="?page=profile&action=password">Wijzig wachtwoord</a></li>
                    </ul>

                    <form action="#" method="post">
                        <div class="row">
                            <div class="col-md-3 text-right">
                                <strong>Oud wachtwoord</strong>
                            </div>
                            <div class="col-md-9">
                                <input type="password" name="old" class="form-control" value="" placeholder="******" />
                            </div>
                        </div><br />
                        <div class="row">
                            <div class="col-md-3 text-right">
                                <strong>Nieuw wachtwoord</strong>
                            </div>
                            <div class="col-md-9">
                                <input type="password" name="new" class="form-control" value="" placeholder="******" />
                            </div>
                        </div><br />
                        <div class="row">
                            <div class="col-md-3 text-right">
                                <strong>Bevestig nieuw wachtwoord</strong>
                            </div>
                            <div class="col-md-9">
                                <input type="password" name="confirm" class="form-control" value="" placeholder="******" />
                            </div>
                        </div><br />
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" name="submit" value="true" class="btn btn-default">Opslaan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            ';

        public $editProfile = '

            <div class="panel panel-default">
                <div class="panel-heading">Bewerk profiel</div>
                <div class="panel-body">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="active"><a href="?page=profile&action=edit">Profiel</a></li>
                        <li><a href="?page=profile&action=password">Wijzig wachtwoord</a></li>
                    </ul>
                    <form action="#" method="post">
                        <div class="row">
                            <div class="col-md-3 text-right">
                                <strong>Afbeelding</strong>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="pic" class="form-control" value="{picture}" placeholder="e.g. http://www.someurl.com/picture.png" />
                            </div>
                        </div><br />
                        <div class="row">
                            <div class="col-md-3 text-right">
                                <strong>Omschrijving</strong>
                            </div>
                            <div class="col-md-9">
                                <textarea rows="15" name="bio" class="form-control" placeholder="Een kleine omschrijving van jou....">{bio}</textarea>
                            </div>
                        </div><br />
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" name="submit" value="true" class="btn btn-default">Opslaan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            ';
        
        public $profile = '

            <div class="panel panel-default user-profile">
                <div class="panel-heading">Links</div>
                <div class="panel-body">
                    <ul class="nav nav-pills">
                        {#each profileLinks}
                            {#if url}<a class="btn btn-xs btn-default" href="{url}">{text}</a> &nbsp;{/if}
                        {/each}
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 col-lg-9">
                    <div class="panel panel-default">
                        <div class="panel-heading">{user.name}</div>
                            <div class="panel-body">

                            <ul class="list-group text-left profile-user-stats">
                                <li class="list-group-item">
                                    <strong>Gebruikersnaam</strong>
                                    <span class="pull-right">
                                        {>userName}
                                        <sup><{status}></sup>
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Laast actief</strong>
                                    <span class="pull-right">{_ago laston} geleden</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Status</strong>
                                    <span class="pull-right">
                                        {#if dead}
                                            <strong style="color: #900;">DOOD</strong> <{killedBy}>
                                        {/if}
                                        {#unless dead}
                                            <strong style="color: #090;">Levend</strong>
                                        {/unless}
                                    </span>
                                </li>
                                {#if showRole}
                                    <li class="list-group-item">
                                        <strong>Rol</strong>
                                        <span class="pull-right">
                                            {role}
                                        </span>
                                    </li>
                                {/if}
                                <li class="list-group-item">
                                    <strong>Rang</strong>
                                    <span class="pull-right">
                                        {rank}
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Gesteldheid</strong>
                                    <span class="pull-right">
                                        {moneyRank}
                                    </span>
                                </li>
                                {#each profileStats}
                                    <li class="list-group-item">
                                        <strong>{text}</strong>
                                        <span class="pull-right">
                                            <{stat}>
                                        </span>
                                    </li>
                                {/each}
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">Profiel afbeelding</div>

                        <div class="panel-body profile-pic">
                            <img src="{picture}" style="max-height: 250px" class="img-responsive" alt="{user.name}\'s Profile" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Persoonlijke omschrijving</div>
                <div class="panel-body">
                    {#if bio}
                        [{bio}]
                    {/if}
                    {#unless bio}
                        <em><small>Deze gebruiker heeft nog geen persoonlijke omschrijving</small></em>
                    {/unless}
                </div>
            </div>
        ';
        
    }


