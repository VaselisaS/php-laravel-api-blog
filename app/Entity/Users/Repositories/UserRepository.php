<?php


namespace App\Entity\Users\Repositories;


use App\Entity\BaseRepository;
use App\Entity\Users\Exceptions\LoginUserBadResponseException;
use App\Entity\Users\Repositories\Interfaces\UserRepositoryInterface;
use App\Entity\Users\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as Support;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        parent::__construct($user);
        $this->model = $user;
    }


    public function listUsers(string $order = 'id', string $sort = 'desc', array $columns = ['*']): Support
    {
        // TODO: Implement listUsers() method.
    }

    public function updateUser(array $params): bool
    {
        return $this->model->update($params);
    }

    public function findUserById(int $id): User
    {
        return $this->model->findOrFail($id);
    }

    public function deleteUser(): bool
    {
        // TODO: Implement deleteUser() method.
    }

    public function searchUser(string $text): Collection
    {
        // TODO: Implement searchUser() method.
    }

    public function createUser(array $params): User
    {
        return User::create([
            'name' => $params['name'],
            'email' => $params['email'],
            'password' => bcrypt($params['password']),
        ]);
    }

    public function loginUser(array $params)
    {
        $url = config('passport.url_token');
        $http = new Client;
        try {
            $response = $http->post($url, [
                'verify' => config('passport.verify'),
                'form_params' => [
                    "grant_type" => "password",
                    "client_id" => config('passport.personal_access_client.id'),
                    "client_secret" => config('passport.personal_access_client.secret'),
                    "username" => $params['email'],
                    "password" => $params['password'],
                ]
            ]);
            return json_decode((string) $response->getBody(), true);
        } catch (BadResponseException $e) {
            $exception = new LoginUserBadResponseException($e->getCode());
            return $exception->getResponse();
        }
    }

    public function logoutUser(User $user)
    {
        $user->tokens->each(function ($token, /** @noinspection PhpUnusedParameterInspection */ $key) {
            $token->delete();
        });
    }
}
