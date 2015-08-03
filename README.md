# abobereich-api-client
API Client for abobereich. A subscription and recurring billing service for on- and offline subscriptions.


## Configuration

You need an base url to your abobereich server and an api key with a secret. The credentials can be configured in the
 tenant dialog at the abobereich server.

	$uri = 'https://www.abobereich.de';
	$key = 'YOUR_API_KEY_HERE';
	$secret = 'YOUR_API_SECRET_HERE';
	$client = new Abobereich\ApiClient\Client($uri, $key, $secret);


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


### Products

	$client->products();    // the products context


#### Getting all products

	/** @var array|\Abobereich\ApiClient\Models\Product[] $products */
	$products = $client->products()->all();


#### Getting an account by id

	/** @var \Abobereich\ApiClient\Models\Account $product */
	$product = $client->products()->find($id);


