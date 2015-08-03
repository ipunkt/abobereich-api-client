<?php

namespace Abobereich\ApiClient\Contexts;

use Abobereich\ApiClient\Models\Tenant;
use Abobereich\ApiClient\Transformers\TenantTransformer;
use Abobereich\ApiClient\Transformers\Transformer;

/**
 * Class Tenants
 *
 * @package Abobereich\ApiClient\Contexts
 */
class Tenants extends Context
{
    /**
     * returns your own tenant
     *
     * @return Tenant
     */
    public function me()
    {
        return $this->get('/api/me', 'tenant');
    }

    /**
     * returns a transformer
     *
     * @return Transformer|TenantTransformer
     */
    protected function transformer()
    {
        return new TenantTransformer();
    }
}