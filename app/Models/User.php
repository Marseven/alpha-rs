<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'workflow_role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->belongsTo(SecurityRole::class,'security_role_id');
    }

    /** True when the user's security role maps to the "admin" space. */
    public function isPlatformAdmin(): bool
    {
        if ($this->workflow_role === 'admin') {
            return true;
        }
        if (! $this->security_role_id) {
            return false;
        }
        $role = SecurityRole::find($this->security_role_id);
        $object = $role ? SecurityObject::find($role->security_object_id) : null;

        return $object && strtolower((string) $object->name) === 'admin';
    }

    // --- Medical workflow role helpers (uses the workflow_role column) ---
    public function isDoctor(): bool
    {
        return $this->workflow_role === 'doctor';
    }

    public function isPharmacy(): bool
    {
        return $this->workflow_role === 'pharmacy';
    }

    public function doctorCases()
    {
        return $this->hasMany(MedicalCaseWorkflow::class, 'doctor_id');
    }

    public function pharmacyCases()
    {
        return $this->hasMany(MedicalCaseWorkflow::class, 'pharmacy_id');
    }

    public function payments()
    {
    	return $this->hasMany(Payment::class, 'customer_id');
    }

    public function services()
    {
    	return $this->hasMany(Service::class, 'user_id');
    }

    public function hospitals()
    {
    	return $this->hasMany(Hospital::class, 'user_id');
    }

    public function folders()
    {
    	return $this->hasMany(Folder::class, 'user_id');
    }

    public function quotes()
    {
    	return $this->hasMany(Quote::class, 'user_id');
    }

    public function sicks()
    {
    	return $this->hasMany(Sick::class, 'user_id');
    }

    public function towns()
    {
    	return $this->hasMany(Town::class, 'user_id');
    }
}
