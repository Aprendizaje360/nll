<?php

namespace App\Http\Services\Api;

//Repository
use App\Http\Repositories\UserRepository;

//Entities
use App\Entities\User;

//Special libraries used for excel and dates
use Carbon\Carbon;

/**
 * Class that hadles interaction with the User repository ad other needed logic
 */
class UserService
{
	protected $userRepo;

    /**
     * Instatiates the userRepo variable
     * @param UserRepository $userRepo instance of User repository
     */
    public function __construct(UserRepository $userRepo)
    {
    	$this->userRepo = $userRepo;
    }

    /**
     * Returns a user by its email
     * @param  String $email Email to search
     * @return User          User
     */
    public function findUserByEmail($email)
    {
        return $this->userRepo->where(['email_company' => $email])->first();
    }

    /**
     * Updates a user instance with data received from app
     * @param  Dictionary   $data Data received
     * @param  User         $user User to update
     * @return Void               Nothing
     */
    public function updateUser($data, $user)
    {
        $this->userRepo->update($data, $user);
    }
}