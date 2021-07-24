<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class SecurityRole extends GenericModel
{
    use HasFactory;

    protected $table = 'security_roles';
    protected $primaryKey = 'id';
    protected $label = 'User Roles';
    protected $sub_label = 'User Roles';
    protected $fields = [
        'name'=>'Name',
        'security_object_id'=>'Security Object'
    ];

    protected $orderBys = ['id'=>'asc'];
    protected $actions = ['edit','add'];
    protected $formRequireds = ['name'];
    protected $view_form = 'security-roles.add';

    protected $formRedirect = 'security-role';

    public function permissions(){
        return $this->belongsToMany(SecurityPermission::class,'security_role_permission','security_role_id','security_permission_id');
    }

    public function user(){
        return $this->hasMany(User::class,'security_role_id');
    }

    public function objects(){
        return $this->hasMany(SecurityObject::class,'id');
    }

    public static function validate($request){
        $rules = [
            'name' => 'required|unique:security_roles,name,'.$request->get('_id'),
        ];
        $messages = [
            'name.required' => "Name is required.",
            'name.unique' => "This name already exists.",
        ];
        return Validator::make($request->input(),$rules,$messages);
    }
}
