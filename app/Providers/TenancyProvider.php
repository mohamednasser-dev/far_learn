<?php

namespace App\Providers;

use App\Models\Tenant;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
class TenancyProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRequests();

        $this->configureQueue();
    }

    /**
     *
     */
    public function configureRequests()
    {
        if (! $this->app->runningInConsole()) {
            $host = $this->app['request']->getHost();
            if($host == env('maindomain','127.0.0.1')){
                config([
                    'database.connections.tenant.database' => env('LANDLORD_DB_DATABASE','uram_tahfeez_land_lord'),
                ]);

                DB::purge('tenant');

                DB::reconnect('tenant');

                Schema::connection('tenant')->getConnection()->reconnect();

            }else{
                Tenant::whereDate('expire_date','>=',date('Y-m-d'))->where('is_active','active')->whereDomain($host)->firstOrFail()->configure()->use();
            }
        }
    }

    /**
     *
     */
    public function configureQueue()
    {
        $this->app['queue']->createPayloadUsing(function () {
            return $this->app['tenant'] ? ['tenant_id' => $this->app['tenant']->id] : [];
        });

        $this->app['events']->listen(JobProcessing::class, function ($event) {
            if (isset($event->job->payload()['tenant_id'])) {
                Tenant::find($event->job->payload()['tenant_id'])->configure()->use();
            }
        });
    }
}
