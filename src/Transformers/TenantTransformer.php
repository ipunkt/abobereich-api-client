<?php

namespace Abobereich\ApiClient\Transformers;

use Abobereich\ApiClient\Models\Model;
use Abobereich\ApiClient\Models\Tenant;

/**
 * Class TenantTransformer
 *
 * @package Abobereich\ApiClient\Transformers
 */
class TenantTransformer extends Transformer
{
    /**
     * transforms an item (array of data) into an object
     *
     * @param array $item
     *
     * @return Model|Tenant
     */
    public function transform($item)
    {
        return (new Tenant(true))
            ->setId($item['id'])
            ->setName($item['name'])
            ->setCreatedAt($item['created_at'])
            ->setUpdatedAt($item['updated_at']);
    }
}