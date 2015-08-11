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
     * alias for find()
     *
     * @param int $id
     *
     * @return \Abobereich\ApiClient\Models\Plan
     */
    public function findById($id)
    {
        return $this->find($id);
    }

    /**
     * find a plan by attribute
     *
     * @param string $attribute
     * @param string $value
     *
     * @return \Abobereich\ApiClient\Models\Plan
     */
    protected function findBy($attribute, $value)
    {
        return $this->get('/api/products/' . $this->productId . '/plans/0?' . $attribute . '=' . rawurlencode($value),
            'plan');
    }

    /**
     * find a plan by slug
     *
     * @param string $slug
     *
     * @return \Abobereich\ApiClient\Models\Plan
     */
    public function findBySlug($slug)
    {
        return $this->findBy('slug', $slug);
    }

    /**
     * find a plan by name
     * - this is not recommended for finding exact one plan
     *
     * @param string $name
     *
     * @return \Abobereich\ApiClient\Models\Plan
     */
    public function findByName($name)
    {
        return $this->findBy('name', $name);
    }

    /**
     * find a plan by "external_identifier"
     *
     * @param string $identifier
     *
     * @return \Abobereich\ApiClient\Models\Plan
     */
    public function findByIdentifier($identifier)
    {
        return $this->findBy('external_identifier', $identifier);
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