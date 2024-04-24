<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Enums\RoleUserEnum;

class CompanyPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Company $company): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->role == RoleUserEnum::USERVIP->value || $user->role == RoleUserEnum::ADMIN->value){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Company $company): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Company $company): bool
    {
        return $this->update($user, $company);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Company $company): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Company $company): bool
    {
        //
    }

    public function viewActivities(User $user, Company $company)
    {
        return true;
    }

    public function updateActivities(User $user, Company $company)
    {
        return $this->update($user, $company);
    }

    public function attachActivities(User $user, Company $company)
    {
        return $this->update($user, $company);
    }

    public function detachActivities(User $user, Company $company)
    {
        return $this->update($user, $company);
    }
}
