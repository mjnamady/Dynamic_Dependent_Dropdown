<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DynamicDropdownController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DynamicDropdownController::class, 'index']);
Route::post('dependentdropdown/fetch', [DynamicDropdownController::class, 'fetch'])->name('dependentdropdown.fetch');
