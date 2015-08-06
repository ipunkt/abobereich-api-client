# abobereich-api-client
API Client for abobereich. A subscription and recurring billing service for on- and offline subscriptions.

[![Latest Stable Version](https://poser.pugx.org/ipunkt/abobereich-api-client/v/stable.svg)](https://packagist.org/packages/ipunkt/abobereich-api-client) [![Latest Unstable Version](https://poser.pugx.org/ipunkt/abobereich-api-client/v/unstable.svg)](https://packagist.org/packages/ipunkt/abobereich-api-client) [![License](https://poser.pugx.org/ipunkt/abobereich-api-client/license.svg)](https://packagist.org/packages/ipunkt/abobereich-api-client) [![Total Downloads](https://poser.pugx.org/ipunkt/abobereich-api-client/downloads.svg)](https://packagist.org/packages/ipunkt/abobereich-api-client)


## Configuration

You need a base url to your abobereich server and an api key with a secret. The credentials can be configured in the
 tenant dialog at the abobereich server.

	$uri = 'https://www.abobereich.de';
	$key = 'YOUR_API_KEY_HERE';
	$secret = 'YOUR_API_SECRET_HERE';
	$client = new \Abobereich\ApiClient\Client($uri, $key, $secret);


## Contexts

The api client has different contexts, so you can divide api parts into separate contexts.


### Tenants

	$client->tenants();    // the tenants context


#### Getting my own tenant

	/** @var \Abobereich\ApiClient\Models\Tenant $tenant */
    $tenant = $client->tenants()->me();


### Accounts

	$client->accounts();    // the accounts context


#### Getting all accounts

	/** @var array|\Abobereich\ApiClient\Models\Account[] $accounts */
	$accounts = $client->accounts()->all();


#### Getting an account by id

	/** @var \Abobereich\ApiClient\Models\Account $account */
	$account = $client->accounts()->find($id);


#### Create an account

First you have to create a model instance and set the values. All are optional, so you can create an empty account if
 you want to have your account data private. In this case you have to store the resulting id from the api to re-identify
 this account later on the subscription handling.

	$account = new \Abobereich\ApiClient\Models\Account();
	$account->setName('John Doe')
		->setExternalIdentifier('123456-AbcD');// here you can set the account identification from your system

	try {
		/** @var \Abobereich\ApiClient\Models\Account $account */
		$account = $client->accounts()->store($account);
	    echo 'Model created with ID: ' . $account->getId() . PHP_EOL;
	} catch (\Abobereich\ApiClient\Exceptions\InvalidRequestDataException $e) {
		echo $e->getMessage() . ': ' . implode(', ', $e->getErrors());
	} catch (\Abobereich\ApiClient\Exceptions\ModelNotCreatedException $e) {
		echo 'Model NOT CREATED, Error: ' . $e->getMessage() . PHP_EOL;
	}


### Products

	$client->products();    // the products context


#### Getting all products

	/** @var array|\Abobereich\ApiClient\Models\Product[] $products */
	$products = $client->products()->all();


#### Getting an account by id

	/** @var \Abobereich\ApiClient\Models\Account $product */
	$product = $client->products()->find($id);


### Plans

The plans always depends on products. So you have to set the product for the plans context.

	$client->plans($product);    // the plans context

	//  or later on
	$plansContext->setProduct($product);    // set another product for the plans context


#### Getting all plans for a product

	/** @var array|\Abobereich\ApiClient\Models\Plan[] $plans */
	$plans = $client->plans($product)->all();


#### Getting a plan for a product

	/** @var array|\Abobereich\ApiClient\Models\Plan $plan */
	$plan = $client->plans($product)->find($id);


