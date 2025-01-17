<?php

    class registerTemplate extends template {
    
        public $registerForm = '
            <{text}>
            <form action="?page=register&action=register{#if ref}&ref={ref}{/if}" method="post">
                <input type="hidden" name="_CSFR" value="{_CSFRToken}" />
                <input class="form-control" type="text" name="username" placeholder="Gebruikersnaam" /><br />
                <input class="form-control" type="text" autocomplete="off" name="email" placeholder="EMail" /><br />
                <div class="row">
                    <div class="col-xs-6">
                        <input class="form-control" type="password" name="password" placeholder="Wachtwoord" />
                    </div>
                    <div class="col-xs-6">
                        <input class="form-control" type="password" name="cpassword" placeholder="Bevestig Wachtwoord" />
                    </div>
                </div><br />
                <div class="text-right">
                    <button type="submit" class="btn btn-default">Registreer</button>
                </div>
            </form>
        ';

        public $registerOptions = '

            <form method="post" action="?page=admin&module=register&action=settings">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="checkbox" name="validateUserEmail" value="1" {#if validateUserEmail}checked{/if} /> 
                            <label class="">Valideer gebruiker Email</label><br />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label class="">Register Suffix</label>
                        <div class="form-group">
                            <textarea type="text" class="form-control" name="registerSuffix" data-editor="html" rows="5">{registerSuffix}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label class="">Register Postfix</label>
                        <div class="form-group">
                            <textarea type="text" class="form-control" name="registerPostfix" data-editor="html" rows="5">{registerPostfix}</textarea>
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <button class="btn btn-default" name="submit" type="submit" value="1">Opslaan</button>
                </div>
            </form>
        ';
        
    }

