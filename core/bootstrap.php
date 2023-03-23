<?php

use App\Core\App;
use App\Core\Session;
use App\Core\Db\Connection;
use App\Core\Db\QueryBuilder;

$app = [];

App::bind('env', require('env.php'));
(App::get('env')['mode'] !== 'dev') ?: require('reporting.php');

App::bind('appConfig', require(App::get('env')['appConfigPath']));
App::bind('dbConfig', require(App::get('env')['dbConfigPath']));
App::bind('session', Session::getInstance());

App::bind('db', new QueryBuilder(
    Connection::make(App::get('dbConfig'))
));
