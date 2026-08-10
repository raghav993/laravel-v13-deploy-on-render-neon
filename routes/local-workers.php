<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocalWorkerController;
use App\Http\Controllers\WorkerBookingController;

Route::prefix('local-workers')->name('workers.')->group(function () {
    Route::get('/', [LocalWorkerController::class, 'index'])->name('index');
    Route::get('/register', [LocalWorkerController::class, 'create'])->name('create');
    Route::post('/register', [LocalWorkerController::class, 'store'])->name('store');

    Route::get('/{localWorker}', [LocalWorkerController::class, 'show'])->name('show');
    Route::get('/{localWorker}/book', [WorkerBookingController::class, 'create'])->name('book');
    Route::post('/{localWorker}/book', [WorkerBookingController::class, 'store'])->name('book.store');
});
