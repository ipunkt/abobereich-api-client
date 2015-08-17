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

if (isset($products[0])) {
    //  getting all plans for first product
    $plans = $client->plans($products[0])->all();

    echo count($plans) . ' plans for product ' . $products[0]->getName() . ' found' . PHP_EOL;

}

echo 'Plans with tag FREE for Product ' . $products[0]->getName() . PHP_EOL;
foreach ($client->plans($products[0])->allByTag('FREE') as $plan) {
    echo $plan->getId() . ' - ' . $plan->getTagsAsString() . PHP_EOL;
}

//  create an account
$account = new \Abobereich\ApiClient\Models\Account();
$account->setName('Robert Kummer')->setEmail('rok@ipunkt.biz')->setData('address', 'Hartwigstraße 8')->setData('zip', 71638);

try {
    $account = $client->accounts()->store($account);

    echo 'Model created with ID: ' . $account->getId() . PHP_EOL;
} catch (\Abobereich\ApiClient\Exceptions\InvalidRequestDataException $e) {
    echo $e->getMessage() . ': ' . implode(', ', $e->getErrors());
} catch (\Abobereich\ApiClient\Exceptions\ModelNotCreatedException $e) {
    echo 'Model NOT CREATED, Error: ' . $e->getMessage() . PHP_EOL;
}

//  update an account
$account = $client->accounts()->find(1);
$account->setEmail('hello@world.com')
    ->setData('zip', '12345');

try {
    $account = $client->accounts()->update($account);

    echo 'Model updated with ID: ' . $account->getId() . PHP_EOL;
} catch (\Abobereich\ApiClient\Exceptions\InvalidRequestDataException $e) {
    echo $e->getMessage() . ': ' . implode(', ', $e->getErrors());
} catch (\Abobereich\ApiClient\Exceptions\ModelNotUpdatedException $e) {
    echo 'Model NOT UPDATED, Error: ' . $e->getMessage() . PHP_EOL;
}

//  get all subscriptions
$subscriptions = $client->subscriptions()->all();
foreach ($subscriptions as $subscription)
{
    echo $subscription->getSubscriptionNumber() . ' - ' . $subscription->getPlanId() . PHP_EOL;
}

$subscriptions = $client->subscriptions()->allForProduct(2);
foreach ($subscriptions as $subscription)
{
    echo $subscription->getSubscriptionNumber() . ' - ' . $subscription->getPlanId() . PHP_EOL;
}

$subscriptions = $client->subscriptions()->allForBeingSubscriber(30);
foreach ($subscriptions as $subscription)
{
    echo $subscription->getSubscriptionNumber() . ' - ' . $subscription->getPlanId() . PHP_EOL;
}
