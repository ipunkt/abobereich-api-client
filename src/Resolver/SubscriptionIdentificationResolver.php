<?php

namespace Abobereich\ApiClient\Resolver;

use Abobereich\ApiClient\Models\Subscription;
use Abobereich\ApiClient\Models\Model;

/**
 * Class SubscriptionIdentificationResolver
 *
 * @package Abobereich\ApiClient\Resolver
 */
class SubscriptionIdentificationResolver extends IdentificationResolver
{
    /**
     * resolves identification
     *
     * @param \Abobereich\ApiClient\Models\Model|Subscription $model
     * @param array $data
     *
     * @return array|bool
     */
    protected function resolveIdentification(Model $model, array $data)
    {
        if ( ! empty($model->getId())) {
            $data['subscription_id'] = $model->getId();

            return $data;
        }

        if ( ! empty($model->getExternalIdentifier())) {
            $data['subscription_identifier'] = $model->getExternalIdentifier();

            return $data;
        }

        if ( ! empty($model->getSubscriptionNumber())) {
            $data['subscription_number'] = $model->getSubscriptionNumber();

            return $data;
        }

        return false;
    }

    /**
     * throws invalid argument exception when no identification can be resolved
     *
     * @return void
     * @throws \InvalidArgumentException
     */
    public function invalidArgument()
    {
        throw new \InvalidArgumentException('Subscription has to be set an id or external identifier or subscription number');
    }
}