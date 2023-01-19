<?php

    class travelTemplate extends template {
    
        public $locationHolder = '

            <div class="panel panel-default">
                <div class="panel-heading">Reizen</div>
                <div class="panel-body">
                    {#each locations}
                    <div class="crime-holder">
                        <p>
                            <span class="action">
                                {location} 
                            </span>
                            <span class="cooldown">
                                ({cooldown})&nbsp;&nbsp;&nbsp;&nbsp;{#money cost} 
                            </span>
                            <span class="commit">
                                <a href="?page=travel&action=fly&location={id}">Reizen</a>
                            </span>
                            </p>
                    </div>
                    {/each}
                </div>
            </div>
        ';

        public $locationsHolder = '
        {#each locations}
        <div class="crime-holder">
            <p>
                <span class="action">
                    {name} 
                </span>

        </div>
        {/each}';
        

        public $locationsList = '
            <table class="table table-condensed table-striped table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>Locations</th>
                        <th width="120px">Kosten ($)</th>
                        <th width="120px">Kogels</th>
                        <th width="120px">Prijs per kogel (&euro;)</th>
                        <th width="120px">Reistijd (sec)</th>
                        <th width="100px">Opties</th>
                    </tr>
                </thead>
                <tbody>
                    {#each locations}
                        <tr>
                            <td>{name}</td>
                            <td>{#money cost}</td>
                            <td>{bullets}</td>
                            <td>&euro;{bulletCost}</td>
                            <td>{cooldown} seconden</td>
                            <td>
                                [<a href="?page=admin&module=travel&action=edit&id={id}">Bewerk</a>] 
                                [<a href="?page=admin&module=travel&action=delete&id={id}">Verwijder</a>]
                            </td>
                        </tr>
                    {/each}
                </tbody>
            </table>
        ';

        public $locationsDelete = '
            <form method="post" action="?page=admin&module=travel&action=delete&id={id}&commit=1">
                <div class="text-center">
                    <p> Weet je zeker dat je deze bestemming wilt verwijderen?</p>

                    <p><em>"{name}"</em></p>

                    <button class="btn btn-danger" name="submit" type="submit" value="1">Ja, verwijder deze bestemming!</button>
                </div>
            </form>
        
        ';
        public $locationsForm = '
            <form method="post" action="?page=admin&module=travel&action={editType}&id={id}">
                <div class="form-group">
                    <label class="pull-left">Naam</label>
                    <input type="text" class="form-control" name="name" value="{name}">
                </div>
                <div class="form-group">
                    <label class="pull-left">Kosten (&euro;)</label>
                    <input type="number" class="form-control" name="cost" value="{cost}">
                </div>
                <div class="form-group">
                    <label class="pull-left">Kogels</label>
                    <input type="number" class="form-control" name="bullets" value="{bullets}">
                </div>
                <div class="form-group">
                    <label class="pull-left">Kosten per kogel (&euro;)</label>
                    <input type="number" class="form-control" name="bulletCost" value="{bulletCost}">
                </div>
                <div class="form-group">
                    <label class="pull-left">Reistijd (sec)</label>
                    <input type="number" class="form-control" name="cooldown" value="{cooldown}">
                </div>
                
                <div class="text-right">
                    <button class="btn btn-default" name="submit" type="submit" value="1">Opslaan</button>
                </div>
            </form>
        ';
        
    }
