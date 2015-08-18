<?php

namespace Abobereich\ApiClient\Contexts;

use Abobereich\ApiClient\Models\Subscriber;
use Abobereich\ApiClient\Models\Subscription;
use Abobereich\ApiClient\Transformers\SubscriberTransformer;
use Abobereich\ApiClient\Transformers\Transformer;

/**
 * Class Subscribers
 *
 * @package Abobereich\ApiClient\Contexts
 */
class Subscribers extends Context
{
    /**
     * the current subscription id
     *
     * @var int
     */
    private $subscriptionId;

    /**
     * sets product
     *
     * @param Subscription|int $subscription
     *
     * @return $this
     */
    public function setSubscription($subscription)
    {
        $this->subscriptionId = ($subscription instanceof Subscription) ? $subscription->getId() : intval($subscription);

        return $this;
    }

    /**
     * returns all subscribers for a subscription
     *
     * @return \Abobereich\ApiClient\Models\Subscriber[]|array
     */
    public function all()
    {
        return $this->index('/api/subscriptions/' . $this->subscriptionId . '/subscribers', 'subscribers');
    }

    /**
     * returns a single subscriber for a subscription
     *
     * @param int $id
     *
     * @return \Abobereich\ApiClient\Models\Subscriber
     */
    public function find($id)
    {
        return $this->get('/api/subscriptions/' . $this->subscriptionId . '/subscribers/' . $id, 'subscriber');
    }

    /**
     * alias for find()
     *
     * @param int $id
     *
     * @return \Abobereich\ApiClient\Models\Subscriber
     */
    public function findById($id)
    {
        return $this->find($id);
    }

    /**
     * stores a new subscriber
     *
     * @param \Abobereich\ApiClient\Models\Subscriber $subscriber
     *
     * @return \Abobereich\ApiClient\Models\Subscriber
     */
    public function store(Subscriber $subscriber)
    {
        return $this->post('/api/subscriptions/' . $this->subscriptionId . '/subscribers', $subscriber, 'subscriber');
    }

    /**
     * returns a transformer
     *
     * @return Transformer|SubscriberTransformer
     */
    protected function transformer()
    {
        return new SubscriberTransformer();
    }
}