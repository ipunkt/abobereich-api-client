<?php

namespace Abobereich\ApiClient\Contexts;

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
     * returns all accounts
     *
     * @return array|Subscription[]
     */
    public function all()
    {
        return $this->index('/api/subscriptions', 'subscriptions');
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