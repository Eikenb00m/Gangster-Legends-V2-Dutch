<?php

    class propertyManagementTemplate extends template {

        public $dropProperty = '
            <div class="panel panel-default">
                <div class="panel-heading">Weet je het zeker?</div>
                <div class="panel-body">
                    <p>
                        Weet je zeker dat je afstand wilt doen van deze bezitting?
                    </p>
                    <a href="?page=propertyManagement&module={module}&action=dropDo&code={code}" class="btn btn-danger"> 
                       Afstand doen van bezitting! 
                    </a>
                </div>
            </div>
        ';

        public $propertyManagement = '

            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">Bijwerken kosten of maximale inzet</div>
                        <div class="panel-body">
                            <form action="?page=propertyManagement&module={module}&action=cost" method="post">
                                <input type="number" name="cost" class="form-control" value="{cost}" /> 
                                <button class="btn btn-default">Bijwerken</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">Doorgeven eigendom</div>
                        <div class="panel-body">
                            <form action="?page=propertyManagement&module={module}&action=transfer" method="post">
                                <input type="text" name="transfer" class="form-control" /> 
                                <button class="btn btn-default">Doorgeven</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">Accounts</div>
                        <div class="panel-body">
                            <h3>
                                Totale winst: {profit}
                            </h3>
                            <small>
                                <a href="?page=propertyManagement&module={module}&action=reset">Reset winst</a>
                            </small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">Afstand doen van bezitting</div>
                        <div class="panel-body">
                            <a href="?page=propertyManagement&module={module}&action=drop" class="btn btn-danger"> Afstand doen</a>
                        </div>
                    </div>
                </div>
            </div>



        ';
        
    }

