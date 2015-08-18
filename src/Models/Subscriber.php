<?php

namespace Abobereich\ApiClient\Models;

/**
 * Class Subscriber
 *
 * @package Abobereich\ApiClient\Models
 */
class Subscriber extends Model
{
    /**
     * subscriber account id
     *
     * @var int
     */
    protected $account_id;

    /**
     * subscription id
     *
     * @var int
     */
    protected $subscription_id;

    /**
     * returns AccountId
     *
     * @return int
     */
    public function getAccountId()
    {
        return $this->account_id;
    }

    /**
     * sets account
     *
     * @param Account|int $account
     *
     * @return $this
     */
    public function setAccountId($account)
    {
        $this->account_id = ($account instanceof Account) ? $account->getId() : $account;
        return $this;
    }

    /**
     * returns SubscriptionId
     *
     * @return int
     */
    public function getSubscriptionId()
    {
        return $this->subscription_id;
    }

    /**
     * sets subscription
     *
     * @param Subscription|int $subscription
     *
     * @return $this
     */
    public function setSubscriptionId($subscription)
    {
        $this->subscription_id = ($subscription instanceof Subscription) ? $subscription->getId() : $subscription;
        return $this;
    }
}