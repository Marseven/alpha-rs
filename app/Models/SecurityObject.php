<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class SecurityObject extends GenericModel
{
    use HasFactory;
    protected $table = 'security_objects';
    protected $primaryKey = 'id';
    protected $label = 'Security Object';
    protected $sub_label = 'Security Object';
    protected $fields = [
        'name'=>'Name',
        'url'=>'Url',
        'icon'=>'Icon class',
        'enable'=>'Enable',
    ];

    protected $formRedirect = 'security-object';
    protected $orderBys = ['sequence'=>'asc'];

    protected $selects = [
        'enable'=>[1=>'Yes',0=>'No']
    ];
    protected $actions = ['edit','add','delete'];
    protected $formRequireds = ['name'];

    protected $columns_hiddens = ['url','icon'];


    public function SecurityRoles(){
        return $this->hasMany(SecurityRole::class,'security_object_id');
    }

    public static function validate($request){
        $rules = [
            'name' => 'required',
        ];
        $messages = [
            'name.required' => "Name is required."
        ];
        return Validator::make($request->input(),$rules,$messages);
    }
}
