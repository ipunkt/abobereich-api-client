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

#### Find an account

You have more than one way to find an account. Here are the valid examples:

	/** @var \Abobereich\ApiClient\Models\Account $account */
	$account = $client->accounts()->findById(1234);
    $account = $client->accounts()->findByIdentifier('YOUR_ACCOUNT_IDENTIFIER');
    $account = $client->accounts()->findByEmail('name@mail.com');
    $account = $client->accounts()->findByName('John Doe');

The method `findByName` is not recommended for finding one account. But for testdata it is useful too.


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


#### Update an account

Typically you have an account already loaded via `all()` or stored in your database after creating an account instance.

	// $account already loaded (IMPORTANT: getId() returns the correct id)
	$account->setName('John Doe')
		->setData('city', 'Los Angeles');

	try {
        $account = $client->accounts()->update($account);

        echo 'Model updated with ID: ' . $account->getId() . PHP_EOL;
    } catch (\Abobereich\ApiClient\Exceptions\InvalidRequestDataException $e) {
        echo $e->getMessage() . ': ' . implode(', ', $e->getErrors());
    } catch (\Abobereich\ApiClient\Exceptions\ModelNotUpdatedException $e) {
        echo 'Model NOT UPDATED, Error: ' . $e->getMessage() . PHP_EOL;
    }


### Products

	$client->products();    // the products context


#### Getting all products

	/** @var array|\Abobereich\ApiClient\Models\Product[] $products */
	$products = $client->products()->all();


#### Getting a product by id

	/** @var \Abobereich\ApiClient\Models\Product $product */
	$product = $client->products()->find($id);


#### Find a product

You have more than one way to find a product. Here are the valid examples:

	/** @var \Abobereich\ApiClient\Models\Product $product */
	$product = $client->products()->findById(1234);
    $product = $client->products()->findBySlug('product-slug');
    $product = $client->products()->findByName('John Doe');

The method `findByName` is not recommended for finding one product. But for testdata it is useful too.


### Plans

The plans always depends on products. So you have to set the product for the plans context.

	$client->plans($product);    // the plans context

	//  or later on
	$plansContext->setProduct($product);    // set another product for the plans context


#### Getting all plans for a product

	/** @var array|\Abobereich\ApiClient\Models\Plan[] $plans */
	$plans = $client->plans($product)->all();


#### Getting all plans for a product with one or more tags associated

	/** @var array|\Abobereich\ApiClient\Models\Plan[] $plans */
	$plans = $client->plans($product)->allByTag('TAG');


#### Getting a plan for a product

	/** @var array|\Abobereich\ApiClient\Models\Plan $plan */
	$plan = $client->plans($product)->find($id);


#### Find a plan for a product

You have more than one way to find a plan. Here are the valid examples:

	/** @var array|\Abobereich\ApiClient\Models\Plan $plan */
    $plan = $client->plans($product)->findById($id);
    $plan = $client->plans($product)->findByIdentifier('YOUR_ACCOUNT_IDENTIFIER');
    $plan = $client->plans($product)->findBySlug('plan-slug');
    $plan = $client->plans($product)->findByName('PLAN 123');

The method `findByName` is not recommended for finding one plan. But for testdata it is useful too.


### Subscriptions

A subscription is the contract an account can have. There is a difference between having a contract (subscription) and
 being the beneficiary (subscriber) of the subscriptions benefits.


#### Getting all subscriptions (unfiltered)

	/** @var array|\Abobereich\ApiClient\Models\Subscription[] $subscriptions */
	$subscriptions = $client->subscriptions()->all();


#### Getting all subscriptions for a product

	$product = 1;// or @var \Abobereich\ApiClient\Models\Product $product

	/** @var array|\Abobereich\ApiClient\Models\Subscription[] $subscriptions */
	$subscriptions = $client->subscriptions()->allForProduct($product);


#### Getting all subscriptions for an account (contractor)

	$account = 1;// or @var \Abobereich\ApiClient\Models\Account $account

	/** @var array|\Abobereich\ApiClient\Models\Subscription[] $subscriptions */
	$subscriptions = $client->subscriptions()->allForAccount($account);


#### Getting all subscriptions for a subscription subscriber (account is beneficiary)

	$account = 1;// or @var \Abobereich\ApiClient\Models\Account $account

	/** @var array|\Abobereich\ApiClient\Models\Subscription[] $subscriptions */
	$subscriptions = $client->subscriptions()->allForBeingSubscriber($account);


#### Getting a subscription

	/** @var array|\Abobereich\ApiClient\Models\Subscription $subscription */
	$subscription = $client->subscriptions()->find($id);


#### Find subscriptions with other properties

