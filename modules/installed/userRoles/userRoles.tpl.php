<?php

    class userRolesTemplate extends template {

        public $validateAccount = '
            <div class="text-center">
                <p class="text-center">
                    Voordat je kan spelen moet je account geactiveerd zijn! 
                </p>
                <form method="post" action="?page=users">
                    <input type="text" name="code" class="form-control activation-code" value="{code}" /> 
                    <button type="submit" class="btn btn-default">
                        Activate
                    </button>
                </form>
                <p>
                    <a href="?page=users&action=resend">Verstuur nieuwe activatie code</a>
                </p>
            </div>
        ';

        public $roleHolder = '
        {#each users}
        <div class="user-holder">
            <p>{name} ({cooldown}) <span class="commit"><a href="?page=userRoles&action=commit&user={id}">Verbind</a></span></p>
            <div class="user-perc">
                <div class="perc" style="width:{percent}%;"></div>
            </div>
        </div>
        {/each}
        {#unless users}
            <div class="text-center"><em>Er zijn geen gebruikers</em></div>
        {/unless}';

        public $roleList = '
            <table class="table table-condensed table-responsive table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="50px">ID</th>
                        <th>Role</th>
                        <th width="100px">Kleur</th>
                        <th width="100px">Opties</th>
                    </tr>
                </thead>
                <tbody>
                    {#each userRoles}
                        <tr>
                            <td>{id}</td>
                            <td>{name}</td>
                            <td>{color}</td>
                            <td>
                                [<a href="?page=admin&module=userRoles&action=edit&id={id}">Bewerk</a>] 
                                [<a href="?page=admin&module=userRoles&action=delete&id={id}">Verwijder</a>]
                            </td>
                        </tr>
                    {/each}
                </tbody>
            </table>
        ';

        public $roleDelete = '
            <form method="post" action="?page=admin&module=userRoles&action=delete&id={id}&commit=1">
                <div class="text-center">
                    <p> Weet je zeker dat je deze rol wilt verwijderen??</p>

                    <p><em>"{name}"</em></p>

                    <button class="btn btn-danger" name="submit" type="submit" value="1">
                        Ja, verwijder deze rol!
                    </button>

                </div>
            </form>
        
        ';

        public $roleForm = '
            <form method="post" action="?page=admin&module=userRoles&action={editType}&id={id}">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label class="pull-left">Naam</label>
                            <input type="text" class="form-control" name="name" value="{name}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="pull-left">
                                Kleur <br />
                                <input type="color" name="color" value="{color}">
                            </label> 
                        </div>
                    </div>
                </div>

                <h3>Admin Modules</h3>
                <ul class="list-group">
                    {#each modules}
                        <li class="list-group-item col-md-4">
                            <input type="checkbox" name="access[]" value="{id}" {#if selected} checked {/if} /> {pageName}
                        </li>
                    {/each}
                </ul>
                <div class="clearfix"></div>

                <div class="text-right">
                    <button class="btn btn-default" name="submit" type="submit" value="1">
                        Opslaan
                    </button>
                </div>
            </form>
        ';
    }
