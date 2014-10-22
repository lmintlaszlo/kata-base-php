<?php

namespace Kata\Homeworks\H04Velocity;

class Environment
{
    private $dbHost = 'localhost';
    private $dbName = 'production';
    private $dbUser = 'phpunit';
    private $dbPass = 'phpunit';
    
    private $connection;
    
    public function __construct()
    {
        $this->connection = new \PDO(
                "mysql:host=$this->dbHost;dbname=$this->dbName",
                $this->dbUser, $this->dbPass
        );
    }
    
    public function doLoginForm()
    {
        $request = new Request('pityu', 'pityu', '1.1.1.3', '1.1.1.x', 'Hungary');
        
        // Counterek
        $ip        = new Ip($request->getIp(), $this->connection);
        $ipRange   = new IpRange($request->getIpRange(), $this->connection);
        $ipCountry = new IpCountry($request->getIpCountry(), $this->connection);
        $username  = new Username($request->getUsername(), $this->connection);
        
        $captcha      = new Captcha($ip, $ipCountry, $ipRange, $username);
        $loginAttempt = new LoginAttempt($request->getUsername(), $request->getPassword(), $this->connection);
        
        if (!$loginAttempt->isSuccess())
        {
            if($captcha->isNecessary())
            {    
                $ip->increment();
            }
            elseif($request->getIpCountry() !== $loginAttempt->getStoredData('country'))
            {
                $ip->setToMax();
            }
            else
            {
                $ip->increment();
                $ipRange->increment();
                $ipCountry->increment();
                $username->increment();
            }
            
            $this->displayForm();
        }
        else
        {
            $this->redirectToLoggedIn();
        }
    }
}
