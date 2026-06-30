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
    /** Flat fee for a quote (devis), from config (env QUOTE_PAYMENT_AMOUNT). */
    public static function forQuote(Quote $quote): float
    {
        return (float) config('services.payment.quote_amount', 50000);
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
