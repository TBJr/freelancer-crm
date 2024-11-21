<?php

use App\Http\Controllers\CreditNoteController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceItemController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TimesheetController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Customer
Route::resource('customers', CustomerController::class);

// Item
Route::resource('items', ItemController::class);

// Invoice
Route::resource('invoices', InvoiceController::class);
Route::resource('invoice_items', InvoiceItemController::class);

// Expense
Route::resource('expenses', ExpenseController::class);

// Project
Route::resource('projects', ProjectController::class);

// Timesheet
Route::resource('timesheets', TimesheetController::class);

// Payment
Route::resource('payments', PaymentController::class);

// Credit Note
Route::resource('credit_notes', CreditNoteController::class);

// Setting

require __DIR__.'/auth.php';