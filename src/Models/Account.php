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
}