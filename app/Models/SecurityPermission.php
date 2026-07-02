<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class SecurityPermission extends Model
{
    use HasFactory;

    public const View = 'View';
    public const Create = 'Create';
    public const Edit = 'Edit';
    public const Delete = 'Delete';
    public const Cancel = 'Cancel';
    public const Duplicate = 'Duplicate';
    public const Print = 'Print';

    protected $table = 'security_permissions';
    protected $primaryKey = 'id';

    public static function validate($request)
    {
        $rules = [
            'name' => 'required',
        ];
        $messages = [
            'name.required' => "Name is required.",
            'name.unique' => "This name already exists.",
        ];

        return Validator::make($request->input(), $rules, $messages);
    }
}
