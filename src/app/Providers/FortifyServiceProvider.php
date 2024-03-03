<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;

class FortifyServiceProvider extends ServiceProvider
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
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::registerView(function () {
            return view('auth.register');
        });

        Fortify::loginView(function () {
            return view('auth.login');
        });

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;
            return Limit::perMinute(10)->by($email . $request->ip());
        });

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new  MailMessage)
                ->subject(Lang::get('アカウント登録のご確認'))
                ->view('emails.verify_email', ['url' => $url]);
        });

        VerifyEmail::createUrlUsing(function ($notifiable) {
            $url = '';
            if ($notifiable instanceof \App\Models\User) {
                $url = URL::temporarySignedRoute(
                    'verification.verify',
                    Carbon::now()->addMinutes(config('auth.verification.expire', 60)),
                    [
                        'id' => $notifiable->getKey(),
                        'hash' => sha1($notifiable->getEmailForVerification()),
                    ]
                );
            } elseif ($notifiable instanceof \App\Models\Manager) {
                $url = URL::temporarySignedRoute(
                    'manager.verification.verify',
                    Carbon::now()->addMinutes(config('auth.verification.expire', 60)),
                    [
                        'id' => $notifiable->getKey(),
                        'hash' => sha1($notifiable->getEmailForVerification()),
                    ]
                );
            }
            return $url;
        });


        Fortify::viewPrefix('auth.');
    }
}
