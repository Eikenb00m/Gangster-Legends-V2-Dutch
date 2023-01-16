<?php

    class blackjackTemplate extends template {

        public $scoreTest = '
            <h4>{score}</h4>
            {>cards}
        ';
        public $blackjackTable = '

            
            <div class="panel panel-default">
                <div class="panel-heading">Blackjack</div>
                <div class="panel-body">
                    <div class="dealers-hand">
                        <h4>Kaarten van de Dealer {#if dealerScore}<span class="label label-success">{dealerScore}{/if}</span></h4>
                        {#each dealer}
                            {#if hide}
                                <div class="card backs red"></div>
                            {/if}
                            {#unless hide}
                                <div class="card {suit} card-{card}"></div>
                            {/unless}
                        {/each}
                    </div>            

                    <h4>Jou kaarten <span class="label label-success">{score}</span></h4>
                    {#each user}
                        {#if hide}
                            <div class="card backs red"></div>
                        {/if}
                        {#unless hide}
                            <div class="card {suit} card-{card}"></div>
                        {/unless}
                    {/each}

                    <hr />

                    <strong>Stake:</strong> ${formatedBet}<br />

                    {#unless gameOver}
                        <a href="?page=blackjack&action=hit" class="btn btn-danger">Pak een kaart!</a>
                        <a href="?page=blackjack&action=stand" class="btn btn-success">Houd je kaarten!</a>
                    {/unless}
                    {#if gameOver}
                        <a href="?page=blackjack" class="btn btn-success">Speel opnieuw</a>
                        <a href="?page=blackjack&bet={bet}" class="btn btn-danger">Speel opnieuw met de zelfde inzet</a>
                    {/if}
                </div>
            </div>
        ';

        public $placeBet = "
            <div class='panel panel-default'>
                <div class='panel-heading'>Plaats je inzet </div>
                <div class='panel-body'>
                    {#if closed}
                        Dit object is momenteel gesloten door de eigenaar.
                    {/if}

                    {#unless closed}
                        <h4> Plaats je inzet </h4>
                        <form method='post' action='#'>
                            <input type='number' name='bet' class='form-control form-control-inline' placeholder='0' /> 
                            <button class='btn btn-default'>Zet in!</button>
                        </form>
                        <hr />
                        
                        <small> Min: &euro;100 Max: {maxBet}</small> <br />
                        <small>{>propertyOwnership}</small>
                    {/unless}
                </div>
            </div>
        ";

        public $cards = '
            {#each cards}
                {#if hide}
                    <div class="card backs red"></div>
                {/if}
                {#unless hide}
                    <div class="card {suit} card-{card}"></div>
                {/unless}
            {/each}
        ';

    }

