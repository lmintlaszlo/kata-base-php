<?php

namespace Kata\Homeworks\H04Velocity;

class Controller
{
    const DISPLAY_LOGIN_FORM = 'displayLoginForm';
    const DISPLAY_ADMIN_PAGE = 'displayAdmin';
    
    private $dbHost = 'localhost';
    private $dbName = 'production';
    private $dbUser = 'phpunit';
    private $dbPass = 'phpunit';
    
    public function doLoginForm(
        LoginAttempt $loginAttempt
//        Captcha $captcha,
//        Ip $ip,
//        IpRange $ipRange,
//        IpCountry $ipCountry,
//        Username $username
    ){
        if ($loginAttempt->isSuccess() === LoginAttempt::LOGIN_RESULT_UNSUCCESS)
        {
//            if($captcha->isNecessary())
//            {    
//                $ip->increment();
//            }
//            elseif($this->request->getIpCountry() !== $loginAttempt->getCountry())
//            {
//                $ip->setToLimit();
//            }
//            else
//            {
//                $ip->increment();
//                $ipRange->increment();
//                $ipCountry->increment();
//                $username->increment();
//            }
            
            return self::DISPLAY_LOGIN_FORM;
        }
        else
        {
            return self::DISPLAY_ADMIN_PAGE;
        }
    }
}
