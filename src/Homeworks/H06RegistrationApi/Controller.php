<?php

namespace Kata\Homeworks\H06RegistrationApi;


class Controller
{
    private $response;
    private $registrationRequest;
    private $autoRegistrationRequest;
    
    public function __construct()
    {
        $this->registrationRequest = 
            new Request('Radella Gleeddyecker', 'Ra5Glee', 'Ra5Glee');
        
        $this->autoRegistrationRequest =
            new Request('Radella Gleeddyecker');
        
        $this->response  = new Response();
    }
    
    public function registration()
    {
        try
        {
            $validator   = new Validator();
            $userBuilder = new UserBuilder();
            $userDao     = new UserDao();
            
            // Input validalas
            $validator->isValidUsername($this->registrationRequest->username);
            $validator->isValidPassword(
                $this->registrationRequest->password,
                $this->registrationRequest->passwordConfirm
            );
            
            // User letrehozas
            $user = $userBuilder->buildFromUsernameAndPass(
                $this->registrationRequest->username,
                $this->registrationRequest->password,
                new Generator()
            );
            
            // User mentes
            $insertedId = $userDao->store($user);
            
            // Response bealitas
            $this->setResponse(Response::SUCCESS_OK, Response::RESULT_CODE_OK, $insertedId);
            
        }
        catch (InvalidUsernameException $e)
        {
            // Response bealitas
            $this->setResponse(Response::SUCCESS_FAULT, Response::RESULT_CODE_USERNAME_FORMAT_ERROR,
                Response::RESULT_ID_FAILURE, $e->getMessage());
        }
        catch (UserExistsException $e)
        {
            // Response bealitas
            $this->setResponse(Response::SUCCESS_FAULT, Response::RESULT_CODE_USERNAME_EXISTS,
                Response::RESULT_ID_FAILURE, $e->getMessage());
            
        }
        catch (PasswordException $e)
        {
            // Response bealitas
            $this->setResponse(Response::SUCCESS_FAULT, Response::RESULT_CODE_PASSWORD_FORMAT_ERROR,
                Response::RESULT_ID_FAILURE, $e->getMessage());
        }
        catch (\Exception $e)
        {
            // Response bealitas
            $this->setResponse(Response::SUCCESS_FAULT, Response::RESULT_CODE_OTHER,
                Response::RESULT_ID_FAILURE, 'Fel 2 van bazmeg!');
        }

        $this->response->display();
    }
    
    public function autoRegistration()
    {
        try
        {
            $validator   = new Validator();
            $userBuilder = new UserBuilder();
            $userDao     = new UserDao();
            
            // Input validalas
            $validator->isValidUsername($this->autoRegistrationRequest->username);
            
            // User letrehozas
            $user = $userBuilder->buildFromUsername(
                $this->autoRegistrationRequest->username,
                new Generator()
            );
            
            // User mentes
            $insertedId = $userDao->store($user);
            
            // Response bealitas
            $this->setResponse(Response::SUCCESS_OK, Response::RESULT_CODE_OK, $insertedId);
            
        }
        catch (InvalidUsernameException $e)
        {
            // Response bealitas
            $this->setResponse(Response::SUCCESS_FAULT, Response::RESULT_CODE_USERNAME_FORMAT_ERROR,
                Response::RESULT_ID_FAILURE, $e->getMessage());
        }
        catch (UserExistsException $e)
        {
            // Response bealitas
            $this->setResponse(Response::SUCCESS_FAULT, Response::RESULT_CODE_USERNAME_EXISTS,
                Response::RESULT_ID_FAILURE, $e->getMessage());
            
        }
        catch (PasswordException $e)
        {
            // Response bealitas
            $this->setResponse(Response::SUCCESS_FAULT, Response::RESULT_CODE_PASSWORD_FORMAT_ERROR,
                Response::RESULT_ID_FAILURE, $e->getMessage());
        }
        catch (\Exception $e)
        {
            // Response bealitas
            $this->setResponse(Response::SUCCESS_FAULT, Response::RESULT_CODE_OTHER,
                Response::RESULT_ID_FAILURE, 'Fel 2 van bazmeg!');
        }

        $this->response->display();
    }
    
    private function setResponse($success, $responseCode, $responseId, $message = '')
    {
        $this->response->success    = $success;
        $this->response->resultCode = $responseCode;
        $this->response->resultId   = $responseId;
        $this->response->message    = $message;
    }
}
