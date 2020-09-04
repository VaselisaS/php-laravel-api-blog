<?php

namespace App\Http\Controllers;

use App\Entity\Users\Repositories\Interfaces\UserRepositoryInterface;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use \Auth;

class AuthController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepo;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepo = $userRepository;
    }

    public function register(StoreUserRequest $request)
    {
        $user = $this->userRepo->createUser($request->all());
        return new UserResource($user);
    }

    public function login(LoginUserRequest $request)
    {
        return $this->userRepo->loginUser($request->all());
    }

    public function logout()
    {
        $user = Auth::user();
        $this->userRepo->logoutUser($user);
        return response()->json(__('auth.logout'));
    }
}
