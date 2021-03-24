<?php

namespace App\Hydrator;

use App\Entity\User;

class UserHydrator
{
    public function hydrateUser(array $data): User
    {
        $user = new User();
        $user->id = $data['id'] ?? null;
        $user->name = $data['username'];
        $user->email = $data['email'];
        $user->password = $data['password'];

        return $user;
    }
}
