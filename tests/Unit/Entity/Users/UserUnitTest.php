<?php

namespace Tests\Unit\Entity\Users;

use App\Entity\Users\Repositories\UserRepository;
use App\Entity\Users\User;
use Tests\TestCase;

class UserUnitTest extends TestCase
{

    public function test_create_user() : void
    {
        $data = [
            'name' => 'name',
            'email' => 'email',
            'password' => 'password',
        ];
        $user = new UserRepository(new User);
        $created = $user->createUser($data);

        $this->assertInstanceOf(User::class, $created);
        $this->assertEquals($data['name'], $created->name);
        $this->assertEquals($data['email'], $created->email);
        $this->assertNotEmpty($created->password);
        $this->assertNotEquals($data['password'], $created->password);

        $collection = collect($data)->except('password');

        $this->assertDatabaseHas('users', $collection->all());

        $this->assertFalse($user->isAdmin());
    }

    public function test_role_users() : void
    {
        $user = User::factory()->create();
        $repo = new UserRepository($user);
        $this->assertFalse($repo->isAdmin());
        $repo->changeRole(User::ROLE_ADMIN);
        $this->assertTrue($repo->isAdmin());
    }

    public function test_role_already_exist()
    {
        $user = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $repo = new UserRepository($user);
        $this->expectExceptionMessage('Role is already assigned.');
        $repo->changeRole(User::ROLE_ADMIN);
    }
}
