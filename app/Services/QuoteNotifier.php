<?php

namespace App\Services;

use App\Mail\QuoteAdminMessage;
use App\Mail\QuoteMessage;
use App\Mail\QuoteReadyMessage;
use App\Mail\StatusMessage;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Centralises the quote notification fan-out that was duplicated three times in
 * QuoteController (both create() branches + updateState()).
 *
 * Pure side-effect: it never influences the caller's control flow. A mail
 * transport failure is logged (the controller used to echo it straight into
 * the HTTP response), so the request is never corrupted by a broken mailer.
 */
class QuoteNotifier
{
    /** Notify the client + the admin audience that a quote was submitted. */
    public function notifyCreated(Quote $quote): void
    {
        try {
            Mail::to($quote->user->email)->queue(new QuoteMessage($quote));
            Mail::to('reliefservices21@gmail.com')->queue(new QuoteAdminMessage($quote));
            foreach ($this->admins() as $admin) {
                Mail::to($admin->email)->queue(new QuoteAdminMessage($quote));
            }
        } catch (\Throwable $e) {
            Log::warning('Quote creation notification failed: ' . $e->getMessage());
        }
    }

    /**
     * Notify the quote owner that its status changed. When the quote has been
     * processed ("Traité") and a devis document is attached, the client
     * receives the devis itself; otherwise a plain status-change notice.
     */
    public function notifyStatusChanged(Quote $quote): void
    {
        try {
            // Prefer the account e-mail; fall back to the quote's own e-mail
            // (guest/legacy rows without a linked user).
            $recipient = $quote->user->email ?? $quote->email;
            if (empty($recipient)) {
                Log::warning('Quote status notification skipped: no recipient for quote ' . $quote->id);

                return;
            }

            // STATUT_DO ("Traité") is a global define() from the base Controller;
            // guard for contexts where that file is not autoloaded (unit tests).
            $processed = defined('STATUT_DO') ? STATUT_DO : 6;

            if ((int) $quote->status === (int) $processed && ! empty($quote->devis)) {
                Mail::to($recipient)->queue(new QuoteReadyMessage($quote));
            } else {
                Mail::to($recipient)->queue(new StatusMessage($quote, 'quote'));
            }
        } catch (\Throwable $e) {
            Log::warning('Quote status notification failed: ' . $e->getMessage());
        }
    }

    /** Back-office recipients: users whose security role is an admin tier (id <= 2). */
    private function admins()
    {
        return User::where('security_role_id', '<=', 2)->get();
    }
}
