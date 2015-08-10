<?php

namespace Abobereich\ApiClient\Contexts;

use Abobereich\ApiClient\Models\Account;
use Abobereich\ApiClient\Transformers\AccountTransformer;
use Abobereich\ApiClient\Transformers\Transformer;

/**
 * Class Accounts
 *
 * @package Abobereich\ApiClient\Contexts
 */
class Accounts extends Context
{
    /**
     * returns all accounts
     *
     * @return array|Account[]
     */
    public function all()
    {
        return $this->index('/api/accounts', 'accounts');
    }

    /**
     * returns an account by id
     *
     * @param int $id
     *
     * @return Account
     */
    public function find($id)
    {
        return $this->get('/api/accounts/' . $id, 'account');
    }

    /**
     * alias for find
     *
     * @param int $id
     *
     * @return \Abobereich\ApiClient\Models\Account
     */
    public function findById($id)
    {
        return $this->find($id);
    }

    /**
     * find account by attribute
     *
     * @param string $attribute
     * @param string $value
     *
     * @return \Abobereich\ApiClient\Models\Model
     */
    protected function findBy($attribute, $value)
    {
        return $this->get('/api/accounts/0?' . $attribute . '=' . rawurlencode($value), 'account');
    }

    /**
     * find by "external_identifier" on abobereich
     *
     * @param string $identifier
     *
     * @return \Abobereich\ApiClient\Models\Account
     */
    public function findByIdentifier($identifier)
    {
        return $this->findBy('external_identifier', $identifier);
    }

    /**
     * find by "email" on abobereich
     *
     * @param string $email
     *
     * @return \Abobereich\ApiClient\Models\Account
     */
    public function findByEmail($email)
    {
        return $this->findBy('email', $email);
    }

    /**
     * find by "name" on abobereich
     * - we do not recommend using this method to find exact one account
     *
     * @param string $name
     *
     * @return \Abobereich\ApiClient\Models\Account
     */
    public function findByName($name)
    {
        return $this->findBy('name', $name);
    }

    /**
     * stores a new account
     *
     * @param \Abobereich\ApiClient\Models\Account $account
     *
     * @return Account
     */
    public function store(Account $account)
    {
        return $this->create('/api/accounts', $account, 'account');
    }

    /**
     * updates an account
     *
     * @param \Abobereich\ApiClient\Models\Account $account
     *
     * @return Account
     *
     * @throws \InvalidArgumentException when model has no id
     */
    public function update(Account $account)
    {
        if (null === $account->getId()) {
            throw new \InvalidArgumentException('You need an id for updating your model');
        }

        return $this->put('/api/accounts/' . $account->getId(), $account, 'account');
    }

    /**
     * returns a transformer
     *
     * @return Transformer|AccountTransformer
     */
    protected function transformer()
    {
        return new AccountTransformer();
    }
}