<?php

namespace App\Providers;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

 use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

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
        if (App::environment('production')) {
        URL::forceScheme('https');
        }
        ResetPassword::toMailUsing(function ($notifiable, string $token) {

            $url = url(route('password.reset', [
                'token' => $token,
                'email' => $notifiable->email,
            ], false));

            return (new MailMessage)
                ->subject('Reset your password')
                ->greeting('Hello!')
                ->line('Click the button below to reset your password.')
                ->action('Reset Password', $url)
                ->line('If you did not request this, simply ignore this email.');
        });
    }
}
