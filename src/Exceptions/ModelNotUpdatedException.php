<?php

namespace Abobereich\ApiClient\Exceptions;

use Abobereich\ApiClient\Models\Model;
use Exception;

/**
 * Class ModelNotUpdatedException
 *
 * @package Abobereich\ApiClient\Exceptions
 */
class ModelNotUpdatedException extends RequestNotSuccessfulException
{
    /**
     * model
     *
     * @var \Abobereich\ApiClient\Models\Model
     */
    private $model;

    /**
     * @param \Abobereich\ApiClient\Models\Model $model
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct(Model $model, $message = "", $code = 0, Exception $previous = null)
    {
        $this->model = $model;
        parent::__construct($message, $code, $previous);
    }

    /**
     * returns Model
     *
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }
}