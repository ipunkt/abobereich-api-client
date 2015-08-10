<?php

namespace Abobereich\ApiClient\Contexts;

use Abobereich\ApiClient\Transformers\ProductTransformer;
use Abobereich\ApiClient\Transformers\Transformer;

/**
 * Class Products
 *
 * @package Abobereich\ApiClient\Contexts
 */
class Products extends Context
{
    /**
     * returns all products
     *
     * @return \Abobereich\ApiClient\Models\Product[]|array
     */
    public function all()
    {
        return $this->index('/api/products', 'products');
    }

    /**
     * returns a product by id
     *
     * @param int $id
     *
     * @return \Abobereich\ApiClient\Models\Product
     */
    public function find($id)
    {
        return $this->get('/api/products/' . $id, 'product');
    }

    /**
     * returns a product by id
     *
     * @param int $id
     *
     * @return \Abobereich\ApiClient\Models\Product
     */
    public function findById($id)
    {
        return $this->find($id);
    }

    /**
     * find product by attribute
     *
     * @param string $attribute
     * @param string $value
     *
     * @return \Abobereich\ApiClient\Models\Product
     */
    protected function findBy($attribute, $value)
    {
        return $this->get('/api/products/0?' . $attribute . '=' . rawurlencode($value), 'product');
    }

    /**
     * find a product by name
     * - this is not recommended for finding exact one product
     *
     * @param string $name
     *
     * @return \Abobereich\ApiClient\Models\Product
     */
    public function findByName($name)
    {
        return $this->findBy('name', $name);
    }

    /**
     * find a product by slug (recommended)
     *
     * @param string $slug
     *
     * @return \Abobereich\ApiClient\Models\Product
     */
    public function findBySlug($slug)
    {
        return $this->findBy('slug', $slug);
    }

    /**
     * returns a transformer
     *
     * @return Transformer|ProductTransformer
     */
    protected function transformer()
    {
        return new ProductTransformer();
    }
}