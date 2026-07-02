<?php

namespace Tests\Feature\Admin;

use App\Models\Service;
use App\Models\Sick;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Security\CreatesDomainData;
use Tests\TestCase;

class AdminCrudValidationTest extends TestCase
{
    use RefreshDatabase, CreatesDomainData;

    public function test_service_create_requires_fields(): void
    {
        $this->actingAs($this->makeAdmin())
            ->from('/admin/list-services')
            ->post('/admin/service', [])
            ->assertSessionHasErrors(['label', 'price', 'status', 'picture']);

        $this->assertSame(0, Service::count());
    }

    public function test_sick_create_requires_fields(): void
    {
        $this->actingAs($this->makeAdmin())
            ->from('/admin/list-sicks')
            ->post('/admin/sick', [])
            ->assertSessionHasErrors(['label', 'status']);

        $this->assertSame(0, Sick::count());
    }

    public function test_hospital_create_rejects_unknown_town(): void
    {
        $this->actingAs($this->makeAdmin())
            ->from('/admin/list-hospitals')
            ->post('/admin/hospital', ['label' => 'CHU', 'town_id' => 999999])
            ->assertSessionHasErrors('town_id');
    }

    public function test_simulator_create_requires_valid_references(): void
    {
        $this->actingAs($this->makeAdmin())
            ->from('/admin/list-simulators')
            ->post('/admin/simulator', ['value' => 'x', 'country_id' => 999999])
            ->assertSessionHasErrors(['country_id', 'service_id', 'sick_id', 'item_id']);
    }
}
