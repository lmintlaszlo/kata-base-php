<?php

namespace Kata\Homeworks\H06RegistrationApi;


class Controller
{
    private $response;
    private $validator;
    private $userBuilder;
    private $userDao;
    
    public function __construct(Response $response, UserDao $userDao)
    {
        $this->response = $response;
        $this->userDao  = $userDao;
        
//        $this->registrationRequest = 
//            new Request('Radella Gleeddyecker', 'Ra5Glee', 'Ra5Glee');
//        
//        $this->autoRegistrationRequest =
//            new Request('Radella Gleeddyecker');
        
    }
    
    public function registration(Generator $generator, Request $request,
        UserBuilder $userBuilder, Validator $validator)
    {
        try
        {            
            // Input validalas
            $validator->isValidUsername($request->username);
            $validator->isValidPassword(
                $request->password,
                $request->passwordConfirm
            );
            
            // User letrehozas
            $user = $userBuilder->buildFromUsernameAndPass(
                $request->username,
                $request->password,
                $generator
            );
            
            // User mentes
            $insertedId = $this->userDao->store($user);
            
            // Response bealitas
            $this->setResponse(Response::SUCCESS_OK, Response::RESULT_CODE_OK, $insertedId);
            
        }
        catch (InvalidUsernameException $e)
        {
            // Response bealitas
            $this->setResponse(Response::SUCCESS_FAILURE, Response::RESULT_CODE_USERNAME_FORMAT_ERROR,
                Response::RESULT_ID_FAILURE, $e->getMessage());
        }
        catch (UserExistsException $e)
        {
            // Response bealitas
            $this->setResponse(Response::SUCCESS_FAILURE, Response::RESULT_CODE_USERNAME_EXISTS,
                Response::RESULT_ID_FAILURE, $e->getMessage());
            
        }
        catch (PasswordException $e)
        {
            // Response bealitas
            $this->setResponse(Response::SUCCESS_FAILURE, Response::RESULT_CODE_PASSWORD_FORMAT_ERROR,
                Response::RESULT_ID_FAILURE, $e->getMessage());
        }
        catch (\Exception $e)
        {
            // Response bealitas
            $this->setResponse(Response::SUCCESS_FAILURE, Response::RESULT_CODE_OTHER,
                Response::RESULT_ID_FAILURE, 'Fel 2 van bazmeg!');
        }

        return $this->response->display();
    }
    
    public function autoRegistration(Generator $generator, Request $request,
        UserBuilder $userBuilder, Validator $validator)
    {
        try
        {            
            // Input validalas
            $validator->isValidUsername($request->username);
            
            // User letrehozas
            $user = $userBuilder->buildFromUsername(
                $request->username,
                $generator
            );
            
            // User mentes
            $insertedId = $this->userDao->store($user);
            
            // Response bealitas
            $this->setResponse(Response::SUCCESS_OK, Response::RESULT_CODE_OK, $insertedId);
            
        }
        catch (InvalidUsernameException $e)
        {
            // Response bealitas
            $this->setResponse(Response::SUCCESS_FAILURE, Response::RESULT_CODE_USERNAME_FORMAT_ERROR,
                Response::RESULT_ID_FAILURE, $e->getMessage());
        }
        catch (UserExistsException $e)
        {
            // Response bealitas
            $this->setResponse(Response::SUCCESS_FAILURE, Response::RESULT_CODE_USERNAME_EXISTS,
                Response::RESULT_ID_FAILURE, $e->getMessage());
            
        }
        catch (PasswordException $e)
        {
            // Response bealitas
            $this->setResponse(Response::SUCCESS_FAILURE, Response::RESULT_CODE_PASSWORD_FORMAT_ERROR,
                Response::RESULT_ID_FAILURE, $e->getMessage());
        }
        catch (\Exception $e)
        {
            // Response bealitas
            $this->setResponse(Response::SUCCESS_FAILURE, Response::RESULT_CODE_OTHER,
                Response::RESULT_ID_FAILURE, 'Fel 2 van bazmeg!');
        }

        $this->response->display();
    }
    
    private function setResponse($success, $responseCode, $responseId, $message = '')
    {
        $this->response->setSuccess($success);
        $this->response->setResultCode($responseCode);
        $this->response->setResultId($responseId);
        $this->response->setMessage($message);
    }
}
