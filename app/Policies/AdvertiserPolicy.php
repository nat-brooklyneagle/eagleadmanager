<?php

namespace App\Policies;

use App\Models\Advertiser;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AdvertiserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response|bool
    {
        return !is_null($user->current_team_id);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Advertiser $advertiser): Response|bool
    {
        return !is_null($user->current_team_id) && $advertiser->team_id === $user->current_team_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response|bool
    {
        return !is_null($user->current_team_id);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Advertiser $advertiser): Response|bool
    {
        return !is_null($user->current_team_id) && $advertiser->team_id === $user->current_team_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Advertiser $advertiser): Response|bool
    {
        return !is_null($user->current_team_id) && $advertiser->team_id === $user->current_team_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Advertiser $advertiser): Response|bool
    {
        return !is_null($user->current_team_id) && $advertiser->team_id === $user->current_team_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Advertiser $advertiser): Response|bool
    {
        return !is_null($user->current_team_id) && $advertiser->team_id === $user->current_team_id;
    }
}
