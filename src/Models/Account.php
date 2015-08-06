<?php

namespace Abobereich\ApiClient\Models;

/**
 * Class Accounts
 *
 * @package Abobereich\ApiClient\Models
 */
class Account extends Model
{
    /**
     * name
     *
     * @var string
     */
    protected $name;

    /**
     * email
     *
     * @var string
     */
    protected $email;

    /**
     * currency
     *
     * @var string
     */
    protected $currency;

    /**
     * billing cycle day
     *
     * @var int
     */
    protected $billing_cycle_day;

    /**
     * external identifier
     *
     * @var string
     */
    protected $external_identifier;

    /**
     * additional account data (key-value-store)
     *
     * @var array
     */
    protected $data;

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
     * returns Email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * returns Currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * returns BillingCycleDay
     *
     * @return int
     */
    public function getBillingCycleDay()
    {
        return $this->billing_cycle_day;
    }

    /**
     * returns ExternalIdentifier
     *
     * @return string
     */
    public function getExternalIdentifier()
    {
        return $this->external_identifier;
    }

    /**
     * returns Data (complete, or defined by key)
     *
     * @param null|string $key
     *
     * @return array|mixed
     */
    public function getData($key = null)
    {
        if (null !== $key && array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }

        return $this->data;
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
     * sets email
     *
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * sets currency
     *
     * @param string $currency
     *
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * sets billing_cycle_day
     *
     * @param int $billing_cycle_day
     *
     * @return $this
     */
    public function setBillingCycleDay($billing_cycle_day)
    {
        $this->billing_cycle_day = $billing_cycle_day;
        return $this;
    }

    /**
     * sets external_identifier
     *
     * @param string $external_identifier
     *
     * @return $this
     */
    public function setExternalIdentifier($external_identifier)
    {
        $this->external_identifier = $external_identifier;
        return $this;
    }

    /**
     * sets data (complete, or as key value)
     *
     * @param array|string $data
     * @param null|mixed $value
     *
     * @return $this
     */
    public function setData($data, $value = null)
    {
        if (is_array($data) && null === $value) {
            $this->data = $data;
        } else {
            $this->data[$data] = $value;
        }

        return $this;
    }
}