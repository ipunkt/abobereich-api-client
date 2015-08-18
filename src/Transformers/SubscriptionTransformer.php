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
            ->setPlanId($item['plan_id'])
            ->setCurrentPhase($item['current_phase'])
            ->setSubscriptionNumber($item['subscription_number'])
            ->setAccountId($item['account_id'])
            ->setExternalIdentifier($item['external_identifier'])
            ->setStartDate($item['start_date'])
            ->setNextBillingDate($item['next_billing_date'])
            ->setChargedThroughDate($item['charged_through_date'])
            ->setEndOfTerm($item['end_of_term'])
            ->setCreatedAt($item['created_at'])
            ->setUpdatedAt($item['updated_at']);
    }
}