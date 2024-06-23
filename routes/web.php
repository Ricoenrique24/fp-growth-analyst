<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BundlingController;
use App\Http\Controllers\DarkModeController;
use App\Http\Controllers\FpGrowthController;
use App\Http\Controllers\ColorSchemeController;
use App\Http\Controllers\TransactionController;

// Controller Baru
use App\Http\Controllers\NewBundlingController;
use App\Http\Controllers\NewFpGrowthController;
use App\Http\Controllers\NewTransactionController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('dark-mode-switcher', [DarkModeController::class, 'switch'])->name('dark-mode-switcher');
Route::get('color-scheme-switcher/{color_scheme}', [ColorSchemeController::class, 'switch'])->name('color-scheme-switcher');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('orders', OrderController::class);
    Route::resource('transactions', NewTransactionController::class);
    Route::resource('fp_growths', NewFpGrowthController::class);
    Route::resource('bundings', NewBundlingController::class);
});

require __DIR__.'/auth.php';
