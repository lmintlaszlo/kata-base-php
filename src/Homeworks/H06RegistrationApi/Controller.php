<?php

namespace Kata\Homeworks\H06RegistrationApi;

use Kata\Homeworks\H04Velocity\Request;

class Controller
{
    private $request;
    
    public function __construct()
    {
        $this->request = new Request('Radella Gleeddyecker', 'Ra5Glee', 'Ra5Glee');
    }
    
    public function registration()
    {
        
    }
    
    public function autoRegistration()
    {
        
    }
}
