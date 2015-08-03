<?php

namespace Abobereich\ApiClient\Models;

/**
 * Class Model
 *
 * @package Abobereich\ApiClient\Models
 */
abstract class Model
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
        if ( ! $created_at instanceof \DateTime) {
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
        if ( ! $updated_at instanceof \DateTime) {
            $updated_at = \DateTime::createFromFormat('Y-m-d H:i:s', $updated_at);
        }

        $this->updated_at = $updated_at;
        return $this;
    }
}