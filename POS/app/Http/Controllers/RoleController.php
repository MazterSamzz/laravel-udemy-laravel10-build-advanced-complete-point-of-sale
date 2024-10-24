<?php

namespace App\Http\Controllers;

use App\Models\Backend\Role;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Models\Backend\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('backend.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissionGroups = Permission::ByGroupName();
        return view('backend.roles.create', compact('permissionGroups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {

        $data = $request->only('role', 'permissions');
        $oldPermissions = $data['permissions'];
        $data['permissions'] = Permission::whereIn('id', $data['permissions'])
            ->pluck('name')->toArray();

        DB::beginTransaction();
        try {
            $role = Role::create($data['role']);
            $role->givePermissionTo($data['permissions']);

            DB::commit();

            return to_route('roles.index')->with([
                'message' => 'Role created successfully.',
                'alert-type' => 'success',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return back()->with([
                'message' => 'Something went wrong.',
                'alert-type' => 'error',
                'oldPermissions' => $oldPermissions,
            ])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $permissionGroups = Permission::ByGroupName();
        $rolePermissions = $role->permissions;

        $encryptedIds = $permissions->filter(function ($permission) use ($rolePermissions) {
            // Periksa apakah rolePermissions mengandung permission ini
            return $rolePermissions->contains('id', $permission->id);
        })->pluck('encryptedId')->toArray();

        return view('backend.roles.edit', compact('role', 'permissions', 'permissionGroups', 'encryptedIds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->validated());
        return to_route('roles.index')->with(['message' => 'Role updated successfully.', 'alert-type' => 'success',]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return to_route('roles.index')->with(['message' => 'Role deleted successfully.', 'alert-type' => 'success',]);
    }
}
