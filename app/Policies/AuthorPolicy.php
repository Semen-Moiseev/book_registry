<?php

namespace App\Policies;

use App\Models\Author;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AuthorPolicy
{
    public function update(User $user, Author $author) {
        return $user->id-1 === $author->id;
    }
}
