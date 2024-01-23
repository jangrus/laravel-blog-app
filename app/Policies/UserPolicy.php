<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserRoles;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{

    public function isAdminRole(): bool
    {
        $userRole = UserRoles::where('user_id', Auth::id())->get();
        if(isset($userRole[0])){
            return ($userRole[0]->role_id === 1);
        }
        return 0;

    }

    public function isPosterRole(): bool
    {
        $userRole = UserRoles::where('user_id', Auth::id())->get();
        if(isset($userRole[0])){
            return ($userRole[0]->role_id === 2);
        }
        return 0;

    }

    public function isCommenterRole(): bool
    {
        $userRole = UserRoles::where('user_id', Auth::id())->get();
        if(isset($userRole[0])
            && ($userRole[0]->role_id === 3
            || $userRole[0]->role_id === 2)){
            return 1;
        }
        return 0;

    }

    public function update(): bool
    {
        $userRole = UserRoles::where('user_id', Auth::id())->get();
        return ($userRole === 1);
    }


    public function delete(): bool
    {
        $userRole = UserRoles::where('user_id', Auth::id())->get();
        return ($userRole === 1);    }
}
