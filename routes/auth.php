<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

// Sales routes
Route::resource('sales', SaleController::class)->middleware(['auth']);
Route::get('sales/export', [SaleController::class, 'export'])->name('sales.export')->middleware(['auth']);
Route::get('sales/export/{format}', [SaleController::class, 'export'])->name('sales.export.format')->middleware(['auth']);
Route::get('sales/export/{format}/{startDate}/{endDate}', [SaleController::class, 'export'])->name('sales.export.date')->middleware(['auth']);
Route::get('sales/export/{format}/{startDate}/{endDate}/{customerId}', [SaleController::class, 'export'])->name('sales.export.customer')->middleware(['auth']);
// Route to get sales data for a specific customer
Route::get('sales/customer/{customerId}', [SaleController::class, 'getSalesByCustomer'])
    ->name('sales.customer')
    ->middleware(['auth']);
// Route to get sales data for a specific vehicle
Route::get('sales/vehicle/{vehicleId}', [SaleController::class, 'getSalesByVehicle'])
    ->name('sales.vehicle')
    ->middleware(['auth']);
// Route to get sales data for a specific date range
Route::get('sales/date-range/{startDate}/{endDate}', [SaleController::class, 'getSalesByDateRange'])
    ->name('sales.date-range')
    ->middleware(['auth']);
// Route to get sales data for a specific product
Route::get('sales/product/{productId}', [SaleController::class, 'getSalesByProduct'])
    ->name('sales.product')
    ->middleware(['auth']);
// Route to get sales data for a specific user
Route::get('sales/user/{userId}', [SaleController::class, 'getSalesByUser'])
    ->name('sales.user')
    ->middleware(['auth']);
// Route to get sales data for a specific payment method
Route::get('sales/payment-method/{paymentMethod}', [SaleController::class, 'getSalesByPaymentMethod'])
    ->name('sales.payment-method')
    ->middleware(['auth']);