You have more than one way to find a subscription. Here are the valid examples:

	/** @var array|\Abobereich\ApiClient\Models\Subscription $subscription */
    $subscription = $client->subscriptions()->findById($id);
    $subscription = $client->subscriptions()->findByNumber('PQXNC-KWFXO-JVUYO-03642');
    $subscription = $client->subscriptions()->findByIdentifier('EXTERNAL_Identifier-FOR-subscRiptIOn);


#### Create a new subscription

You have to create and store a subscription model through the api.

	$account = $client->accounts()->findByEmail('john@doe.com');
	$plan = $client->plans($product)->findBySlug($slug);
	
	$subscription = new \Abobereich\ApiClient\Models\Subscription();
    $subscription->setAccountId($account)
        ->setSubscriptionNumber('1234-ABO-YXCE')
        ->setPlanId($plan);
    
    $subscription = $client->subscriptions()->save($subscription);  // or $client->subscriptions()->store($subscription);


#### Update an existing subscription

You have to fetch the stored subscription model through the api.

	$subscription = $client->subscriptions()->findByNumber('1234-ABO-YXCE);
    $subscription->setNextBillingDate(date('Y-m-d H:i:s'));
    
    $subscription = $client->subscriptions()->save($subscription);  // or $client->subscriptions()->update($subscription);


### Subscribers

Each subscription can have one or more subscribers. You can define the concrete number at the plans subscription 
 subscribers count. A subscriber consumes the benefits of a subscription. It must not be the contractor of the 
 subscription but it can be. For example you charge a family subscription contract and the contractor is you, but the 
 subscribers are your family members.

The subscriber always depends on subscriptions. So you have to set the subscription for the subscribers context.

	$client->subscribers($subscription);    // the subscribers context

	//  or later on
	$subscriptionsContext->setSubscription($subscription);    // set another subscription for the subscribers context


#### Getting all subscribers for a subscription

	/** @var array|\Abobereich\ApiClient\Models\Subscriber[] $subscribers */
	$subscribers = $client->subscribers($subscription)->all();


#### Getting a subscriber for a subscription

	/** @var array|\Abobereich\ApiClient\Models\Subscriber $subscriber */
	$subscriber = $client->subscribers($subscription)->find($id);


#### Create a subscriber

First you have to create a model instance and set the values. A subscriber has a connection to an account and a 
 subscription. The subscription is already set via the subscribers context, but the related account is missing.

	$account = $client->accounts()->find(1);
	$subscriber = new \Abobereich\ApiClient\Models\Subscriber();
	$subscriber->setAccountId($account);

	try {
		$subscriber = $client->subscribers($subscription)->store($subscriber);
	    echo 'Model created with ID: ' . $subscriber->getId() . PHP_EOL;
	} catch (\Abobereich\ApiClient\Exceptions\InvalidRequestDataException $e) {
		echo $e->getMessage() . ': ' . implode(', ', $e->getErrors());
	} catch (\Abobereich\ApiClient\Exceptions\ModelNotCreatedException $e) {
		echo 'Model NOT CREATED, Error: ' . $e->getMessage() . PHP_EOL;
	}


### Blocks

VERY EXPERIMENTAL!!!

The blocks api is for marketing use cases. A block is a text or html block. It is related to a product and has its 
 value depending on a plan. So you can make your price-table dynamic. You can create an unlimited amount of text blocks 
 at abobereich. All blocks can have a language. For your frontend rendering simply retrieve all blocks and display them.
 Your sales and marketing team can manipulate them in abobereich, so you can do A/B tests without doing any stuff on 
 the frontend rendering. Maintain the blocks at abobereich.

The blocks context is always related to a product, so set it.

	$client->blocks($product);    // the blocks context

	//  or later on
	$blocksContext->setProduct($product);    // set another product for the blocks context


#### Getting all blocks for a product

	/** @var array $blocks */
	$blocks = $client->blocks($product)->all();


#### Getting all blocks for a product for one or many languages

	/** @var array $blocks */
	$blocks = $client->blocks($product)->allWithLanguage('en');

	/** @var array $blocks */
	$blocks = $client->blocks($product)->allWithLanguage(['en', 'de', 'fr']);


#### Resulting blocks array

The resulting blocks array has the following structure:

	{
		"PLAN-SLUG": {
			"BLOCK-IDENTIFIER": {
				"LANGUAGE-CODE": "CONTENT-IN-LANGUAGE"
			}
		}
	}

All language-neutral blocks will be set in all languages returned. So you do not have to be careful by checking array 
 set. Every block in every language will be in the result. Null-values will be null.

Example:

	{
		"super-plan": {
			"teaser_image": {
				"de": "teaser.png",
				"en": "teaser.png",
			},
			"subscription_headline": {
				"de": "Super Plan - Das musst du haben...",
				"en": "All you need is SUPER PLAN!",
			}
		}
	}