<?php
namespace ghun2\CouponCodeGenerator;

use Illuminate\Support\ServiceProvider;
use ghun2\CouponCodeGenerator\Facades\CouponCodeGenerator;

class CouponCodeGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerResources();
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->singleton(CouponCodeGenerator::class, function () {
//            return new CouponCodeGenerator();
//        });
//        $this->app->alias(CouponCodeGenerator::class, 'coupon-code-generator');
    }
    private function registerResources()
    {
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
         $this->registerFacades();
    }
    protected function registerFacades()
    {
        $this->app->singleton(CouponCodeGenerator::class, function () {
            return new \ghun2\CouponCodeGenerator\CouponCodeGenerator();
        });
    }
}