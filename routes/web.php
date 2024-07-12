<?php

use App\Http\Controllers\NhacsiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SanPhamController;
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
// Method: get, post, put, patch, delete
// Route::get('/', function () {
//     return view('welcome');
// });
// Route::put('/user', function() {
//     //...
// });
// Route::patch('/user', function(){
//     //..
// });
// // Ngoài ra 2 phương thức sử dụng trong TH nhiều method chung uri
// Route::match(['put', 'patch'], '/user', function() {
//     // ..
// });
Route::any('/', function() {
    return view('hello');
})->name('welcome');

Route::get('/user/{id}/{name?}', function(string $id, string $ten = null) {
    echo route('welcome') . "<br>";
    return "User:" . $id . "- Name:" . $ten;
});

// Tạo controller: php artisan make:controller SanPhamController
Route::get('/san-pham', [SanPhamController::class, 'index'])->name('san-pham.index');
Route::get('/san-pham/{id}', [SanPhamController::class, 'detail']);
Route::get('/san-pham/xoa/{id}', [SanPhamController::class, 'delete']);

Route::get('/nhacsi', [NhacsiController::class, 'index'])->name('nhacsi.index');
Route::get('/nhacsi/create', [NhacsiController::class, 'create'])->name('nhacsi.create');
Route::get('/nhacsi/{id}/show', [NhacsiController::class, 'show'])->name('nhacsi.show');
Route::get('/nhacsi/{id}/edit', [NhacsiController::class, 'edit'])->name('nhacsi.edit');
Route::post('/nhacsi/store', [NhacsiController::class, 'store'])->name('nhacsi.store');
Route::put('/nhacsi/{id}/update', [NhacsiController::class, 'update'])->name('nhacsi.update');
Route::delete('/nhacsi/{id}/destroy', [NhacsiController::class, 'destroy'])->name('nhacsi.destroy');
