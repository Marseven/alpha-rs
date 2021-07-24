<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    	return $this->hasMany(Hospitals::class, 'user_id');
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
