<?php

namespace Abobereich\ApiClient\Models;

use JsonSerializable;
use ReflectionClass;
use ReflectionProperty;

/**
 * Class Model
 *
 * @package Abobereich\ApiClient\Models
 */
abstract class Model implements JsonSerializable
{
    /**
     * id
     *
     * @var int
     */
    protected $id;

    /**
     * created at
     *
     * @var \DateTime
     */
    protected $created_at;

    /**
     * updated at
     *
     * @var \DateTime
     */
    protected $updated_at;

    /**
     * does the model exists on server
     *
     * @var bool
     */
    private $exists;

    /**
     * @param bool $exists
     */
    public function __construct($exists = false)
    {
        $this->exists = $exists;
    }

    /**
     * returns the exists flag
     *
     * @return bool
     */
    public function exists()
    {
        return $this->exists;
    }

    /**
     * returns Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * returns CreatedAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * returns UpdatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * sets id
     *
     * @param int $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * sets created_at
     *
     * @param \DateTime|string $created_at
     *
     * @return $this
     */
    public function setCreatedAt($created_at)
    {
        if (null !== $created_at &&  ! $created_at instanceof \DateTime) {
            $created_at = \DateTime::createFromFormat('Y-m-d H:i:s', $created_at);
        }

        $this->created_at = $created_at;
        return $this;
    }

    /**
     * sets updated_at
     *
     * @param \DateTime|string $updated_at
     *
     * @return $this
     */
    public function setUpdatedAt($updated_at)
    {
        if (null !== $updated_at && ! $updated_at instanceof \DateTime) {
            $updated_at = \DateTime::createFromFormat('Y-m-d H:i:s', $updated_at);
        }

        $this->updated_at = $updated_at;
        return $this;
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     *
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        $reflect = new ReflectionClass($this);
        $props = $reflect->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED);

        $result = [];

        foreach ($props as $prop) {
            $isProtected = $prop->isProtected();
            if ($isProtected) {
                $prop->setAccessible(true);
            }

            $value = $prop->getValue($this);
            if (null !== $value) {
                if ($value instanceof \DateTime) {
                    $value = $value->format('Y-m-d H:i:s');
                }

                $result[$prop->getName()] = $value;
            }

            if ($isProtected) {
                $prop->setAccessible(false);
            }
        }

        return $result;
    }
}