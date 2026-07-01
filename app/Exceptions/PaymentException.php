<?php

namespace App\Exceptions;

use RuntimeException;

/**
 * Raised when a payment gateway interaction fails. Carries optional context
 * for structured logging.
 */
class PaymentException extends RuntimeException
{
    public array $context;

    public function __construct(string $message, array $context = [])
    {
        parent::__construct($message);
        $this->context = $context;
    }
}
