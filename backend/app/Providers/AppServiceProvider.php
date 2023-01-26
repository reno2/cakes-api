<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::macro('testMacro', function(){
           return $this->where(function (Builder $query) {
               $query->where('sort', 500);
            });

        });

        Queue::after(function (JobProcessed $event) {
            //Log::debug($event->connectionName .'<br>'.  $event->job->resolveName());

            $payload = $event->job->payload() ;
            $data =  unserialize($payload['data']['command']);



            if ($data->user instanceof User) {
                Log::notice( $data->user->id);
            }else{
                Log::notice( 'trtre');
            }

//            Log::debug($payload);
       //   Log::notice( print_r($data, true));

            //Log::notice('Job payload: ' . print_r($data, true));
            // $event->connectionName
            // $event->job
            // $event->job->payload()
        });

        //JsonResource::withoutWrapping();
    }
}
