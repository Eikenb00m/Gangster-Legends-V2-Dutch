<?php

   class theftTemplate extends template {

        public $theftHolder = '

            <div class="panel panel-default">
                <div class="panel-heading">Auto Diefstal</div>
                <div class="panel-body">
                    {#each theft}
                        <div class="crime-holder">
                            <p>
                                <span class="action">
                                    {name} 
                                </span>
                                <span class="commit">
                                    <a href="?page=theft&action=commit&id={id}&_CSFR={_CSFRToken}">Steel</a>
                                </span>
                            </p>
                            <div class="crime-perc">
                                <div class="perc" style="width:{percent}%;"></div>
                            </div>
                        </div>
                    {/each}
                </div>
            </div>
        ';
        

        public $theftList = '
            <table class="table table-condensed table-striped table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>Auto Diefstal</th>
                        <th width="70px">Kans</th>
                        <th width="120px">Max Schade</th>
                        <th width="120px">Min auto waarde</th>
                        <th width="120px">Max auto waarde</th>
                        <th width="100px">Opties</th>
                    </tr>
                </thead>
                <tbody>
                    {#each theft}
                        <tr>
                            <td>{name}</td>
                            <td>{chance}%</td>
                            <td>{maxDamage}</td>
                            <td>${worstCar}</td>
                            <td>${bestCar}</td>
                            <td>
                                [<a href="?page=admin&module=theft&action=edit&id={id}">Bewerk</a>] 
                                [<a href="?page=admin&module=theft&action=delete&id={id}">Verwijder</a>]
                            </td>
                        </tr>
                    {/each}
                </tbody>
            </table>
        ';

        public $theftDelete = '
            <form method="post" action="?page=admin&module=theft&action=delete&id={id}&commit=1">
                <div class="text-center">
                    <p> Weet je zeker dat je deze diefstal wilt verwijderen?</p>

                    <p><em>"{name}"</em></p>

                    <button class="btn btn-danger" name="submit" type="submit" value="1">Ja verwijder de diefstal!</button>
                </div>
            </form>
        
        ';
        public $theftForm = '
            <form method="post" action="?page=admin&module=theft&action={editType}&id={id}">
                <div class="form-group">
                    <label class="pull-left">Diefstal naam</label>
                    <input type="text" class="form-control" name="name" value="{name}">
                </div>
                <div class="form-group">
                    <label class="pull-left">Kans (percentage)</label>
                    <input type="number" class="form-control" name="chance" value="{chance}">
                </div>
                <div class="form-group">
                    <label class="pull-left">Minimale auto waarde voor succesvolle diefstal</label>
                    <input type="number" class="form-control" name="worstCar" value="{worstCar}">
                </div>
                <div class="form-group">
                    <label class="pull-left">Maximale auto waarde voor succesvolle diefstal</label>
                    <input type="number" class="form-control" name="bestCar" value="{bestCar}">
                </div>
                <div class="form-group">
                    <label class="pull-left">Maximale hoeveelheid schade voor succesvolle diefstal</label>
                    <input type="number" class="form-control" name="maxDamage" value="{maxDamage}">
                </div>
                <div class="text-right">
                    <button class="btn btn-default" name="submit" type="submit" value="1">Opslaan</button>
                </div>
            </form>
        ';
    }


