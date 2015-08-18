<?php

namespace Abobereich\ApiClient\Transformers;

use Abobereich\ApiClient\Models\Model;
use Abobereich\ApiClient\Models\Product;

/**
 * Class ProductTransformer
 *
 * @package Abobereich\ApiClient\Transformers
 */
class ProductTransformer extends Transformer
{
    /**
     * transforms an item (array of data) into an object
     *
     * @param array $item
     *
     * @return Model|Product
     */
    public function transform($item)
    {
        return (new Product(true))
            ->setId($item['id'])
            ->setDefaultPlan($item['default_plan'])
            ->setName($item['name'])
            ->setCreatedAt($item['created_at'])
            ->setUpdatedAt($item['updated_at']);
    }
}