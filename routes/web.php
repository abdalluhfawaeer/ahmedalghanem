<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthCoutroller;
use App\Http\Controllers\MonthlyInstallmentPrint;

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

Route::get('/admin/login', function () {
    session()->put('head-title', 'تسجيل الدخول');
    return view('admin.login');
})->middleware('checkUserIsLogin');

Route::post('post-login', [AuthCoutroller::class, 'postLogin'])->name('login.post');
Route::get('admin/logout', [AuthCoutroller::class, 'logout'])->name('logout');

Route::get('/', function () {
    session()->put('head-title', 'الرئيسة');
    return view('welcome');
})->middleware('checkUserLogin');

Route::get('/car/add', function () {
    session()->put('head-title', 'اضافة سيارة');
    return view('admin/cars/add-car', [
        'id' => 0
    ]);
})->middleware('checkUserLogin');

Route::get('/car/edit/{id}', function (Request $request) {
    session()->put('head-title', 'تعديل السيارة');
    return view('admin/cars/add-car', [
        'id' => $request->id
    ]);
})->middleware('checkUserLogin');

Route::get('/cars', function () {
    session()->put('head-title', 'السيارات');
    return view('admin/cars/cars');
})->middleware('checkUserLogin');

Route::get('/pawned/add', function () {
    session()->put('head-title', 'اضافة مرهون');
    return view('admin/pawned/add-pawned', [
        'id' => 0
    ]);
})->middleware('checkUserLogin');

Route::get('/pawned/edit/{id}', function (Request $request) {
    session()->put('head-title', 'تعديل مرهون');
    return view('admin/pawned/add-pawned', [
        'id' => $request->id
    ]);
})->middleware('checkUserLogin');

Route::get('/pawned', function () {
    session()->put('head-title', 'مرهون');
    return view('admin/pawned/pawned');
})->middleware('checkUserLogin');

Route::get('/customer/add', function () {
    session()->put('head-title', 'اضافة زبون');
    return view('admin/customer/add-customer', [
        'id' => 0
    ]);
})->middleware('checkUserLogin');

Route::get('/customer', function () {
    session()->put('head-title', 'الزبائن');
    return view('admin/customer/customer');
})->middleware('checkUserLogin');

Route::get('/customer/edit/{id}', function (Request $request) {
    session()->put('head-title', 'تعديل الزبون');
    return view('admin/customer/add-customer', [
        'id' => $request->id
    ]);
})->middleware('checkUserLogin');

Route::get('/customer/detailed_disclosure/{id}', function (Request $request) {
    session()->put('head-title', 'الكشف التفصيلي');
    return view('admin/customer/detailed-disclosure', [
        'id' => $request->id
    ]);
})->middleware('checkUserLogin');

Route::get('/user/add', function () {
    session()->put('head-title', 'اضافة مستخدم');
    return view('admin/user/add-user', [
        'id' => 0
    ]);
})->middleware('checkUserLogin');

Route::get('/user/edit/{id}', function (Request $request) {
    session()->put('head-title', 'تعديل مستخدم');
    return view('admin/user/add-user', [
        'id' => $request->id
    ]);
})->middleware('checkUserLogin');

Route::get('/users', function () {
    session()->put('head-title', 'النستخدمين');
    return view('admin/user/users');
})->middleware('checkUserLogin');

Route::get('received/voucher/{id}', [MonthlyInstallmentPrint::class, 'receivedVoucher'])->middleware('checkUserLogin');
Route::get('detailed_disclosure/print/{id}', [MonthlyInstallmentPrint::class, 'detailedDisclosure']);
