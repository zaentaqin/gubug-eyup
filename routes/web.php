<?php

use App\Livewire\Invoice;
use App\Livewire\Homepage;
use App\Livewire\BookingPage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', Homepage::class);
Route::get('/booking', BookingPage::class);

Route::get('invoice/{order}', [InvoiceController::class, 'show'])->name('invoice');
