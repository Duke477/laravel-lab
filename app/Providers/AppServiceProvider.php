<?php

namespace App\Providers;

use App\Models\Student;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Route::bind('your_roll', function ($value) {
            return Student::where('roll_no', $value)->firstOrFail();
        });
    }
}
