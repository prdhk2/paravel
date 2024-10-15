<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('Admin/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/addNewDevice', [AdminController::class, 'addNewDevice'])->name('addnewdevice');
Route::get('/ListDevice', [AdminController::class, 'ListDevice'])->name('listdevice');
Route::get('/TerminalConfiguration', [AdminController::class, 'TerminalConfiguration'])->name('terminal');
Route::get('/LogHistory', [AdminController::class, 'LogHistory'])->name('log');
Route::post('/devices', [AdminController::class, 'store'])->name('devices.store');
Route::get('/devices/{id}/edit', [AdminController::class, 'edit'])->name('devices.edit');
Route::put('/devices/{id}', [AdminController::class, 'update'])->name('devices.update');
Route::delete('/devices/{id}', [AdminController::class, 'destroy'])->name('devices.destroy');

Route::post('/execute-commands', [NetworkController::class, 'executeCommands'])->name('execute.commands');
Route::get('/log', [LogController::class, 'index'])->name('log.index');

require __DIR__.'/auth.php';
