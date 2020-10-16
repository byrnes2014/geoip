<?php
namespace Byrnes2014\GeoIP;


use Illuminate\Contracts\Support\DeferrableProvider;

class ServiceProvider extends \Illuminate\Support\ServiceProvider implements DeferrableProvider
{

	public function register()
    {
        $this->app->singleton(GeoIP::class, function(){
            return new GeoIP(config('services.geoip.key'));
        });

        $this->app->alias(GeoIP::class, 'geoip');
    }

    public function provides()
    {
        return [GeoIP::class, 'geoip'];
    }
}