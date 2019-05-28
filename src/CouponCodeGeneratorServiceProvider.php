<?php
namespace ghun\CouponCodeGenerator;
use Illuminate\Support\ServiceProvider;

class CouponCodeGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CouponCodeGenerator::class, function () {
            return new CouponCodeGenerator();
        });
        $this->app->alias(CouponCodeGenerator::class, 'coupon-code-generator');
    }
}