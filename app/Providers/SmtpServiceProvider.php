<?php

namespace App\Providers;

use App\Models\SmtpSetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class SmtpServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $setting = SmtpSetting::first();

        if($setting){
            $config = [
                'driver' => $setting->mail_mailer,
                'host' => $setting->mail_host,
                'port' => $setting->mail_port,
                'username' => $setting->mail_username,
                'password' => $setting->mail_password,
                'encryption' => $setting->mail_encryption,
                'from' => [
                    'address' => $setting->mail_from_address,
                    'name' => $setting->mail_from_name,
                ],
            ];

            Config::set('mail', $config);
        }
    }
}
