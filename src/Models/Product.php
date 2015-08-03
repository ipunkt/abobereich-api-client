<?php

namespace Abobereich\ApiClient\Models;

/**
 * Class Product
 *
 * @package Abobereich\ApiClient\Models
 */
class Product extends Model
{
    /**
     * default plan for product
     *
     * @var int|null
     */
    protected $defaultPlan;

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

    /**
     * returns DefaultPlan
     *
     * @return int|null
     */
    public function getDefaultPlan()
    {
        return $this->defaultPlan;
    }

    /**
     * sets defaultPlan
     *
     * @param int|null $defaultPlan
     *
     * @return $this
     */
    public function setDefaultPlan($defaultPlan)
    {
        $this->defaultPlan = $defaultPlan;
        return $this;
    }
}