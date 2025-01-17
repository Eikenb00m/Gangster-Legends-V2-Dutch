<?php

/**
* This module allows users to vote for your site on the GL Directory
*
* @package GL Directory
* @author Chris Day
* @version 1.0.0
*/

class glDirectoryTemplate extends template {

	public $glDirectory = '
		<div class="panel panel-default">
			<div class="panel-heading">
				Stem voor {_setting "game_name"}
			</div>
			<div class="panel-body">
				<p>
					Door te stemmen op {_setting "game_name"} ontvang je een beloning!
				</p>
				<p>
					<a href="{voteUrl}/record/{key}/{id}" class="btn btn-default" target="_blank">
						Stem voor {_setting "game_name"}
					</a>
				</p>
			</div>
		</div>
	';

         public $options = '

            <form method="post" action="?page=admin&module=glDirectory&action=options">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="pull-left">Validatie sleutel (alleen installatie)</label>
                            <input type="text" class="form-control" name="validation" value="{validation}" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="pull-left">Toplist URL</label>
                            <input type="text" class="form-control" name="voteUrl" value="{voteUrl}" placeholder="https://glscript.net/directory/1-your-game/" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="pull-left">Request Key</label>
                            <input type="text" class="form-control" name="voteKey1" value="{voteKey1}" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="pull-left">Response Key</label>
                            <input type="text" class="form-control" name="voteKey2" value="{voteKey2}" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="pull-left">Min. Geld beloning</label>
                            <input type="text" class="form-control" name="voteMin" value="{voteMin}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="pull-left">Max. Geld beloning</label>
                            <input type="text" class="form-control" name="voteMax" value="{voteMax}" />
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <button class="btn btn-default" name="submit" type="submit" value="1">Opslaan</button>
                </div>

            </form>
        ';

}
