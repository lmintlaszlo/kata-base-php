<?php

/**
 * Velocity checker
 * Functional specification
 * We have got a login mechanism, but we need an anti-bruteforce detection system.
 * Everybody said that captcha is a good thing, and yes it is, but I don't
 * want to make the user's life harder more then it is needed.
 * 
 * I want to give them captcha only when it's necessary.
 * 
 * We want to use the captcha in these cases:
 *           from one ip we have 3 failed login attempt
 *           from an ip range (192.168.0.x) we have 500 failed login attempt
 *           from an ip country we have 1000 failed login attempt
 *           with a username we have 3 failed login attempt
 * 
 * If we have a failed login we must increase the ip, the ip range, the country 
 * and the username counter till the captcha is not active. 
 * 
 * If the captcha is active we should increase ONLY the ip counter.
 * 
 * If the username registration country is different from the ip country and the
 * login is failed then you must increase the ip counter to the captcha limit 
 * (so you need to activate the captcha at the next try, so the ip gets "blocked").
 * 
 * The counters have a 3600 sec TTL, with the following description:
 * The counter logs the failed logins continuously and we count for the last one hour. 
 * 
 * It is allowed to summarize the counts in 300 seconds blocks.
 * 
 * Additional information
 *      you don't need to implement the ip range calculator
 *      you don't need to implement the geoip
 *      you don't need to implement a login function
 *      you don't need to implement a controller with view (no frontend needed!)
 */

/**
 * - construct-or egyenkent kerdezze meg az osszes countert, hogy aktiv-e OK
 * - constructor parameterben kapja a countereket OK
 * - countereknek kozos os OK
 * - az osben isLimitReached OK
 * - az osben increment OK
 * - a counterekben a limitek OK
 * - a counterekben a tablanev OK
 * - sajat exceptionok
 * - db ?ok?
 * - observernek utananezni
 * - loginonkent megfeleloen valtozzanak a counterek
 * - login attempt
 * - login attempt username password OK
 * - environmentben kene beallitani a db kapcsolatokat,
 *   ez fogna ossze a captchat es a login attempt-et OK
 * - environment teszt
 * - login attempt teszt 
 * - ne legyenek kulon counterek, csak azert, hogy tudjak a limitjuket,
 *   inkabb kapjak meg controllerbol a tipust, meg a limitet is
 * - Environment legyen inkabb controller
 * - Legyen counter factory
 */

namespace Kata\Homeworks\H04Velocity;

use Kata\Homeworks\H04Velocity\Counter\Ip;
use Kata\Homeworks\H04Velocity\Counter\IpRange;
use Kata\Homeworks\H04Velocity\Counter\IpCountry;
use Kata\Homeworks\H04Velocity\Counter\Username;


class Captcha
{    
    const IS_NECESSARY     = true;
    const IS_NOT_NECESSARY = false;    
    
    private $necessary = self::IS_NOT_NECESSARY;

    public function __construct(Ip $ip, IpCountry $ipCountry, IpRange $ipRange, Username $username)
    {
        if ($ip->isLimitReached() || $ipCountry->isLimitReached() || $ipRange->isLimitReached() || $username->isLimitReached())
        {
            $this->necessary = self::IS_NECESSARY;
        }
    }
    
    /**
     * Megmnondja, hogy szukseges-e a captcha megjelenitese.
     * 
     * @return boolean
     */
    public function isNecessary()
    {
        return $this->necessary;
    }
    
}