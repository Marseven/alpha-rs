<?php

namespace App\Mail;

use App\Models\Quote;
use App\Services\SensitiveFileStorage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Sent to the client once their quote has been processed ("Traité"): it
 * delivers the actual devis document as an attachment (plus the team's reply
 * and a link to pay online), rather than the generic status-change ping.
 *
 * Not ShouldQueue: like every other mailable here it is dispatched inline via
 * the sync mail connection (no queue worker is run), so it must send in-request.
 */
class QuoteReadyMessage extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Quote $quote)
    {
    }

    public function build()
    {
        $reference = $this->quote->reference ?: $this->quote->id;

        // Attach the devis document itself (private or legacy path). Resolved at
        // send time; if the file cannot be located the mail still goes out, but
        // the template copy adapts (see $attached) so we never promise a file
        // that isn't there.
        $attached = false;
        if ($absolute = SensitiveFileStorage::absolutePath($this->quote->devis)) {
            $extension = pathinfo($this->quote->devis, PATHINFO_EXTENSION) ?: 'pdf';
            $this->attach($absolute, ['as' => 'Devis-' . $reference . '.' . $extension]);
            $attached = true;
        }

        return $this->from('contact@reliefservices.net')
            ->subject('Votre devis est prêt — ' . $reference)
            ->markdown('quote.mail-ready')
            ->with([
                'fullname'  => trim($this->quote->firstname . ' ' . $this->quote->lastname),
                'reference' => $reference,
                'response'  => $this->quote->response,
                'service'   => $this->quote->service->label ?? null,
                'url'       => url('/list-quotes'),
                'attached'  => $attached,
            ]);
    }
}
