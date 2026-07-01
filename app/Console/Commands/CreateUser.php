<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateUser extends Command
{
    protected $signature = 'user:create {email} {password} {name=Admin}';
    protected $description = 'Create or update a user with given credentials';

    public function handle(): int
    {
        $email = $this->argument('email');
        $password = $this->argument('password');
        $name = $this->argument('name');

        $v = Validator::make(['email' => $email], ['email' => 'required|email']);
        if ($v->fails()) {
            $this->error('Invalid email');
            return self::FAILURE;
        }

        $user = User::updateOrCreate(
            ['email' => $email],
            ['name' => $name, 'password' => Hash::make($password)]
        );

        $this->info("User ready: {$user->email} (id={$user->id})");
        return self::SUCCESS;
    }
}
