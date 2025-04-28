<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BookPolicy
{
    public function update(User $user, Book $book) {
        return $user->id-1 === $book->author_id;
    }

    public function delete(User $user, Book $book) {
        return $user->id-1 === $book->author_id;
    }
}
