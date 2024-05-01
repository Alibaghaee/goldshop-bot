<?php

namespace App\Providers;

use App\Models\General\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class MacrosServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Request::macro('domain_id', function () {

            $host = preg_replace('#^www\.(.+\.)#i', '$1', $this->getHttpHost());

            $domain = Domain::where('domain', $host)
                ->withoutGlobalScopes()
                ->firstOrFail();


            return $domain->id;

            // $same_domains = [1, 2];
            // return in_array($domain->id, $same_domains) ? 1 : $domain->id;
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
