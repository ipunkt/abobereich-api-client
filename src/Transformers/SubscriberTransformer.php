<?php

namespace Abobereich\ApiClient\Transformers;

use Abobereich\ApiClient\Models\Model;
use Abobereich\ApiClient\Models\Plan;
use Abobereich\ApiClient\Models\Subscriber;

/**
 * Class SubscriberTransformer
 *
 * @package Abobereich\ApiClient\Transformers
 */
class SubscriberTransformer extends Transformer
{
    /**
     * transforms an item (array of data) into an object
     *
     * @param array $item
     *
     * @return Model|Plan
     */
    public function transform($item)
    {
        return (new Subscriber(true))
            ->setId($item['id'])
            ->setSubscriptionId($item['subscription_id'])
            ->setAccountId($item['account_id'])
            ->setCreatedAt($item['created_at'])
            ->setUpdatedAt($item['updated_at']);
    }
}