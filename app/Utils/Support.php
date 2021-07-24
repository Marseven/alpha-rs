<?php

namespace App\Utils;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SecurityObjectController;
use App\Http\Controllers\SecurityPermissionController;
use App\Http\Controllers\SecurityRoleController;

class Support
{
    public static function crudResource($name,$controller, $formModal=true){
        Route::get($name, [$controller, 'index']);
        Route::get($name.'/delete/{_id}', [$controller,'delete']);
        Route::get($name.'/set_null', [$controller,'setNull']);
        Route::post($name, $controller.'@save');

        Route::get($name.'/ajax_list', [$controller,'ajaxList']);

        if(!$formModal){
            Route::get($name.'/add', [$controller,'showForm']);
            Route::get($name.'/edit/{_id}', [$controller,'showForm']);
            Route::post($name.'/add', [$controller,'save']);
            Route::post($name.'/edit/{_id}', [$controller,'save']);
        }else{
            Route::get($name.'/edit/{_id}', [$controller,'edit']);
        }
    }
}
