<?php

namespace Abobereich\ApiClient\Transformers;

use Abobereich\ApiClient\Models\Model;
use Abobereich\ApiClient\Models\Subscription;

/**
 * Class SubscriptionTransformer
 *
 * @package Abobereich\ApiClient\Transformers
 */
class SubscriptionTransformer extends Transformer
{
    /**
     * transforms an item (array of data) into an object
     *
     * @param array $item
     *
     * @return Model
     */
    public function transform($item)
    {
        return (new Subscription(true))
            ->setId($item['id'])
            ->setAccountId($item['account_id'])
            ->setChargedThroughDate($item['charged_through_date'])
            ->setEndOfTerm($item['end_of_term'])
            ->setExternalIdentifier($item['external_identifier'])
            ->setPhaseId($item['phase_id'])
            ->setPlanId($item['plan_id'])
            ->setStartDate($item['start_date'])
            ->setSubscriptionNumber($item['subscription_number'])
            ->setCreatedAt($item['created_at'])
            ->setUpdatedAt($item['updated_at']);
    }
}