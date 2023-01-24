<?php

    class themeManagerTemplate extends template {

        public $themeOptions = '

            <form method="post" action="?page=admin&module=themeManager&action=options">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="pull-left">Spel naam</label>
                            <input type="text" class="form-control" name="game_name" value="{game_name}" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="pull-left">Spel email (mail vanwaar het systeem verzend)</label>
                            <input type="text" class="form-control" name="from_email" value="{from_email}" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="pull-left">Punten naam</label>
                            <input type="text" class="form-control" name="pointsName" value="{pointsName}" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="pull-left">Gang naam</label>
                            <input type="text" class="form-control" name="gangName" value="{gangName}" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="pull-left">Landings module (landings page)</label>
                            <select class="form-control" name="landingPage">
                                {#each modules}
                                    <option value="{id}" {#if selected}selected{/if}>
                                        {name}
                                    </option>
                                {/each}
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="pull-left">Spel Thema</label>
                            <select class="form-control" name="theme">
                                {#each themes}
                                    <option value="{id}" {#if selected}selected{/if}>
                                        {name}
                                    </option>
                                {/each}
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="pull-left">Admin Thema</label>
                            <select class="form-control" name="adminTheme">
                                {#each adminThemes}
                                    <option value="{id}" {#if selected}selected{/if}>
                                        {name}
                                    </option>
                                {/each}
                            </select>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button class="btn btn-default" name="submit" type="submit" value="1">Opslaan</button>
                </div>
            </form>
        ';

        public $themeHolder = '
        {#each themes}
        <div class="theme-holder">
            <p>{name} ({cooldown}) <span class="commit"><a href="?page=themes&action=commit&theme={id}">Vernieuw</a></span></p>
            <div class="theme-perc">
                <div class="perc" style="width:{percent}%;"></div>
            </div>
        </div>
        {/each}
        {#unless themes}
            <div class="text-center"><em>Er zijn geen themas</em></div>
        {/unless}';

        public $themeList = '


            <table class="table table-condensed table-responsive table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="200px">Naam</th>
                        <th>Description</th>
                        <th width="70px">Versie</th>
                        <th width="90px">Auteur</th>
                        <th width="60px">Opties</th>
                    </tr>
                </thead>
                <tbody>
                    {#each themes}
                        <tr>
                            <td>{name}</td>
                            <td>{description}</td>
                            <td>{version}</td>
                            <td><a href="{author.url}" target="_blank">{author.name}</a></td>
                            <td>
                                [<a href="?page=admin&module=themes&action=edit&themeName={id}">Bekijk</a>] 
                            </td>
                        </tr>
                    {/each}
                </tbody>
            </table>
        ';

        public $themeDelete = '
            <form method="post" action="?page=admin&module=themes&action=delete&id={id}&commit=1">
                <div class="text-center">
                    <p> Weet je zeker dat je dit thema wilt verwijderen?</p>

                    <p><em>"{name}"</em></p>

                    <button class="btn btn-danger" name="submit" type="submit" value="1">Ja verwijder dit thema!</button>
                </div>
            </form>
        
        ';
        public $themeForm = '
            <form method="post" action="?page=admin&module=themeManager&action=install" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="pull-left">Thema bestand (Zipped)</label>
                            <input type="file" class="form-control" name="file" />
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button class="btn btn-default" name="submitInstall" type="submit" value="1">Upload</button>
                </div>
            </form>
        ';
    }

