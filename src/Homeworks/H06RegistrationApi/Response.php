<?php

namespace Kata\Homeworks\H06RegistrationApi;

class Response
{
    const PROPERTY_SUCCESS     = 'success';
    const PROPERTY_RESULT_CODE = 'resultCode';
    const PROPERTY_RESULT_ID   = 'resultId';
    const PROPERTY_MESSAGE     = 'resultMessage';
    
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
        return json_encode(array(
            self::PROPERTY_SUCCESS     => $this->success,
            self::PROPERTY_RESULT_CODE => $this->resultCode,
            self::PROPERTY_RESULT_ID   => $this->resultId,
            self::PROPERTY_MESSAGE     => $this->message,
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
    
    
    public function getSuccess()
    {
        return $this->success;
    }

    public function getResultCode()
    {
        return $this->resultCode;
    }

    public function getResultId()
    {
        return $this->resultId;
    }

    public function getMessage()
    {
        return $this->message;
    }
}
