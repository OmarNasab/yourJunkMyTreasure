<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     *
     * @param User $user
     * @param string $ability
     * @return void|bool
     */
    public function before(User $user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }


    public function update(User $user, Post $post): Response
    {
        return $user->id === $post->user_id ? Response::allow() : Response::denyWithStatus(404);
    }


    public function delete(User $user, Post $post): Response|bool
    {
        return $user->id === $post->user_id ? Response::allow() : Response::denyWithStatus(404);
    }

}
