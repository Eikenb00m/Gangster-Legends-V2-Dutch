<?php

    class bankTemplate extends template {


         public $options = '

            <form method="post" action="#">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="pull-left">Belasting (%)</label>
                            <input type="text" class="form-control" name="bankTax" value="{bankTax}" />
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <button class="btn btn-default" name="submit" type="submit" value="1">Opslaan</button>
                </div>

            </form>
        ';

        
        public $bank = '
            <div class="row">
                <div class="col-md-6">
                    <form action="?page=bank&action=process" method="post">
                        <div class="panel panel-default">
                            <div class="panel-heading">Storten</div>
                            <div class="panel-body">
                                <p style="height:54px; line-height:18px;">
                                    Stuur geld naar je witwasser, zodat hij het veilig op je bank rekening kan storten. Hij zal wel {tax}% houden voor zijn verdiensten!
                                </p>
                                <p>
                                    <input type="text" class="form-control" value="{deposit}" name="deposit" />
                                </p>
                                <p class="text-right">
                                    <button type="submit" class="btn btn-default" name="bank" value="deposit">Storten</button>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form action="?page=bank&action=process" method="post">
                        <div class="panel panel-default">
                            <div class="panel-heading"> Opnemen </div>
                            <div class="panel-body">
                                <p style="height:54px; line-height:18px;">
                                    Er zijn geen kosten verbonden aan geld opnemen!<br />
                                </p>
                                <p>
                                    <input type="text" class="form-control" value="{withdraw}" name="withdraw" />
                                </p>
                                <p class="text-right">
                                    <button type="submit" class="btn btn-default" name="bank" value="withdraw">Opnemen</button>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <form method="post" action="?page=bank&action=transfer">
                        <div class="panel panel-default">
                            <div class="panel-heading">Geld Doneren</div>
                            <div class="panel-body">
                                <p>
                                    <input type="text" class="form-control" name="user" placeholder="Gebruikersnaam" />
                                </p>
                                <p>
                                    <input type="number" class="form-control" name="money" placeholder="Gift" />
                                </p>
                                <p class="text-right">
                                    <button type="submit" class="btn btn-default" name="submit" value="1">Verstuur</button>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>    
        ';
        
    }
