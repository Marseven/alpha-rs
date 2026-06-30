<?php

namespace App\Services\Payments;

/**
 * A PSP that can confirm a transaction status out-of-band (server-to-server),
 * so we never trust the webhook payload alone.
 */
interface PaymentProviderInterface
{
    /**
     * Verify a transaction by its reference. Implementations MUST fail closed
     * (return a non-successful result) when they cannot positively confirm
     * the payment.
     */
    public function verify(string $reference): PaymentVerificationResult;
}
