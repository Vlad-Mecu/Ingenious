<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Invoice\Http\Controllers\InvoiceController;

Route::get('/invoice/view/{uuid}', [InvoiceController::class, 'view'])->name('invoice.view');
Route::get('/invoice/approve/{uuid}', [InvoiceController::class, 'approve'])->name('invoice.approve');
Route::get('/invoice/reject/{uuid}', [InvoiceController::class, 'reject'])->name('invoice.reject');
