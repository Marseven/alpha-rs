<?php

namespace App\Services;

use App\Mail\QuoteAdminMessage;
use App\Mail\QuoteMessage;
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

    /** Notify the quote owner that its status changed. */
    public function notifyStatusChanged(Quote $quote): void
    {
        try {
            Mail::to($quote->user->email)->queue(new StatusMessage($quote, 'quote'));
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
