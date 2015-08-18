<?php

namespace Abobereich\ApiClient\Transformers;

use Abobereich\ApiClient\Models\Account;

/**
 * Class AccountTransformer
 *
 * @package Abobereich\ApiClient\Transformers
 */
class AccountTransformer extends Transformer
{
    /**
     * transforms an item (array of data) into an object
     *
     * @param array $item
     *
     * @return mixed
     */
    public function transform($item)
    {
        return (new Account(true))
            ->setId($item['id'])
            ->setName($item['name'])
            ->setEmail($item['email'])
            ->setCurrency($item['currency'])
            ->setBillingCycleDay($item['billing_cycle_day'])
            ->setExternalIdentifier($item['external_identifier'])
            ->setCreatedAt($item['created_at'])
            ->setUpdatedAt($item['updated_at']);
    }
}