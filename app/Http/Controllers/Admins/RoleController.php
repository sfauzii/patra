<?php

namespace App\Http\Controllers\Admins;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with(['users' => function ($query) {
            $query->select('id', 'name');
        }])->withCount('users')->get();

        return view('pages.admins.roles-permissions.role.index', [
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admins.roles-permissions.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:roles,name'],
        ]);

        Role::create([
            'name' => $request->name,
        ]);

        Alert::success('Success', 'Roles created succesfully.');

        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('pages.admins.roles-permissions.role.edit', [
            'role' => $role,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:roles,name,' . $role->id],
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        Alert::success('Success', 'Roles updated succesfully.');

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        $role->delete();

        Alert::success('Success', 'Role deleted succesfully.');

        return redirect()->route('roles.index');
    }

    public function addPermissionsToRole($roleId)
    {
        $permissions = Permission::get();
        $role = Role::findOrFail($roleId);
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('pages.admins.roles-permissions.role.add-permissions', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions,
        ]);
    }

    public function givePermissionsToRole(Request $request, $roleId)
    {
        // Debug untuk melihat data permission yang dikirimkan
        // dd($request->permission);

        // Lakukan validasi
        $request->validate([
            'permission' => 'required|array',
            'permission.*' => 'exists:permissions,id', // Sesuaikan dengan UUID
        ]);

        // Lakukan sinkronisasi permissions dengan role menggunakan UUID
        $role = Role::findOrFail($roleId);
        $permissions = Permission::whereIn('id', $request->permission)->get();
        $role->syncPermissions($permissions);

        Alert::success('Success', 'Permissions added to role');
        return redirect()->back();
    }
}
