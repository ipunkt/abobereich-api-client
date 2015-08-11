<?php

namespace Abobereich\ApiClient\Resolver;

use Abobereich\ApiClient\Models\Account;
use Abobereich\ApiClient\Models\Model;

/**
 * Class AccountIdentificationResolver
 *
 * @package Abobereich\ApiClient\Resolver
 */
class AccountIdentificationResolver extends IdentificationResolver
{
    /**
     * resolves identification
     *
     * @param \Abobereich\ApiClient\Models\Model|Account $model
     * @param array $data
     *
     * @return array|bool
     */
    protected function resolveIdentification(Model $model, array $data)
    {
        if ( ! empty($model->getId())) {
            $data['account_id'] = $model->getId();

            return $data;
        }

        if ( ! empty($model->getExternalIdentifier())) {
            $data['account_identifier'] = $model->getExternalIdentifier();

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
        throw new \InvalidArgumentException('Account has to be set an id or external identifier');
    }
}