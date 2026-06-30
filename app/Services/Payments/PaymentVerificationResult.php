<?php

namespace App\Services\Payments;

/**
 * Normalised outcome of a server-to-server payment inquiry.
 */
class PaymentVerificationResult
{
    public function __construct(
        public bool $successful,
        public float $amount = 0.0,
        public ?string $reference = null,
        public ?string $status = null,
        public ?string $currency = null
    ) {
    }

    public static function paid(float $amount, ?string $reference = null, ?string $currency = 'XAF'): self
    {
        return new self(true, $amount, $reference, 'paid', $currency);
    }

    public static function failed(?string $status = 'unverified', ?string $reference = null): self
    {
        return new self(false, 0.0, $reference, $status);
    }
}
