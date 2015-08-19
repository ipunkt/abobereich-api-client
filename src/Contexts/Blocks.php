<?php

namespace Abobereich\ApiClient\Contexts;

use Abobereich\ApiClient\Models\Product;

/**
 * Class Blocks
 *
 * @package Abobereich\ApiClient\Contexts
 */
class Blocks extends Context
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
     * returns all blocks for a product
     *
     * @return array
     */
    public function all()
    {
        return $this->index('/api/products/' . $this->productId . '/blocks', null);
    }

    /**
     * returns all blocks for a product and language(s)
     *
     * @param string|array $language
     *
     * @return array
     */
    public function allWithLanguage($language)
    {
        $language = array_map('rawurlencode', (array)$language);
        $query = 'language[]=' . implode('&language[]=', $language);

        return $this->index('/api/products/' . $this->productId . '/blocks?' . $query, null);
    }

    /**
     * returns a transformer
     *
     * @return null
     */
    protected function transformer()
    {
        return null;
    }
}