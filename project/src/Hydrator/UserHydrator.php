<?php

namespace App\Hydrator;

use App\Entity\User;

class UserHydrator
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function hydrateUser(array $data): User
    {
        $user = clone $this->user;          //If you don't clone, old data will stay in hydrator
        $user->id = $data['id'] ?? null;
        $user->name = $data['username'];
        $user->email = $data['email'];
        $user->password = $data['password'];

        return $user;
    }
}
