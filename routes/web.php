<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DomainController;


Route::post('/check-domain-availability', [DomainController::class, 'checkDomainAvailability'])->name('checkDomainAvailability');


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DomainController::class, 'index']);
Route::post('/check', [DomainController::class, 'checkDomain']);
