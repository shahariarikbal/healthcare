<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        $guards = [
            'web' => [
                'routes' => ['admin.profile.settings', 'admin.logo.settings'],
                'home-route' => 'admin.dashboard',
                'logout-route' => 'logout',
                'label' => 'Settings',
                'icon' => 'fa-solid fa-gears',
                'submenu' => [
                    ['route' => 'admin.profile.settings', 'label' => 'Profile settings'],
                    ['route' => 'admin.logo.settings', 'label' => 'Logo settings']
                ]
            ],

            'account' => [
                'routes' => ['account.profile.settings'],
                'home-route' => 'account.dashboard',
                'logout-route' => 'account.logout',
                'label' => 'Settings',
                'icon' => 'fa-solid fa-gears',
                'submenu' => [
                    ['route' => 'account.profile.settings', 'label' => 'Profile settings'],
                ]
            ],

            'doctor' => [
                'routes' => ['doctor.profile.settings'],
                'home-route' => 'doctor.dashboard',
                'logout-route' => 'doctor.logout',
                'label' => 'Settings',
                'icon' => 'fa-solid fa-gears',
                'submenu' => [
                    ['route' => 'doctor.profile.settings', 'label' => 'Profile settings'],
                ]
            ],

            'receptionist' => [
                'routes' => ['receptionist.profile.settings'],
                'home-route' => 'receptionist.dashboard',
                'logout-route' => 'receptionist.logout',
                'label' => 'Settings',
                'icon' => 'fa-solid fa-gears',
                'submenu' => [
                    ['route' => 'receptionist.profile.settings', 'label' => 'Profile settings'],
                ]
            ],
        ];

        View::share('guards', $guards);
        
    }
}
