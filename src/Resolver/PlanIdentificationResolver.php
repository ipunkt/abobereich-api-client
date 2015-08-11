<?php

namespace Abobereich\ApiClient\Resolver;

use Abobereich\ApiClient\Models\Model;
use Abobereich\ApiClient\Models\Plan;

/**
 * Class PlanIdentificationResolver
 *
 * @package Abobereich\ApiClient\Resolver
 */
class PlanIdentificationResolver extends IdentificationResolver
{
    /**
     * resolves identification
     *
     * @param \Abobereich\ApiClient\Models\Model|Plan $model
     * @param array $data
     *
     * @return array|bool
     */
    protected function resolveIdentification(Model $model, array $data)
    {
        if ( ! empty($model->getId())) {
            $data['plan_id'] = $model->getId();

            return $data;
        }

        if ( ! empty($model->getExternalIdentifier())) {
            $data['plan_identifier'] = $model->getExternalIdentifier();

            return $data;
        }

        if ( ! empty($model->getSlug())) {
            $data['plan_slug'] = $model->getSlug();

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
        throw new \InvalidArgumentException('Plan has to be set an id or external identifier or slug');
    }
}