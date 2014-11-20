<?php

namespace Kata\Homeworks\H06RegistrationApi;

class Response
{
    const SUCCESS_OK      = 'yes';
    const SUCCESS_FAILURE = 'no';
    
    const RESULT_CODE_OK                    = 201;
    const RESULT_CODE_USERNAME_FORMAT_ERROR = 601;
    const RESULT_CODE_PASSWORD_FORMAT_ERROR = 602;
    const RESULT_CODE_USERNAME_EXISTS       = 701;
    const RESULT_CODE_OTHER                 = 500;
    
    const RESULT_ID_FAILURE = 0;
    
    private $success;
    private $resultCode;
    private $resultId;
    private $message;
    
    public function display()
    {
        echo json_encode(array(
            'success'    => $this->success,
            'resultCode' => $this->resultCode,
            'resultId'   => $this->resultId,
            'message'    => $this->message,
        ));
    }
    
    public function setSuccess($value)
    {
        $this->success = $value;
    }
    
    public function setResultCode($value)
    {
        $this->resultCode = $value;
    }
    
    public function setResultId($value)
    {
        $this->resultId = $value;
    }
    
    public function setMessage($value)
    {
        $this->message = $value;
    }
}
