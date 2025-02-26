<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function page()
    {
        $roles = Role::paginate(15);

        return view('roles.roles', [
            'roles' => $roles
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $query = Role::query();

        if ($search) {
            $query->where('name', 'like', "%$search%");
        }

        $roles = $query->paginate(15);

        return view('roles.roles', [
            'roles' => $roles,
        ]);
    }

    public function addPage()
    {
        return view('roles.add');
    }

    public function addRole(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:100',
        ], [
            'name.required' => 'The role name is required.',
            'name.min' => 'The role name must have at least :min characters.',
            'name.max' => 'The role name must have at most :max characters.'
        ]);

        $name = $request->input('name');
        $description = $request->input('description');

        $role = new Role();
        $role->name = $name;
        $role->description = $description;
        $role->save();

        return redirect(route('roles'));
    }

    public function editPage($role_id)
    {

        $permissions = Permission::all();
        $role = Role::where('id', $role_id)->first();

        if (!$role) return redirect()->back();

        return view('roles.edit', [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

    public function editRole(Request $request, $role_id)
    {

        $role = Role::where('id', $role_id)->first();

        if (!$role) return redirect()->back();

        $request->validate([
            'name' => 'required|min:3|max:100',
        ], [
            'name.required' => 'The role name is required.',
            'name.min' => 'The role name must have at least :min characters.',
            'name.max' => 'The role name must have at most :max characters.',
        ]);

        $permissions = Permission::all();

        $name = $request->input('name');
        $description = $request->input('description');

        foreach ($permissions as $index => $permission) {
            $permission_check_field = $request->input($index + 1);

            $role_permission = RolePermission::where('role_id', $role->id)
                ->where('permission_id', $permission->id)->first();

            if ($role_permission && !$permission_check_field) $role_permission->delete();
            elseif (!$role_permission && $permission_check_field) {
                $role_permission = new RolePermission();
                $role_permission->role_id = $role->id;
                $role_permission->permission_id = $permission->id;
                $role_permission->save();
            }
        }

        $role->name = $name;
        $role->description = $description;
        $role->save();

        return redirect(route('roles'));
    }

    public function deleteRole($role_id)
    {
        $role = Role::where('id', $role_id)->first();
        if (!$role) return redirect()->back();

        $role->delete();
        return redirect(route('roles'));
    }
}
