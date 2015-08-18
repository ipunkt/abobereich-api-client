<?php

namespace Abobereich\ApiClient\Models;

/**
 * Class Subscription
 *
 * @package Abobereich\ApiClient\Models
 */
class Subscription extends Model
{
    /**
     * plan for subscription
     *
     * @var int|null
     */
    protected $plan_id;

    /**
     * phase the subscription is in
     *
     * @var int|null
     */
    protected $current_phase;

    /**
     * subscription number
     *
     * @var string
     */
    protected $subscription_number;

    /**
     * contractor
     *
     * @var int|null
     */
    protected $account_id;

    /**
     * external identifier for subscription
     *
     * @var string|null
     */
    protected $external_identifier;

    /**
     * starting date for the subscription
     *
     * @var \DateTime
     */
    protected $start_date;

    /**
     * next billing date for the subscription
     *
     * @var \DateTime
     */
    protected $next_billing_date;

    /**
     * subscription is charged through
     *
     * @var \DateTime|null
     */
    protected $charged_through_date;

    /**
     * subscription ends at
     *
     * @var \DateTime|null
     */
    protected $end_of_term;

    /**
     * returns PlanId
     *
     * @return int|null
     */
    public function getPlanId()
    {
        return $this->plan_id;
    }

    /**
     * sets plan_id
     *
     * @param Plan|int|null $plan
     *
     * @return $this
     */
    public function setPlanId($plan)
    {
        $this->plan_id = ($plan instanceof Plan) ? $plan->getId() : $plan;
        return $this;
    }

    /**
     * returns PhaseId
     *
     * @return int|null
     */
    public function getCurrentPhase()
    {
        return $this->current_phase;
    }

    /**
     * sets phase_id
     *
     * @param int|null $current_phase
     *
     * @return $this
     */
    public function setCurrentPhase($current_phase)
    {
        $this->current_phase = $current_phase;
        return $this;
    }

    /**
     * returns SubscriptionNumber
     *
     * @return string
     */
    public function getSubscriptionNumber()
    {
        return $this->subscription_number;
    }

    /**
     * sets subscription_number
     *
     * @param string $subscription_number
     *
     * @return $this
     */
    public function setSubscriptionNumber($subscription_number)
    {
        $this->subscription_number = $subscription_number;
        return $this;
    }

    /**
     * returns AccountId
     *
     * @return int|null
     */
    public function getAccountId()
    {
        return $this->account_id;
    }

    /**
     * sets account_id
     *
     * @param Account|int|null $account
     *
     * @return $this
     */
    public function setAccountId($account)
    {
        $this->account_id = ($account instanceof Account) ? $account->getId() : $account;
        return $this;
    }

    /**
     * returns ExternalIdentifier
     *
     * @return null|string
     */
    public function getExternalIdentifier()
    {
        return $this->external_identifier;
    }

    /**
     * sets external_identifier
     *
     * @param null|string $external_identifier
     *
     * @return $this
     */
    public function setExternalIdentifier($external_identifier)
    {
        $this->external_identifier = $external_identifier;
        return $this;
    }

    /**
     * returns StartDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * sets start_date
     *
     * @param \DateTime|string $start_date
     *
     * @return $this
     */
    public function setStartDate($start_date)
    {
        if (null !== $start_date && ! $start_date instanceof \DateTime) {
            $start_date = \DateTime::createFromFormat('Y-m-d H:i:s', $start_date);
        }

        $this->start_date = $start_date;
        return $this;
    }

    /**
     * returns next_billing_date
     *
     * @return \DateTime
     */
    public function getNextBillingDate()
    {
        return $this->start_date;
    }

    /**
     * sets next_billing_date
     *
     * @param \DateTime|string $next_billing_date
     *
     * @return $this
     */
    public function setNextBillingDate($next_billing_date)
    {
        if (null !== $next_billing_date && ! $next_billing_date instanceof \DateTime) {
            $next_billing_date = \DateTime::createFromFormat('Y-m-d H:i:s', $next_billing_date);
        }

        $this->next_billing_date = $next_billing_date;
        return $this;
    }

    /**
     * returns ChargedThroughDate
     *
     * @return \DateTime|null
     */
    public function getChargedThroughDate()
    {
        return $this->charged_through_date;
    }

    /**
     * sets charged_through_date
     *
     * @param \DateTime|string|null $charged_through_date
     *
     * @return $this
     */
    public function setChargedThroughDate($charged_through_date)
    {
        if (empty ($charged_through_date)) {
            $charged_through_date = null;
        }

        if (null !== $charged_through_date && ! $charged_through_date instanceof \DateTime) {
            $charged_through_date = \DateTime::createFromFormat('Y-m-d H:i:s', $charged_through_date);
        }

        $this->charged_through_date = $charged_through_date;
        return $this;
    }

    /**
     * returns EndOfTerm
     *
     * @return \DateTime|null
     */
    public function getEndOfTerm()
    {
        return $this->end_of_term;
    }

    /**
     * sets end_of_term
     *
     * @param \DateTime|string|null $end_of_term
     *
     * @return $this
     */
    public function setEndOfTerm($end_of_term)
    {
        if (empty ($end_of_term)) {
            $end_of_term = null;
        }

        if (null !== $end_of_term && ! $end_of_term instanceof \DateTime) {
            $end_of_term = \DateTime::createFromFormat('Y-m-d H:i:s', $end_of_term);
        }

        $this->end_of_term = $end_of_term;
        return $this;
    }
}