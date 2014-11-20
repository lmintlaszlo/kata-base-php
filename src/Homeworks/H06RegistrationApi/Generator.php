<?php

namespace Kata\Homeworks\H06RegistrationApi;

class Generator
{
    const SALT = 'BA234A575689489La7LBA4356bAL67b7aL9BALbaLB';
    
    private $password;
    
    public function __construct()
    {
        $this->password   = $this->_createPassword();
        $this->saltedHash = $this->_createHash();
    }
    
    public function getPassword()
    {
        return $this->password;
    }
    
    public function getSaltedHash()
    {
        
        return $this->saltedHash;
    }
    
    public function generateSaltedHashFromPlain($plainPassword)
    {
        return $this->_createHash($plainPassword);
    }
    
    private function _createPassword()
    {
        return substr(md5(mt_rand() . microtime()), 0, rand(8,16));
    }
    
    private function _createHash($password = '')
    {
        if(empty($password))
        {
            $password = $this->password;
        }
        
        return sha1($password.self::SALT);
    }
}
