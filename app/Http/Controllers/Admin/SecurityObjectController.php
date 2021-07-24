<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SecurityObject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SecurityObjectController extends GenericController
{
    public function __construct()
    {
        $this->setModel(new SecurityObject());
    }

    public function index(){
        Controller::he_can('Users', 'look');
        $objects = SecurityObject::all();
        return view('admin.security-object.index', [
            'objects' => $objects,
        ]);
    }


    public function save(Request $request)
    {
        Controller::he_can('Users', 'creat');

        $object =  new SecurityObject();

        if( $request->get('_id')!= 0 ) $object = SecurityObject::find($request->get('_id'));
        $object->name = $request->get('name');
        $object->url = $request->get('url');
        $object->icon = $request->get('icon');
        $object->enable = $request->get('enable');
        $object->user_id = Auth::user()->id;
        $object->save();

        return redirect()->back()->with('success','Operation performed successfully');
    }
}
