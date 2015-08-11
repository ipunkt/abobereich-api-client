<?php

namespace Abobereich\ApiClient\Resolver;

use Abobereich\ApiClient\Models\Model;

/**
 * Class IdentificationResolver
 *
 * @package Abobereich\ApiClient\Resolver
 */
abstract class IdentificationResolver
{
    /**
     * resolves identification attributes for a model
     *
     * @param \Abobereich\ApiClient\Models\Model $model
     * @param array $data
     *
     * @return array
     */
    public function resolve(Model $model, array $data)
    {
        if (($result = $this->resolveIdentification($model, $data)) === false) {
            $this->invalidArgument();
        }

        return $result;
    }

    /**
     * resolves identification attributes for a model
     *
     * @param \Abobereich\ApiClient\Models\Model $model
     * @param array $data
     *
     * @return bool
     */
    abstract protected function resolveIdentification(Model $model, array $data);

    /**
     * throws invalid argument exception when no identification can be resolved
     *
     * @return void
     * @throws \InvalidArgumentException
     */
    abstract public function invalidArgument();
}