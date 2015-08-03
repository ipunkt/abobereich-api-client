#!/usr/bin/env php
<?php

require_once __DIR__ . '/../vendor/autoload.php';

//    you have to create yourself
$config = include __DIR__ . '/config.php';

$client = new Abobereich\ApiClient\Client($config['uri'], $config['key'], $config['secret']);

//  getting all account
$accounts = $client->accounts()->all();

echo count($accounts) . ' accounts found' . PHP_EOL;

if (isset($accounts[0])) {
    echo $accounts[0]->getName() . ' is the name of the first account' . PHP_EOL;
}

$account = $client->accounts()->find(30);

echo $account->getId() . ' has to be ID 30' . PHP_EOL;

