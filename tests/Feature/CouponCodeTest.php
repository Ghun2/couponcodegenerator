<?php

namespace ghun2\CouponCodeGenerator\Tests;

use Orchestra\Testbench\TestCase;
use ghun2\CouponCodeGenerator\CouponCodeGenerator;

class CouponCodeTest extends TestCase
{
    /** @test */
    // public function generatorTest() {
    //     dd(CouponCodeGenerator::generate("ABQ"));
    // }
    
    // public function generatorArray() {
    //     $myDebugVar = CouponCodeGenerator::generate_coupons(10,"ASD");
        
    //     fwrite(STDERR, print_r($myDebugVar, TRUE));
    // }
        // 중복 판별 유닛 테스트
    public function uniqueTest() {
        $uppercase    = ['Q', 'W', 'E', 'R', 'T', 'Y', 'U', 'I', 'O', 'P', 'A', 'S', 'D', 'F', 'G', 'H', 'J', 'K', 'L', 'Z', 'X', 'C', 'V', 'B', 'N', 'M'];
        $numbers      = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        $characters = array_merge($numbers, $uppercase);
        $flag = True;
        for ($t = 0; $t < 30; $t++)
        {
            $randprefix = "";

            for ($i = 0; $i < 3; $i++) {
                $randprefix .= $characters[mt_rand(0, count($characters) - 1)];
            }

            $myDebugVar = CouponCodeGenerator::generate_coupons(10,$randprefix,"AS",[1,2,3,4]);
            if (!CouponCodeGenerator::check_unique($myDebugVar)){
                $flag = False;
                break;
            }
        }
        $this->assertTrue($flag);
        
    }
}