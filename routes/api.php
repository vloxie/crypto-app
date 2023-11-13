<?php

use App\Http\Controllers\API\FindCrypto;
use App\Http\Controllers\API\ListCrypto;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('list', ListCrypto::class)->name('crypto.list');
Route::get('find/{crypto}', FindCrypto::class)->name('crypto.find');
