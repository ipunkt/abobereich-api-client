<?php

namespace Abobereich\ApiClient\Transformers;

use Abobereich\ApiClient\Models\Model;

/**
 * Class Transformer
 *
 * @package Abobereich\ApiClient\Transformers
 */
abstract class Transformer
{
    /**
     * transforms a collection to an array of object/model
     *
     * @param array $collection
     *
     * @return array
     */
    public function transformCollection(array $collection)
    {
        //  @TODO: maybe with array_map...

        $result = [];
        foreach ($collection as $item) {
            $result[] = $this->transform($item);
        }

        return $result;
    }

    /**
     * transforms an item (array of data) into an object
     *
     * @param array $item
     *
     * @return Model
     */
    abstract public function transform($item);
}