<?php

namespace Tests\Feature\Security;

use App\Models\Folder;
use App\Models\Quote;
use App\Models\Service;
use App\Models\User;
use App\Models\Payment;
use App\Models\SecurityObject;
use App\Models\SecurityRole;
use Illuminate\Support\Facades\DB;

/**
 * Helpers to build valid domain rows for security tests.
 *
 * The legacy models ship without factories and most columns are NOT NULL,
 * so we build minimal-but-valid rows by hand. We avoid mass assignment on
 * purpose (the models have no $fillable) by setting attributes directly.
 */
trait CreatesDomainData
{
    protected function makeUser(array $overrides = []): User
    {
        $user = new User();
        $user->name = $overrides['name'] ?? 'Test User';
        $user->email = $overrides['email'] ?? ('user' . uniqid() . '@example.test');
        $user->password = bcrypt($overrides['password'] ?? 'password');
        $user->phone = $overrides['phone'] ?? '074010203';
        if (array_key_exists('security_role_id', $overrides)) {
            $user->security_role_id = $overrides['security_role_id'];
        }
        if (array_key_exists('workflow_role', $overrides)) {
            $user->workflow_role = $overrides['workflow_role'];
        }
        $user->email_verified_at = now();
        $user->save();

        return $user;
    }

    protected function makeDoctor(): User
    {
        return $this->makeUser(['workflow_role' => 'doctor']);
    }

    protected function makeCnamgs(): User
    {
        return $this->makeUser(['workflow_role' => 'cnamgs']);
    }

    protected function makeCase(array $attrs = []): \App\Models\MedicalCaseWorkflow
    {
        return \App\Models\MedicalCaseWorkflow::create(array_merge([
            'patient_name' => 'Jean Dupont',
            'patient_phone' => '077000111',
            'status' => \App\Models\MedicalCaseWorkflow::DRAFT,
        ], $attrs));
    }

    /** Build a user whose role maps to the "admin" security object. */
    protected function makeAdmin(): User
    {
        $object = new SecurityObject();
        $object->name = 'admin';
        $object->url = '/admin';
        $object->icon = 'icon';
        $object->enable = '1';
        $object->save();

        $role = new SecurityRole();
        $role->name = 'Administrateur';
        $role->security_object_id = $object->id;
        $role->save();

        return $this->makeUser(['security_role_id' => $role->id]);
    }

    protected function makeService(): Service
    {
        $service = new Service();
        $service->label = 'Assistance';
        $service->description = 'desc';
        $service->price = '50000';
        $service->picture = 'p.png';
        $service->user_id = '1';
        $service->status = '7';
        $service->save();

        return $service;
    }

    protected function makeQuote(User $owner, ?Service $service = null): Quote
    {
        $service = $service ?: $this->makeService();

        $quote = new Quote();
        $quote->reference = strtoupper(substr(md5(uniqid()), 0, 8));
        $quote->category = 'standard';
        $quote->firstname = 'Jean';
        $quote->lastname = 'Dupont';
        $quote->birthday = '1990-01-01';
        $quote->gender = 'M';
        $quote->email = $owner->email;
        $quote->phone = '074010203';
        $quote->join_piece_passport = 'upload/quote/p.pdf';
        $quote->join_piece_rapport = 'upload/quote/r.pdf';
        $quote->join_piece_exam = 'upload/quote/e.pdf';
        $quote->service_id = $service->id;
        $quote->country_id = 1;
        $quote->user_id = $owner->id;
        $quote->status = 0;
        $quote->folder = false;
        $quote->save();

        return $quote;
    }

    protected function makeFolder(User $owner, ?Service $service = null): Folder
    {
        $service = $service ?: $this->makeService();

        $folder = new Folder();
        $folder->reference = strtoupper(substr(md5(uniqid()), 0, 8));
        $folder->category = 'standard';
        $folder->firstname = 'Jean';
        $folder->lastname = 'Dupont';
        $folder->birthday = '1990-01-01';
        $folder->gender = 'M';
        $folder->email = $owner->email;
        $folder->phone = '074010203';
        $folder->join_piece = 'upload/folder/d.pdf';
        $folder->service_id = $service->id;
        $folder->country_id = 1;
        $folder->user_id = $owner->id;
        $folder->status = 0;
        $folder->save();

        return $folder;
    }

    protected function makePayment(array $attrs): Payment
    {
        $payment = new Payment();
        $payment->customer_id = $attrs['customer_id'] ?? '1';
        $payment->folder_id = $attrs['folder_id'] ?? null;
        $payment->quote_id = $attrs['quote_id'] ?? null;
        $payment->description = $attrs['description'] ?? 'desc';
        $payment->reference = $attrs['reference'];
        $payment->amount = $attrs['amount'] ?? '50000';
        $payment->status = $attrs['status'] ?? 1;
        $payment->time_out = $attrs['time_out'] ?? 30;
        $payment->save();

        return $payment;
    }
}
