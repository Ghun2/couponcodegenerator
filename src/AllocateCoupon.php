<?php

namespace Ghun\CouponCodeGenerator;


class AllocateCoupon
{
    public static function allocate_coupons($coupons,$users)
    {
        $idx = 0;
        $cnt = count($coupons)/count($users);

        for ($i = 0; $i < count($users); $i++) {
            $coupons[mt_rand($idx,$idx+$cnt)]["user"] = $users[$i];
            $idx += $cnt;
        }
    }
        
}