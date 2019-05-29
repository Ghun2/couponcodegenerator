<?php

namespace ghun2\CouponCodeGenerator;

class CouponCodeGenerator
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

    public function generator($prefix,$group="",$users=[]) {

        $length = self::MAX_LENGTH-strlen($prefix.$group);
        // $length = self::MIN_LENGTH-count($prefix.$group);
        $uppercase    = ['Q', 'W', 'E', 'R', 'T', 'Y', 'U', 'I', 'O', 'P', 'A', 'S', 'D', 'F', 'G', 'H', 'J', 'K', 'L', 'Z', 'X', 'C', 'V', 'B', 'N', 'M'];
        $numbers      = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        $characters = array_merge($numbers, $uppercase);
        $randchar = '';
        $coupon = array("code" => "", "user_id" => 1, "group" => "", "useable" => 1);
        
        for ($i = 0; $i < $length; $i++) {
            $randchar .= $characters[mt_rand(0, count($characters) - 1)];
        }
        $coupon["code"] = $prefix . $group . $randchar;
        $coupon["group"] = $group;
        $coupon["user_id"] = $users[mt_rand(0,count($users)-1)];
        if ($coupon["user_id"] != 1){
            $coupon["useable"] = mt_rand(0,1);
        }


        return $coupon;
    }

    public function generate_coupons($maxNumberOfCoupons = 1,$prefix,$group="",$users=[]) {
        $coupons = [];
        for ($i = 0; $i < $maxNumberOfCoupons; $i++) {
            $temp = self::generator($prefix,$group,$users);
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
// $my_coupons = CouponCodeGenerator::generate_coupons(10,"KJH","AG");
// echo CouponCodeGenerator::check_unique($my_coupons);
// $my_coupons = CouponCodeGenerator::allocate_coupons($my_coupons,$myusers);



// var_dump($my_coupons);

// $asd = 'A';
// for($i = 0;$i < 30; $i++){
//     echo ++$asd.PHP_EOL;
// }