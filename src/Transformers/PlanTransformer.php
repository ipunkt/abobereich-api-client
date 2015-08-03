<?php

namespace Abobereich\ApiClient\Transformers;

use Abobereich\ApiClient\Models\Model;
use Abobereich\ApiClient\Models\Plan;

/**
 * Class PlanTransformer
 *
 * @package Abobereich\ApiClient\Transformers
 */
class PlanTransformer extends Transformer
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
        return (new Plan())
            ->setId($item['id'])
            ->setProductId($item['product_id'])
            ->setVariantOfPlan($item['variant_of_plan'])
            ->setSlug($item['slug'])
            ->setName($item['name'])
            ->setExternalIdentifier($item['external_identifier'])
            ->setSubscriptionSubscribersCount($item['subscription_subscribers_count'])
            ->setSubscriptionNumberFormat($item['subscription_number_format'])
            ->setBillingPeriod($item['billing_period'])
            ->setBillingPeriodCount($item['billing_period_count'])
            ->setBillingPeriodStart($item['billing_period_start'])
            ->setBillingCalculation($item['billing_calculation'])
            ->setCreateAlignment($item['create_alignment'])
            ->setChangePolicy($item['change_policy'])
            ->setChangeAlignment($item['change_alignment'])
            ->setCancelPolicy($item['cancel_policy'])
            ->setEndOfTermPolicy($item['end-of_term_policy'])
            ->setValidFrom($item['valid_from'])
            ->setValidUntil($item['valid_until'])
            ->setCreatedAt($item['created_at'])
            ->setUpdatedAt($item['updated_at']);
    }
}