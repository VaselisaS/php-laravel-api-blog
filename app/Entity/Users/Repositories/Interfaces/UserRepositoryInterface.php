<?php


namespace App\Entity\Users\Repositories\Interfaces;


use App\Entity\Users\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as Support;

interface UserRepositoryInterface
{
    public function listUsers(string $order = 'id', string $sort = 'desc', array $columns = ['*']) : Support;

    public function createUser(array $params) : User;

    public function loginUser(array $params);

    public function logoutUser(User $user);

    public function updateUser(array $params) : bool;

    public function findUserById(int $id) : User;

    public function deleteUser() : bool;

    public function searchUser(string $text) : Collection;

    public function isAdmin() : bool;

    public function changeRole(string $role);
}
