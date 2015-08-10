<?php

namespace Abobereich\ApiClient\Contexts;

use Abobereich\ApiClient\Models\Account;
use Abobereich\ApiClient\Models\Product;
use Abobereich\ApiClient\Models\Subscription;
use Abobereich\ApiClient\Transformers\SubscriptionTransformer;
use Abobereich\ApiClient\Transformers\Transformer;

/**
 * Class Subscriptions
 *
 * @package Abobereich\ApiClient\Contexts
 */
class Subscriptions extends Context
{
    /**
     * returns all subscriptions
     *
     * @return \Abobereich\ApiClient\Models\Subscription[]|array
     */
    public function all()
    {
        return $this->index('/api/subscriptions', 'subscriptions');
    }

    /**
     * returns all subscriptions related to a product
     *
     * @param int|Product $product
     *
     * @return \Abobereich\ApiClient\Models\Subscription[]|array
     */
    public function allForProduct($product)
    {
        $productId = ($product instanceof Product) ? $product->getId() : $product;

        return $this->index('/api/subscriptions?product_id=' . intval($productId), 'subscriptions');
    }

    /**
     * returns all subscriptions related to an account (contractor)
     *
     * @param int|Account $account
     *
     * @return \Abobereich\ApiClient\Models\Subscription[]|array
     */
    public function allForAccount($account)
    {
        $accountId = ($account instanceof Account) ? $account->getId() : $account;

        return $this->index('/api/subscriptions?account_id=' . intval($accountId), 'subscriptions');
    }

    /**
     * returns all subscriptions related to an account (subscription subscriber)
     *
     * @param int|Account $account
     *
     * @return \Abobereich\ApiClient\Models\Subscription[]|array
     */
    public function allForBeingSubscriber($account)
    {
        $accountId = ($account instanceof Account) ? $account->getId() : $account;

        return $this->index('/api/subscriptions?subscriber_id=' . intval($accountId), 'subscriptions');
    }

    /**
     * returns a transformer
     *
     * @return Transformer
     */
    protected function transformer()
    {
        return new SubscriptionTransformer();
    }
}