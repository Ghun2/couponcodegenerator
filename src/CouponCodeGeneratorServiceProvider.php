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
    protected function registerFacades()    // 파사드로 생성하여 사용 / 파사드 사용 안하려면 각각의 메소드 static 지정
    {
        $this->app->singleton('CouponCodeGenerator', function ($app) {
            return new \ghun2\CouponCodeGenerator\CouponCodeGenerator();
        });
    }
}