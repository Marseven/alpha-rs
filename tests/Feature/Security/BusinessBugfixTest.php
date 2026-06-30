<?php

namespace Tests\Feature\Security;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Hospital;
use App\Models\Sick;
use App\Models\Town;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

/**
 * Regression tests for the confirmed secondary business bugs.
 */
class BusinessBugfixTest extends TestCase
{
    use RefreshDatabase, CreatesDomainData;

    public function test_country_has_many_towns_via_country_id(): void
    {
        $country = new Country();
        $country->label = 'Gabon';
        $country->code = 'GA';
        $country->flag = 'ga.png';
        $country->status = '7';
        $country->user_id = 1;
        $country->save();

        $town = new Town();
        $town->label = 'Libreville';
        $town->code = 'LBV';
        $town->picture = 'lbv.png';
        $town->status = '7';
        $town->country_id = $country->id;
        $town->user_id = 1;
        $town->save();

        $this->assertTrue($country->towns->contains($town));
    }

    public function test_user_has_many_hospitals(): void
    {
        $user = $this->makeUser();

        $hospital = new Hospital();
        $hospital->label = 'CHU';
        $hospital->description = 'desc';
        $hospital->country_id = '1';
        $hospital->town_id = '1';
        $hospital->picture_1 = 'a.png';
        $hospital->picture_2 = 'b.png';
        $hospital->status = '7';
        $hospital->user_id = $user->id;
        $hospital->save();

        // Previously referenced a non-existent "Hospitals" class and threw.
        $this->assertCount(1, $user->hospitals);
    }

    public function test_delais_hour_returns_whole_hours_elapsed(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-01-01 12:00:00'));

        $this->assertSame(3, Controller::delais_hour('2026-01-01 09:00:00'));
        $this->assertSame(0, Controller::delais_hour('2026-01-01 11:30:00'));

        Carbon::setTestNow();
    }

    public function test_assigning_sicks_to_hospital_does_not_create_duplicates(): void
    {
        $admin = $this->makeAdmin();

        $hospital = new Hospital();
        $hospital->label = 'CHU';
        $hospital->description = 'desc';
        $hospital->country_id = '1';
        $hospital->town_id = '1';
        $hospital->picture_1 = 'a.png';
        $hospital->picture_2 = 'b.png';
        $hospital->status = '7';
        $hospital->user_id = $admin->id;
        $hospital->save();

        $sick = new Sick();
        $sick->label = 'Malaria';
        $sick->description = 'desc';
        $sick->status = '7';
        $sick->user_id = $admin->id;
        $sick->save();

        // Submit the same checkbox twice — must not duplicate the pivot row.
        $payload = ['hospital' => $hospital->id, 'sick-' . $sick->id => 'on'];
        $this->actingAs($admin)->post('/admin/hospital-sick/' . $hospital->id, $payload);
        $this->actingAs($admin)->post('/admin/hospital-sick/' . $hospital->id, $payload);

        $this->assertEquals(1, $hospital->sicks()->count());
    }
}
