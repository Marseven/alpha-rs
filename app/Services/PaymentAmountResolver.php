<?php

namespace App\Services;

use App\Models\Folder;
use App\Models\Quote;

/**
 * Single source of truth for the amount expected for a payment.
 *
 * The legacy code used different magic amounts per gateway (100 vs 50 000 for
 * a quote; service->price vs service->price + folder->price for a dossier),
 * which made the webhook amount-check inconsistent. Both gateways and the
 * webhook verification now resolve the amount here.
 */
class PaymentAmountResolver
{
    /**
     * Fee for a quote (devis) = the price of the chosen service, i.e. the amount
     * shown on the devis page, so the gateway charges exactly what the client
     * sees (consistent with the folder amount, which is also price-based).
     * Previously it returned a flat config fee (QUOTE_PAYMENT_AMOUNT, 50 000),
     * so every devis was billed 50 000 regardless of the displayed amount.
     * Falls back to the configured flat fee only for a quote with no service.
     */
    public static function forQuote(Quote $quote): float
    {
        $quote->loadMissing('service');

        return $quote->service
            ? (float) $quote->service->price
            : (float) config('services.payment.quote_amount', 0);
    }

    /** Dossier amount = service price + dossier-specific price (set by admin). */
    public static function forFolder(Folder $folder): float
    {
        $folder->loadMissing('service');

        return (float) ($folder->service->price ?? 0) + (float) ($folder->price ?? 0);
    }

    /** Resolve by type ('folder' | 'quote'). */
    public static function for(string $type, $entity): float
    {
        return $type === 'folder'
            ? self::forFolder($entity)
            : self::forQuote($entity);
    }
}
