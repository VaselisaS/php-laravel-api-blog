<?php

namespace App\Console\Commands\User;

use App\Entity\Users\Repositories\UserRepository;
use App\Entity\Users\User;
use Illuminate\Console\Command;

class RoleCommand extends Command
{
    protected $signature = 'user:role {email} {role}';

    protected $description = 'Set role for user';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $email = $this->argument('email');
        $role = $this->argument('role');
        if (!$user = User::where('email', $email)->first()) {
            $this->error("Undefined user with email $email");
            return false;
        }
        $repo = new UserRepository($user);
        try {
            $repo->changeRole($role);
        } catch (\DomainException $e) {
            $this->error($e->getMessage());
            return false;
        }
        $this->info("role is update");
        return true;
    }
}
