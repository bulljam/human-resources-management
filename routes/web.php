<?php

use App\Livewire\Admin;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', Admin\Dashboard::class)->name('dashboard');
    // Companies
    Route::prefix('companies')->as('companies.')->group(function () {
        Route::get('/', Admin\Companies\Index::class)->name('index');
        Route::get('/create', Admin\Companies\Create::class)->name('create');
        Route::get('/{company}/edit', Admin\Companies\Edit::class)->name('edit');
    });

    Route::middleware(['company.context'])->group(function () {
        // Departments
        Route::prefix('departments')->as('departments.')->group(function () {
            Route::get('/', Admin\Departments\Index::class)->name('index');
            Route::get('/create', Admin\Departments\Create::class)->name('create');
            Route::get('/{department}/edit', Admin\Departments\Edit::class)->name('edit');
        });

        // Designations
        Route::prefix('designations')->as('designations.')->group(function () {
            Route::get('/', Admin\Designations\Index::class)->name('index');
            Route::get('/create', Admin\Designations\Create::class)->name('create');
            Route::get('/{designation}/edit', Admin\Designations\Edit::class)->name('edit');
        });

        // Employees
        Route::prefix('employees')->as('employees.')->group(function () {
            Route::get('/', Admin\Employees\Index::class)->name('index');
            Route::get('/create', Admin\Employees\Create::class)->name('create');
            Route::get('/{employee}/edit', Admin\Employees\Edit::class)->name('edit');
        });

        // Contracts
        Route::prefix('contracts')->as('contracts.')->group(function () {
            Route::get('/', Admin\Contracts\Index::class)->name('index');
            Route::get('/create', Admin\Contracts\Create::class)->name('create');
            Route::get('/{contract}/edit', Admin\Contracts\Edit::class)->name('edit');
        });

        // Payrolls
        Route::prefix('payrolls')->as('payrolls.')->group(function () {
            Route::get('/', Admin\Payrolls\Index::class)->name('index');
            Route::get('/{payroll}', Admin\Payrolls\Show::class)->name('show');
        });

        // Payments
        Route::prefix('payments')->as('payments.')->group(function () {
            Route::get('/', Admin\Payments\Index::class)->name('index');
            Route::get('/{payment}', Admin\Payments\Show::class)->name('show');
        });
    });


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
