#!/usr/bin/env php
<?php

require_once __DIR__ . '/../vendor/autoload.php';

//    you have to create yourself
$config = include __DIR__ . '/config.php';

$client = new Abobereich\ApiClient\Client($config['uri'], $config['key'], $config['secret']);

//  getting my tenant name
$tenant = $client->tenants()->me();
echo 'My tenant name is ' . $tenant->getName() . PHP_EOL;

//  getting all account
$accounts = $client->accounts()->all();

echo count($accounts) . ' accounts found' . PHP_EOL;

if (isset($accounts[0])) {
    echo $accounts[0]->getName() . ' is the name of the first account' . PHP_EOL;
}

//  getting all products
$products = $client->products()->all();

echo count($products) . ' products found' . PHP_EOL;

