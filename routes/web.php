<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthCoutroller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Route::get('/admin', function () {
//    return view('admin.login');
//})->middleware('checkUserLogin');

Route::get('/admin/login', function () {
    return view('admin.login');
})->middleware('checkUserLogin');

Route::post('post-login', [AuthCoutroller::class, 'postLogin'])->name('login.post');
Route::get('admin/logout', [AuthCoutroller::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('welcome');
})->middleware('checkUserLogin');

Route::get('/car/add', function () {
    return view('admin/cars/add-car', [
        'id' => 0
    ]);
})->middleware('checkUserLogin');

Route::get('/car/edit/{id}', function (Request $request) {
    return view('admin/cars/add-car', [
        'id' => $request->id
    ]);
})->middleware('checkUserLogin');

Route::get('/cars', function () {
    return view('admin/cars/cars');
})->middleware('checkUserLogin');

Route::get('/pawned/add', function () {
    return view('admin/pawned/add-pawned', [
        'id' => 0
    ]);
})->middleware('checkUserLogin');

Route::get('/pawned/edit/{id}', function (Request $request) {
    return view('admin/pawned/add-pawned', [
        'id' => $request->id
    ]);
})->middleware('checkUserLogin');

Route::get('/pawned', function () {
    return view('admin/pawned/pawned');
})->middleware('checkUserLogin');

Route::get('/customer/add', function () {
    return view('admin/customer/add-customer', [
        'id' => 0
    ]);
})->middleware('checkUserLogin');

Route::get('/customer', function () {
    return view('admin/customer/customer');
})->middleware('checkUserLogin');

Route::get('/customer/edit/{id}', function (Request $request) {
    return view('admin/customer/add-customer', [
        'id' => $request->id
    ]);
})->middleware('checkUserLogin');

Route::get('/customer/detailed_disclosure/{id}', function (Request $request) {
    return view('admin/customer/detailed-disclosure', [
        'id' => $request->id
    ]);
})->middleware('checkUserLogin');

Route::get('/user/add', function () {
    return view('admin/user/add-user', [
        'id' => 0
    ]);
})->middleware('checkUserLogin');

Route::get('/user/edit/{id}', function (Request $request) {
    return view('admin/user/add-user', [
        'id' => $request->id
    ]);
})->middleware('checkUserLogin');

Route::get('/users', function () {
    return view('admin/user/users');
})->middleware('checkUserLogin');
