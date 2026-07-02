<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class SecurityObject extends Model
{
    use HasFactory;

    protected $table = 'security_objects';
    protected $primaryKey = 'id';

    public function SecurityRoles()
    {
        return $this->hasMany(SecurityRole::class, 'security_object_id');
    }

    public static function validate($request)
    {
        $rules = [
            'name' => 'required',
        ];
        $messages = [
            'name.required' => "Name is required.",
        ];

        return Validator::make($request->input(), $rules, $messages);
    }
}
