<?php

use App\Http\Controllers\OperatorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkOrderOperatorController;
use App\Http\Controllers\WorkOrdersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::get('/work-orders', [WorkOrdersController::class, 'index'])->name('work-orders.index');
    Route::get('/work-orders/report', [WorkOrdersController::class, 'report'])->name('work-orders.report');
    Route::get('/work-orders/{work_order}', [WorkOrdersController::class, 'show'])->name('work-orders.show');
    Route::get('/work-orders/create', [WorkOrdersController::class, 'create'])->name('work-orders.create');
    Route::post('/work-orders', [WorkOrdersController::class, 'store'])->name('work-orders.store');
    Route::get('/work-orders/{work_order}/edit', [WorkOrdersController::class, 'edit'])->name('work-orders.edit');
    Route::put('/work-orders/{work_order}', [WorkOrdersController::class, 'update'])->name('work-orders.update');
    Route::delete('/work-orders/{work_order}', [WorkOrdersController::class, 'destroy'])->name('work-orders.destroy');


    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

Route::middleware(['auth', 'role:operator'])->group(function () {
    Route::get('/work-operator', [WorkOrderOperatorController::class, 'index'])->name('work-operator.index');
    Route::get('/work-operator/report', [WorkOrderOperatorController::class, 'report'])->name('work-operator.report');
    Route::get('/work-operator/{work_order}/edit', [WorkOrderOperatorController::class, 'edit'])->name('work-operator.edit');
    Route::put('/work-operator/{work_order}', [WorkOrderOperatorController::class, 'update'])->name('work-operator.update');
});
require __DIR__ . '/auth.php';
