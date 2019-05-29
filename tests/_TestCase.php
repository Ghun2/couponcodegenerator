<?php
// 테스트 환경 셋업 (시간상 다음에) 파일이름 _ 이거 빼면 됨
namespace Ghun\CouponCodeGenerator\Tests;

use Ghun\CouponCodeGenerator\CouponCodeGeneratorServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            CouponCodeGeneratorServiceProvider::class,
        ];
    }
    
    protected function getEnviromentSetUp($app)
    {
        # code...
        $app['config']->set('database.default','testdb');
        $app['config']->set('database.connections.testdb',[
            'driver' => 'sqlite',
            'database' => ':memory'
        ]
    );
        
    }
}