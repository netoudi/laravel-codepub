<?php

namespace Modules\CodeBook\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\CodeBook\Models\Book;
use Modules\CodeUser\Models\User;

class BookPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the book.
     *
     * @param User $user
     * @param Book $book
     * @return boolean
     */
    public function update(User $user, Book $book)
    {
        return $user->id === $book->user_id;
    }

    /**
     * Determine whether the user can delete the book.
     *
     * @param User $user
     * @param Book $book
     * @return boolean
     */
    public function delete(User $user, Book $book)
    {
        return $user->id === $book->user_id;
    }
}
