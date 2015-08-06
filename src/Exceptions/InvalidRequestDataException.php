<?php

namespace Abobereich\ApiClient\Exceptions;

use Exception;

/**
 * Class InvalidRequestData
 *
 * @package Abobereich\ApiClient\Exceptions
 */
class InvalidRequestDataException extends RequestNotSuccessfulException
{
    /**
     * error bag
     *
     * @var array
     */
    private $errors;

    /**
     * @param array $errors
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct($errors, $message = "", $code = 0, Exception $previous = null)
    {
        $this->errors = $errors;
        parent::__construct($message, $code, $previous);
    }

    /**
     * returns Errors
     *
     * @param null|string $property
     *
     * @return array
     */
    public function getErrors($property = null)
    {
        if (null !== $property && array_key_exists($property, $this->errors)) {
            return $this->errors[$property];
        }

        return $this->errors;
    }
}