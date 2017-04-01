<?php

namespace Modules\CodeBook\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\CodeBook\Models\Book;
use Modules\CodeUser\Models\User;

class BookPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->can(config('codebook.acl.permissions.book_manage_all'))) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the book.
     *
     * @param User $user
     * @param Book $book
     * @return boolean
     */
    public function view(User $user, Book $book)
    {
        return $user->id === $book->user_id;
    }

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
