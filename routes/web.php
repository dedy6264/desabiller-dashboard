<?php
use App\Http\Controllers\MerchantOutletActivity\MainBillerController;
// use App\Http\Controllers\MainController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\LoginController;

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
// Route::middleware('auth')->group(function(){
    Route::get('/showProduct', [MainBillerController::class, 'showProducts'])->name('showProduct'); 
    Route::post('/showProductKhusus', [MainBillerController::class, 'showProductKhusus'])->name('showProductKhusus'); 
    
    Route::post('/getProducts',[MainBillerController::class,'getProducts'])->name('getProducts');
    Route::post('/inquiry',[MainBillerController::class,'inquiry'])->name('inquiry');
    Route::post('/payment',[MainBillerController::class,'payment'])->name('payment');
    Route::get('/advice/{id}',[MainBillerController::class,'advice'])->name('advice');
    Route::post('/trxReport',[MainBillerController::class,'trxReport'])->name('trxReport');
    Route::post('/pulsa', [InquiryController::class, 'pulsaIndex'])->name('pulsa'); //proses logout
    Route::get('/pulsa/checkSimProv', [InquiryController::class, 'pulsaCheckSimProvider'])->name('pulsa.checkSimProv'); //proses logout
// });

Route::get('/login', [LoginController::class, 'index'])->name('login'); 
Route::post('/loginProccess', [LoginController::class, 'login'])->name('loginProccess'); 
Route::get('/logout', [LoginController::class, 'logout'])->name('logout'); 
// Route::get('/dashboard', function () {
//     return 'Welcome to Dashboard!';
// })->middleware('auth');


// Route::get('/admin/',[MainController::class, 'index'])->name('home');
// Route::resource('dashboard',MainController::class);
