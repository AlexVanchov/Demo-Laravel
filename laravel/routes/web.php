<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreditController;
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

Route::get('/', [CreditController::class, 'index'])->name('credit.index');

Route::get('/credits/create', [CreditController::class, 'create'])->name('credit.create');
Route::post('/credits', [CreditController::class, 'store'])->name('credit.store');

Route::get('/credits/payment', [CreditController::class, 'createPayment'])->name('credit.payment');
Route::post('/credits/payment', [CreditController::class, 'storePayment'])->name('credit.payment.store');

