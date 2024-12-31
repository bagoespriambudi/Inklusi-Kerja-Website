<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobCategoryController;
use App\Http\Controllers\JobListingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriptionPlanController;
use App\Http\Controllers\SubscriptionCheckoutController;
use App\Http\Controllers\JobApplicationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::resource('companies', CompanyController::class);
Route::resource('job-categories', JobCategoryController::class);
Route::resource('job-listings', JobListingController::class);

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// User Management
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('subscription-plans', SubscriptionPlanController::class);
});

// Subscription Checkout Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/subscription/{plan}/checkout', [SubscriptionCheckoutController::class, 'checkout'])->name('subscription.checkout');
    Route::post('/subscription/callback', [SubscriptionCheckoutController::class, 'callback'])->name('subscription.callback');
});

// Job Application Routes
Route::middleware(['auth', 'role:jobseeker'])->group(function () {
    Route::get('/job-applications', [JobApplicationController::class, 'index'])->name('job-applications.index');
    Route::post('/job-applications', [JobApplicationController::class, 'store'])->name('job-applications.store');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/subscription-transactions', [App\Http\Controllers\Admin\SubscriptionTransactionController::class, 'index'])
        ->name('subscription-transactions.index');
    Route::patch('/subscription-transactions/{transaction}/status', [App\Http\Controllers\Admin\SubscriptionTransactionController::class, 'updateStatus'])
        ->name('subscription-transactions.update-status');
});
