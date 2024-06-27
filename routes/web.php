<?php

use Illuminate\Support\Facades\Route;

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