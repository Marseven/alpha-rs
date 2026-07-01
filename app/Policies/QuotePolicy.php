<?php

namespace App\Policies;

use App\Models\Quote;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuotePolicy
{
    use HandlesAuthorization;

    /**
     * A client may only act on their own quotes.
     */
    public function view(User $user, Quote $quote): bool
    {
        return $this->owns($user, $quote);
    }

    public function pay(User $user, Quote $quote): bool
    {
        return $this->owns($user, $quote);
    }

    public function convert(User $user, Quote $quote): bool
    {
        return $this->owns($user, $quote);
    }

    public function update(User $user, Quote $quote): bool
    {
        return $this->owns($user, $quote);
    }

    private function owns(User $user, Quote $quote): bool
    {
        return (int) $quote->user_id === (int) $user->id;
    }
}
