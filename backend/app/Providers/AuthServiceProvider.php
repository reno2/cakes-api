<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;

class
AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        VerifyEmail::toMailUsing(function ($notifiable, $url) {


            $pattern = "/(.*)(email\/verify\/)(.*)/";
            $replacement = config('app.api')."$2$3";
            $replaced_utl =  preg_replace($pattern, $replacement, $url);

            return (new MailMessage)
                ->subject('Подтвердите Email')
                ->line('Нажмите на кнопку чтобы подтвердить Ваш email.')
                ->action('Подтвердите свой email', $replaced_utl);
        });

        //
    }
}
