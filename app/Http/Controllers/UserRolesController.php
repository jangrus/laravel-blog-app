<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRoles;
use Illuminate\Http\Request;

class UserRolesController extends Controller
{

    public function checkUserRole(User $user){
        return UserRoles::where('user_id', $user->id)->get()->role_id;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserRoles $user_roles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserRoles $user_roles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserRoles $userRoles)
    {
       $a= $request->post();

        foreach ($request->post() as $key => $value) {
            if (strpos($key, 'role_id_') === 0) {
                $userId=substr($key, strlen('role_id_'));
                UserRoles::where('user_id', '=', $userId)->update([
                    'role_id' => $value
                ]);
                $filteredData[$key] = $value;
            }
        }

        return view('profile.edit-user-roles', [
            'users' => User::all(),
            'roles' => Role::all(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserRoles $user_roles)
    {
        //
    }
}
