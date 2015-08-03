<?php

namespace Abobereich\ApiClient\Models;

/**
 * Class Tenant
 *
 * @package Abobereich\ApiClient\Models
 */
class Tenant extends Model
{
    /**
     * name
     *
     * @var string
     */
    protected $name;

    /**
     * returns Name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * sets name
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}