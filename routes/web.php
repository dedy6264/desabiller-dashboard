<?php
use App\Http\Controllers\MerchantOutletActivity\MainBillerController;
// use App\Http\Controllers\MainController;
use App\Http\Controllers\InquiryController;

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [MainBillerController::class, 'index'])->name('home'); 
Route::post('/getProducts',[MainBillerController::class,'getProducts'])->name('getProducts');
Route::post('/inquiry',[MainBillerController::class,'inquiry'])->name('inquiry');
Route::post('/pulsa', [InquiryController::class, 'pulsaIndex'])->name('pulsa'); //proses logout
Route::get('/pulsa/checkSimProv', [InquiryController::class, 'pulsaCheckSimProvider'])->name('pulsa.checkSimProv'); //proses logout

// Route::get('/admin/',[MainController::class, 'index'])->name('home');
// Route::resource('dashboard',MainController::class);
