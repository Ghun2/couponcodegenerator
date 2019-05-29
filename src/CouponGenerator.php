<?php

namespace Ghun\CouponCodeGenerator;

class CouponGenerator
{
    CONST MAX_LENGTH = 16;

    // public static $my_coupons = [];
    // public $my_users = [];
    // public $my_group = "";

    // public function __constructor($users,$group)
    // {
    //     self::$my_users = $users;
    //     self::$my_group = $group;
    // }

    public function generate($prefix,$group) {

        $length = self::MAX_LENGTH-strlen($prefix.$group);
        // $length = self::MIN_LENGTH-count($prefix.$group);
        $uppercase    = ['Q', 'W', 'E', 'R', 'T', 'Y', 'U', 'I', 'O', 'P', 'A', 'S', 'D', 'F', 'G', 'H', 'J', 'K', 'L', 'Z', 'X', 'C', 'V', 'B', 'N', 'M'];
        $numbers      = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        $characters = array_merge($numbers, $uppercase);
        $randchar = '';
        $coupon = array("code" => "", "user" => 0, "group" => "");

        
        for ($i = 0; $i < $length; $i++) {
            $randchar .= $characters[mt_rand(0, count($characters) - 1)];
        }
        $coupon["code"] = $prefix . $group . $randchar;

        return $coupon;
    }

    public function generate_coupons($maxNumberOfCoupons = 1,$prefix,$group="") {
        $coupons = [];
        for ($i = 0; $i < $maxNumberOfCoupons; $i++) {
            $temp = self::generate($prefix,$group);
            $temp["group"] = $group;
            $coupons[] = $temp;
        }
        return $coupons;
        // var_dump($coupons[0]);
    }

    public function allocate_coupons($coupons,$users)
    {
        if(count($coupons) != 0 && count($users) != 0){
            $idx = 0;
            $cnt = count($coupons)/count($users);

            for ($i = 0; $i < count($users); $i++) {
                $coupons[mt_rand($idx,$idx+$cnt)]["user"] = $users[$i];
                $idx += $cnt;
            }
        }

        return $coupons;
       
    }

    public function check_unique($data)
    {
        $cnt = count($data);
        $unq_cnt = count(array_unique($data,SORT_REGULAR));
        
        if ($cnt != $unq_cnt){
            return False;
        }
        else {
            return True;
        }
    }
}


/** var_dump Testing */ 
// $myusers = [1,2,3];
// $my_coupons = CouponGenerator::generate_coupons(10,"KJH","AG");
// echo CouponGenerator::check_unique($my_coupons);
// $my_coupons = CouponGenerator::allocate_coupons($my_coupons,$myusers);



// var_dump($my_coupons);

// $asd = 'A';
// for($i = 0;$i < 30; $i++){
//     echo ++$asd.PHP_EOL;
// }