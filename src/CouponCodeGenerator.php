<?php

namespace ghun2\CouponCodeGenerator;
// 쿠폰 코드 생성기 메인 클래스
class CouponCodeGenerator
{
    CONST MAX_LENGTH = 16;  // 최대 16자리 상수값 지정 . prefix 와 group id 길이를 뺀 나머지 코드를 생성함

    // public static $my_coupons = [];
    // public $my_users = [];
    // public $my_group = "";

    // public function __constructor($users,$group)
    // {
    //     self::$my_users = $users;
    //     self::$my_group = $group;
    // }

        // 쿠폰 코드 생성 - 단일
    public function generator($prefix,$group="",$users=[]) {
        // prefix는 사용자가 입력, group은 초기값 A부터 증가(db접근하여 최근값 조회), users는 랜덤 할당을 위함
        $length = self::MAX_LENGTH-strlen($prefix.$group);
        // 문자는 알파뱃 대문자만 사용
        $uppercase    = ['Q', 'W', 'E', 'R', 'T', 'Y', 'U', 'I', 'O', 'P', 'A', 'S', 'D', 'F', 'G', 'H', 'J', 'K', 'L', 'Z', 'X', 'C', 'V', 'B', 'N', 'M'];
        $numbers      = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        $characters = array_merge($numbers, $uppercase);
        $randchar = '';
        // 배열 초기화
        $coupon = array("code" => "", "user_id" => 1, "group" => "", "useable" => 1);
        
        for ($i = 0; $i < $length; $i++) {
            // 문자와숫자로 이루어진 배열에서 임의의 값 length 만큼 push
            $randchar .= $characters[mt_rand(0, count($characters) - 1)];
        }
        $coupon["code"] = $prefix . $group . $randchar; //입력받은 prefix와 group id , 생성한 code를 concat
        $coupon["group"] = $group;
        // 유저 랜덤으로 할당 admin계정(id=1)도 포함 하였음
        $coupon["user_id"] = $users[mt_rand(0,count($users)-1)];
        // 유저가 admin이 아니면 사용했는지 안했는지 랜덤으로
        if ($coupon["user_id"] != 1){
            $coupon["useable"] = mt_rand(0,1);
        }


        return $coupon;
    }
        // 쿠폰 코드 생성 - 다수
    public function generate_coupons($maxNumberOfCoupons = 1,$prefix,$group="",$users=[]) {
        // $maxNumberOfCoupons 는 몇개 만들지 입력값 / 최소 1개라도 만들으라고 초기값 지정
        $coupons = [];
        for ($i = 0; $i < $maxNumberOfCoupons; $i++) {
            // 입력받은 숫자 만큼 단일 쿠폰 코드 생성 실행 하여 배열에 저장
            $temp = self::generator($prefix,$group,$users);
            $coupons[] = $temp;
        }
        return $coupons;
        // var_dump($coupons[0]);
    }
        // 테스트용 쿠폰 할당 메소드
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
        // 중복이 없는지 판별하는 메소드
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