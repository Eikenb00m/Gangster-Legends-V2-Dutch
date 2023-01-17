<?php

   class roundsTemplate extends template {

        public $roundsHolder = '
        {#each rounds}
        <div class="crime-holder">
            <p>
                <span class="action">
                    {name} 
                </span>
       </div>
        {/each}';
        

        public $clearData = '
        	<p class="text-center">
            Druk op de onderstaande knop om de rondegegevens te wissen. Hierdoor worden gebruikers niet gewist, maar worden bepaalde aspecten van het spel gereset voor de volgende ronde.
        	</p>

        	<p class="text-center">
	        	<a href="?page=admin&module=rounds&action=clear&do=true" class="btn btn-danger">
	        		Verwijder ronde Data
	        	</a>
        	</p>
        ';

        public $roundsList = '
            <table class="table table-condensed table-striped table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th width="220px">Start</th>
                        <th width="220px">Eind</th>
                        <th width="100px">Opties</th>
                    </tr>
                </thead>
                <tbody>
                    {#each rounds}
                        <tr>
                            <td>{name}</td>
                            <td>{startDate}</td>
                            <td>{endDate}</td>
                            <td>
                                [<a href="?page=admin&module=rounds&action=edit&id={id}">Bewerk</a>] 
                                [<a href="?page=admin&module=rounds&action=delete&id={id}">Verwijder</a>]
                            </td>
                        </tr>
                    {/each}
                </tbody>
            </table>
        ';

        public $roundsDelete = '
            <form method="post" action="?page=admin&module=rounds&action=delete&id={id}&commit=1">
                <div class="text-center">
                    <p> Weet je zeker dat je deze ronde wil verwijderen?</p>

                    <p><em>"{name}"</em></p>

                    <button class="btn btn-danger" name="submit" type="submit" value="1">Ja! Verwijder deze ronde!</button>
                </div>
            </form>
        
        ';
        public $roundsForm = '
            <form method="post" action="?page=admin&module=rounds&action={editType}&id={id}">
                <div class="form-group">
                    <label class="pull-left">Ronde naam</label>
                    <input type="text" class="form-control" name="name" value="{name}">
                </div>
                <div class="form-group">
                    <label class="pull-left">Start datum</label>
                    <input type="datetime-local" class="form-control" name="start" value="{start}">
                </div>
                <div class="form-group">
                    <label class="pull-left">Eind datum</label>
                    <input type="datetime-local" class="form-control" name="end" value="{end}">
                </div>
                
                <div class="text-right">
                    <button class="btn btn-default" name="submit" type="submit" value="1">Opslaan</button>
                </div>
            </form>
        ';
    }

