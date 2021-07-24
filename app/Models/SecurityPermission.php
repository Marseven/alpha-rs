<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class SecurityPermission extends GenericModel
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
    protected $label = 'Permissions';
    protected $sub_label = 'List of Permissions';
    protected $fields = [
        'name'=>'Name',
        'description'=>'Description',
    ];

    protected $formRedirect = 'security-permission';

    protected $orderBys = ['id'=>'asc'];
    protected $selects = [
        'name'=>[
            self::View=> self::View, self::Create=>self::Create,self::Edit=>self::Edit,
            self::Delete=>self::Delete, self::Cancel=>self::Cancel,
            self::Duplicate=>self::Duplicate, self::Print=>self::Print
        ]
    ];
    protected $actions = ['edit','add','delete'];
    protected $formRequireds = ['name'];

    public static function validate($request){
        $rules = [
            'name' => 'required',
        ];
        $messages = [
            'name.required' => "Name is required.",
            'name.unique' => "This name already exists.",
        ];
        return Validator::make($request->input(),$rules,$messages);
    }
}
