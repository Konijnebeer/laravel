<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\UserPermission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('role.roles', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = UserPermission::cases();
        return view('role.create', ['permissions' => $permissions]);
//        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $role = new Role();
        $role->name = $request->input('name');
        $role->permission = $request->input('permission');

        $role->save();
//        $role_id = $role->id;
////        dd($role_id);
//        $role_url = "roles/$role_id";
//        dd($role_url);
        redirect("roles/$role->id");
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
//        $role = Role::find($roles);
//        dd($roles);
        return view('role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $roles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $roles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        dd($role);
    }
}
