<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\MaintenanceController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('departments/{department}', [DepartmentController::class, 'show'])
    ->name('departments.show')
    ->middleware(['auth', 'verified']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('product-management', [\App\Http\Controllers\ProductController::class, 'index'])->name('product.management');
    Route::get('product-management/create', [\App\Http\Controllers\ProductController::class, 'create'])->name('product.management.create');
    Route::post('product-management', [\App\Http\Controllers\ProductController::class, 'store'])->name('product.store');
    Route::get('product-management/{product}/edit', [\App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit');
    Route::put('product-management/{product}', [\App\Http\Controllers\ProductController::class, 'update'])->name('product.update');
    Route::delete('product-management/{product}', [\App\Http\Controllers\ProductController::class, 'destroy'])->name('product.destroy');

    Route::get('departments', [DepartmentController::class, 'index'])->name('departments.index');
    Route::get('departments/{department}', [DepartmentController::class, 'show'])->name('departments.show');

    Route::get('maintenance', [MaintenanceController::class, 'index'])->name('maintenance.index');
    Route::get('maintenance/machines/{machine}', [MaintenanceController::class, 'show'])->name('maintenance.show');

    Route::get('sales', [SalesController::class, 'index'])->name('sales.index');
    Route::post('/sales/add/{product}', [SalesController::class, 'add'])->name('sales.add');

});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
