<?php

namespace App\Http\Controllers;

use App\Models\Backend\RoleHasPermission;
use App\Http\Requests\RoleHasPermission\StoreRoleHasPermissionRequest;
use App\Http\Requests\RoleHasPermission\UpdateRoleHasPermissionRequest;
use App\Models\Backend\Permission;
use App\Models\Backend\Role;

class RoleHasPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.role_has_permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('backend.role_has_permissions.create', compact('roles', 'permissionGroups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleHasPermissionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(RoleHasPermission $roleHasPermission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoleHasPermission $roleHasPermission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleHasPermissionRequest $request, RoleHasPermission $roleHasPermission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoleHasPermission $roleHasPermission)
    {
        //
    }
}
