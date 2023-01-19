<?php

    class usersTemplate extends template {

        public $validateAccount = '

            <div class="panel panel-default">
                <div class="panel-heading">Account Activeren</div>
                <div class="panel-body">
                    <div class="text-center">
                        <p class="text-center">
                            Voor dat je kan spelen moet je een geactiveerd account hebben. We hebben je een email gestuurd met de activatie code. Deze kan in de spambox/ongewenst zijn gekomen.    
                        </p>
                        <form method="post" action="?page=users">
                            <input type="text" name="code" class="form-control activation-code" value="{code}" /> 
                            <button type="submit" class="btn btn-default">
                                Activeer
                            </button>
                        </form>
                        <p>
                            <a href="?page=users&action=resend">Stuur een nieuwe activatie code</a>
                        </p>
                    </div>
                </div>
            </div>
        ';

        public $userHolder = '
        {#each users}
        <div class="user-holder">
            <p>{name} ({cooldown}) <span class="commit"><a href="?page=users&action=commit&user={id}">Verbind</a></span></p>
            <div class="user-perc">
                <div class="perc" style="width:{percent}%;"></div>
            </div>
        </div>
        {/each}
        {#unless users}
            <div class="text-center"><em>Er zijn geen gebruikers</em></div>
        {/unless}';

        public $userList = '

            <form method="post" action="?page=admin&module=users&action=view">

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="pull-left">Gebruikersnaam, ID of Email</label>
                            <input type="text" class="form-control" name="user" value="{user}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="pull-left col-md-12">&nbsp;</label>
                        <button class="btn btn-default" type="submit">
                           Zoek gebruikers
                        </button>
                    </div>
                </div>

            </form>

            <hr />
            <table class="table table-condensed table-responsive table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="50px">ID</th>
                        <th>User</th>
                        <th width="150px">Ronde</th>
                        <th width="100px">Opties</th>
                    </tr>
                </thead>
                <tbody>
                    {#each users}
                        <tr>
                            <td>{id}</td>
                            <td>{name}</td>
                            <td>
                                {#if round}
                                    {round}
                                {else}
                                    <strong>Unknown</strong>
                                {/if}
                            </td>
                            <td>
                                [<a href="?page=admin&module=users&action=edit&id={id}">Bewerk</a>] 
                                [<a href="?page=admin&module=users&action=delete&id={id}">Verwijder</a>]
                            </td>
                        </tr>
                    {/each}
                </tbody>
            </table>
        ';

        public $userDelete = '
            <form method="post" action="?page=admin&module=users&action=delete&id={id}&commit=1">
                <div class="text-center">
                    <p> Weet je zeker dat je deze gebruiker wilt verwijderen?</p>

                    <p><em>"{name}"</em></p>

                    <button class="btn btn-danger" name="submit" type="submit" value="1">Ja verwijder deze gebruiker!</button>

                </div>
            </form>
        
        ';
        public $userForm = '
            <form method="post" action="?page=admin&module=users&action={editType}&id={id}">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="pull-left">Gebruikersnaam</label>
                            <input type="text" class="form-control" name="name" value="{name}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="pull-left">User Status</label>
                            <select class="form-control" name="userStatus" data-value="{userStatus}">
                                <option {#if isDead}selected{/if} value="0">Dood</option>
                                <option {#if isValidated}selected{/if} value="1">Levend</option>
                                <option {#if isAwaitingValidation}selected{/if} value="2">Wacht op activatie</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="pull-left">Gebruikers level</label>
                            <select class="form-control" name="userLevel" data-value="{userLevel}">
                                {#each userRoles}
                                    <option value="{id}">{name}</option>
                                {/each}
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="pull-left">Email</label>
                            <input type="text" class="form-control" name="email" value="{email}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="pull-left">Contant</label>
                            <input type="number" class="form-control" name="money" value="{money}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="pull-left">Bank</label>
                            <input type="number" class="form-control" name="bank" value="{bank}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="pull-left">EXP</label>
                            <input type="number" class="form-control" name="exp" value="{exp}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="pull-left">Punten</label>
                            <input type="number" class="form-control" name="points" value="{points}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="pull-left">Kogels</label>
                            <input type="text" class="form-control" name="bullets" value="{bullets}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="pull-left">Profiel afbeelding</label>
                            <input type="text" class="form-control" name="pic" value="{pic}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="pull-left">Bio</label>
                    <textarea rows="8" class="form-control" name="bio">{bio}</textarea>
                </div>
                <div class="text-right">
                    <button class="btn btn-default" name="submit" type="submit" value="1">Opslaan</button>
                </div>
            </form>
        ';
    }
