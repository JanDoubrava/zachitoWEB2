<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Gallery;
use Illuminate\Auth\Access\HandlesAuthorization;

class GalleryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any gallery items.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the gallery item.
     */
    public function view(User $user, Gallery $gallery): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create gallery items.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the gallery item.
     */
    public function update(User $user, Gallery $gallery): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the gallery item.
     */
    public function delete(User $user, Gallery $gallery): bool
    {
        return $user->isAdmin();
    }
} 