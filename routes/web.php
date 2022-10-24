<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\SecurityObjectController;
use App\Http\Controllers\Admin\SecurityPermissionController;
use App\Http\Controllers\Admin\SecurityRoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminUserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\SickController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SimulatorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// visitor or prospect

//home
Route::get('/', [WelcomeController::class, 'index'])->name('home');
Route::get('/faq', [WelcomeController::class, 'faq'])->name('faq');
Route::get('/pc', [WelcomeController::class, 'pc'])->name('pc');
Route::get('/cgu', [WelcomeController::class, 'faq'])->name('cgu');

//form contact classic
Route::post('/contact', [WelcomeController::class, 'contact'])->name('contact');
Route::post('/search', [WelcomeController::class, 'search'])->name('search');

//
Route::get('/quote', [QuoteController::class, 'add'])->name('quote');
Route::get('/quote/{type}/{id}', [QuoteController::class, 'add']);
Route::post('/quote', [QuoteController::class, 'create']);
Route::get('/quote-pay/{quote}', [QuoteController::class, 'pay']);

//hospital
Route::get('/list-hospitals', [HospitalController::class, 'index'])->name('list-hospitals');

//ebilling
Route::get('/callback-ebilling/{type}/{entity}', [PaymentController::class, 'callback_ebilling'])->name('ebilling-payment');
Route::post('/notify/ebilling', [PaymentController::class, 'notify_ebilling'])->name('notify-ebilling-payments');

//singpay
Route::get('/callback-singpay/{type}/{entity}/{payment}', [PaymentController::class, 'callback_singpay'])->name('singpay');
Route::post('/notify/singpay', [PaymentController::class, 'notify_singpay'])->name('notify-singpay');


//simulator
Route::get('/simulator', [SimulatorController::class, 'index'])->name('simulator');
Route::post('/simulate', [SimulatorController::class, 'search'])->name('simulate');



Auth::routes();

Route::get('logout', [LoginController::class, 'logout']);
Route::post('login', [LoginController::class, 'authenticate']);
Route::get('503', function () {
    return 'Accès non autorisé';
});
Route::get('404', function () {
    return 'Page non trouvée';
});

// users connect

Route::middleware('auth')->group(function () {

    //cards
    Route::get('/list-services', [ServiceController::class, 'index'])->name('list-services');

    //requests_card
    Route::get('/folder', [FolderController::class, 'add'])->name('folder');
    Route::post('/folder', [FolderController::class, 'create']);
    Route::get('/list-folder', [FolderController::class, 'index'])->name('list-folder');
    Route::post('/folder/quote/{quote}', [FolderController::class, 'quote']);
    Route::post('/folder/pay/{folder}', [FolderController::class, 'pay']);

    //query
    Route::get('/list-quotes', [QuoteController::class, 'index'])->name('list-quotes');
    Route::post('/folder', [FolderController::class, 'create']);

    //payment
    Route::get('/list-payments', [PaymentController::class, 'payments'])->name('payments');

    //user
    Route::get('/profil', [UserController::class, 'profil'])->name('profil');
    Route::get('/user/{user}', [UserController::class, 'edit']);
    Route::post('/user/{user}', [UserController::class, 'update']);
    Route::get('/userpassword/{user}', [UserController::class, 'editPassword']);
    Route::post('/userpassword/{user}', [UserController::class, 'updatePassword']);
});


/*
| Backend
*/
Route::prefix('admin')->namespace('Admin')->middleware('admin')->group(function () {

    Route::get('security-role', [SecurityRoleController::class, 'index']);
    Route::get('security-role/delete/{_id}', [SecurityRoleController::class, 'delete']);
    Route::post('security-role', [SecurityRoleController::class, 'save']);
    Route::get('security-role/edit/{_id}', [SecurityRoleController::class, 'edit']);

    Route::get('security-object', [SecurityObjectController::class, 'index']);
    Route::get('security-object/delete/{_id}', [SecurityObjectController::class, 'delete']);
    Route::post('security-object', [SecurityObjectController::class, 'save']);
    Route::get('security-object/edit/{_id}', [SecurityObjectController::class, 'edit']);

    Route::get('security-permission', [SecurityPermissionController::class, 'index']);
    Route::get('security-permission/delete/{_id}', [SecurityPermissionController::class, 'delete']);
    Route::post('security-permission', [SecurityPermissionController::class, 'save']);
    Route::post('security-permission/edit/{_id}', [SecurityRoleController::class, 'permission']);


    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin-dashboard');

    //Services
    Route::get('/list-services', [AdminController::class, 'listServices'])->name('admin-list-services');
    Route::post('/service', [ServiceController::class, 'create']);
    Route::post('/service/{service}', [ServiceController::class, 'update']);

    //simulators
    Route::get('/list-simulators', [AdminController::class, 'listSimulators'])->name('admin-list-simulators');
    Route::post('/simulator', [SimulatorController::class, 'create']);
    Route::post('/simulator/{simulator}', [SimulatorController::class, 'update']);

    Route::get('/list-simulators-items', [SimulatorController::class, 'items'])->name('admin-list-items');
    Route::post('/simulator-item', [SimulatorController::class, 'create_item']);
    Route::post('/simulator-item/{simulator}', [SimulatorController::class, 'update_item']);

    //sicks
    Route::get('/list-sicks', [AdminController::class, 'listSicks'])->name('admin-list-sicks');
    Route::post('/sick', [SickController::class, 'create']);
    Route::post('/sick/{sick}', [SickController::class, 'update']);

    //hospital
    Route::post('/hospital', [HospitalController::class, 'create']);
    Route::get('/list-hospitals', [AdminController::class, 'listHospitals'])->name('admin-list-hospitals');
    Route::post('/hospital/{hospital}', [HospitalController::class, 'update']);
    Route::post('/hospital-sick/{hospital}', [HospitalController::class, 'sick']);

    //folder
    Route::get('/list-folders', [AdminController::class, 'listFolders'])->name('admin-list-folders');
    Route::post('/folder/{folder}', [FolderController::class, 'update']);
    Route::post('/folder-state/{folder}', [FolderController::class, 'updateState']);

    //payment
    Route::get('/list-payments', [AdminController::class, 'listPayments'])->name('admin-list-payments');

    //quote
    Route::get('/list-quotes', [AdminController::class, 'listQuotes'])->name('admin-list-quotes');
    Route::post('/quotes/{quotes}', [QuoteController::class, 'update']);
    Route::post('/quotes-state/{quotes}', [QuoteController::class, 'updateState']);

    //country
    Route::get('/list-countries', [AdminController::class, 'listCountries'])->name('admin-list-countries');
    Route::get('/list-towns', [AdminController::class, 'listTowns'])->name('admin-list-towns');
    Route::post('/country', [CountryController::class, 'create']);
    Route::post('/country/{country}', [CountryController::class, 'update']);
    Route::post('/town', [CountryController::class, 'createTown']);
    Route::post('/town/{town}', [CountryController::class, 'updateTown']);

    //user
    Route::get('/list-users', [AdminUserController::class, 'list'])->name('admin-list-users');
    Route::get('/admin-profil', [AdminUserController::class, 'profil'])->name('admin-profil');
    Route::get('/register', [AdminUserController::class, 'register'])->name('admin-register');
    Route::post('/register', [AdminUserController::class, 'create']);
    Route::post('/admin-user/{user}', [AdminUserController::class, 'update']);
    Route::post('/admin-userpassword/{user}', [AdminUserController::class, 'updatePassword']);
});
