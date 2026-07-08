<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Town;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Adds Israël as a destination (country + city). Idempotent — safe to re-run.
 * Run: php artisan db:seed --class=IsraelDestinationSeeder
 *
 * The photo is left empty (the homepage shows a placeholder); upload a real
 * image afterwards in Admin → Villes & photos.
 */
class IsraelDestinationSeeder extends Seeder
{
    // STATUT_ENABLE (defined in the base Controller) is not guaranteed to be
    // loaded during seeding, so use its literal value.
    private const STATUS_ENABLED = '7';

    public function run(): void
    {
        $ownerId = User::min('id') ?? 1;

        $country = Country::firstOrCreate(
            ['label' => 'Israël'],
            ['code' => 'IL', 'flag' => '', 'status' => self::STATUS_ENABLED, 'user_id' => $ownerId],
        );

        Town::firstOrCreate(
            ['label' => 'Tel-Aviv'],
            [
                'code' => 'TLV',
                'picture' => '',
                'status' => self::STATUS_ENABLED,
                'country_id' => $country->id,
                'user_id' => $ownerId,
            ],
        );
    }
}
