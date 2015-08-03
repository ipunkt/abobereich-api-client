<?php

namespace Abobereich\ApiClient\Contexts;

use Abobereich\ApiClient\Models\Product;
use Abobereich\ApiClient\Transformers\PlanTransformer;
use Abobereich\ApiClient\Transformers\Transformer;
use GuzzleHttp\Client;

/**
 * Class Plans
 *
 * @package Abobereich\ApiClient\Contexts
 */
class Plans extends Context
{
    /**
     * the current product id
     *
     * @var int
     */
    private $productId;

    /**
     * sets product
     *
     * @param Product|int $product
     *
     * @return $this
     */
    public function setProduct($product)
    {
        $this->productId = ($product instanceof Product) ? $product->getId() : intval($product);

        return $this;
    }

    /**
     * returns all plans for a product
     *
     * @return \Abobereich\ApiClient\Models\Plan[]|array
     */
    public function all()
    {
        return $this->index('/api/products/' . $this->productId . '/plans', 'plans');
    }

    /**
     * returns a single plan for a product
     *
     * @param int $id
     *
     * @return \Abobereich\ApiClient\Models\Plan
     */
    public function find($id)
    {
        return $this->get('/api/products/' . $this->productId . '/plans/' . $id, 'plan');
    }

    /**
     * returns a transformer
     *
     * @return Transformer|PlanTransformer
     */
    protected function transformer()
    {
        return new PlanTransformer();
    }
}