<?php

namespace Abobereich\ApiClient\Models;

/**
 * Class Plan
 *
 * @package Abobereich\ApiClient\Models
 */
class Plan extends Model
{
    /**
     * product id
     *
     * @var int
     */
    protected $productId;

    /**
     * variant of plan (base plan or sub plan)
     *
     * @var int|null
     */
    protected $variant_of_plan;

    /**
     * slug
     *
     * @var string
     */
    protected $slug;

    /**
     * name
     *
     * @var string
     */
    protected $name;

    /**
     * external identifier
     *
     * @var string
     */
    protected $external_identifier;

    /**
     * subscription subscribers count
     *
     * @var int
     */
    protected $subscription_subscribers_count;

    /**
     * subscription number generation format
     *
     * @var string
     */
    protected $subscription_number_format;

    /**
     * create alignment
     *
     * @var string
     */
    protected $create_alignment;

    /**
     * change policy
     *
     * @var string
     */
    protected $change_policy;

    /**
     * change alignment
     *
     * @var string
     */
    protected $change_alignment;

    /**
     * change policy
     *
     * @var string
     */
    protected $cancel_policy;

    /**
     * end of term policy
     *
     * @var string
     */
    protected $end_of_term_policy;

    /**
     * valid from
     *
     * @var \DateTime
     */
    protected $valid_from;

    /**
     * valid until
     *
     * @var \DateTime|null
     */
    protected $valid_until;

    /**
     * returns ProductId
     *
     * @return int
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * returns VariantOfPlan
     *
     * @return int|null
     */
    public function getVariantOfPlan()
    {
        return $this->variant_of_plan;
    }

    /**
     * returns Slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

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
     * returns ExternalIdentifier
     *
     * @return string
     */
    public function getExternalIdentifier()
    {
        return $this->external_identifier;
    }

    /**
     * returns SubscriptionSubscribersCount
     *
     * @return int
     */
    public function getSubscriptionSubscribersCount()
    {
        return $this->subscription_subscribers_count;
    }

    /**
     * returns SubscriptionNumberFormat
     *
     * @return string
     */
    public function getSubscriptionNumberFormat()
    {
        return $this->subscription_number_format;
    }

    /**
     * returns CreateAlignment
     *
     * @return string
     */
    public function getCreateAlignment()
    {
        return $this->create_alignment;
    }

    /**
     * returns ChangePolicy
     *
     * @return string
     */
    public function getChangePolicy()
    {
        return $this->change_policy;
    }

    /**
     * returns ChangeAlignment
     *
     * @return string
     */
    public function getChangeAlignment()
    {
        return $this->change_alignment;
    }

    /**
     * returns CancelPolicy
     *
     * @return string
     */
    public function getCancelPolicy()
    {
        return $this->cancel_policy;
    }

    /**
     * returns EndOfTermPolicy
     *
     * @return string
     */
    public function getEndOfTermPolicy()
    {
        return $this->end_of_term_policy;
    }

    /**
     * returns ValidFrom
     *
     * @return \DateTime
     */
    public function getValidFrom()
    {
        return $this->valid_from;
    }

    /**
     * returns ValidUntil
     *
     * @return \DateTime|null
     */
    public function getValidUntil()
    {
        return $this->valid_until;
    }

    /**
     * @param int $productId
     *
     * @return Plan
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
        return $this;
    }

    /**
     * @param int|null $variant_of_plan
     *
     * @return Plan
     */
    public function setVariantOfPlan($variant_of_plan)
    {
        $this->variant_of_plan = $variant_of_plan;
        return $this;
    }

    /**
     * @param string $slug
     *
     * @return Plan
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @param string $name
     *
     * @return Plan
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $external_identifier
     *
     * @return Plan
     */
    public function setExternalIdentifier($external_identifier)
    {
        $this->external_identifier = $external_identifier;
        return $this;
    }

    /**
     * @param int $subscription_subscribers_count
     *
     * @return Plan
     */
    public function setSubscriptionSubscribersCount($subscription_subscribers_count)
    {
        $this->subscription_subscribers_count = $subscription_subscribers_count;
        return $this;
    }

    /**
     * @param string $subscription_number_format
     *
     * @return Plan
     */
    public function setSubscriptionNumberFormat($subscription_number_format)
    {
        $this->subscription_number_format = $subscription_number_format;
        return $this;
    }

    /**
     * @param string $create_alignment
     *
     * @return Plan
     */
    public function setCreateAlignment($create_alignment)
    {
        $this->create_alignment = $create_alignment;
        return $this;
    }

    /**
     * @param string $change_policy
     *
     * @return Plan
     */
    public function setChangePolicy($change_policy)
    {
        $this->change_policy = $change_policy;
        return $this;
    }

    /**
     * @param string $change_alignment
     *
     * @return Plan
     */
    public function setChangeAlignment($change_alignment)
    {
        $this->change_alignment = $change_alignment;
        return $this;
    }

    /**
     * @param string $cancel_policy
     *
     * @return Plan
     */
    public function setCancelPolicy($cancel_policy)
    {
        $this->cancel_policy = $cancel_policy;
        return $this;
    }

    /**
     * @param string $end_of_term_policy
     *
     * @return Plan
     */
    public function setEndOfTermPolicy($end_of_term_policy)
    {
        $this->end_of_term_policy = $end_of_term_policy;
        return $this;
    }

    /**
     * @param \DateTime|string $valid_from
     *
     * @return Plan
     */
    public function setValidFrom($valid_from)
    {
        if ( ! $valid_from instanceof \DateTime) {
            $valid_from = \DateTime::createFromFormat('Y-m-d H:i:s', $valid_from);
        }

        $this->valid_from = $valid_from;
        return $this;
    }

    /**
     * @param \DateTime|string|null $valid_until
     *
     * @return Plan
     */
    public function setValidUntil($valid_until)
    {
        if ( ! empty($valid_until)) {
            if ( ! $valid_until instanceof \DateTime) {
                $valid_until = \DateTime::createFromFormat('Y-m-d H:i:s', $valid_until);
            }
        }

        $this->valid_until = $valid_until;
        return $this;
    }
}