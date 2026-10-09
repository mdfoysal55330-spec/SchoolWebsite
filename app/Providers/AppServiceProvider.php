<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // এই ৩ লাইনই ওই কালো "Not Secure" পেজটা ঠিক করবে
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // সব upload ফোল্ডার অটো বানিয়ে নেবে - একবারে সব 500 Error ঠিক
        $folders = [
            'school', 'notices', 'gallery', 'teachers', 
            'slider', 'results', 'pages', 'news'
        ];

        foreach ($folders as $folder) {
            $path = public_path('uploads/' . $folder);
            if (!File::exists($path)) {
                File::makeDirectory($path, 0775, true);
            }
        }
    }
}
