<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\PermissionRole;
use App\Utils\Helper;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate();

        return view('roles.list', compact('roles'))
            ->with('i', (request()->input('page', 1) - 1) * $roles->perPage());
    }

    public function create()
    {
        Helper::generalPolicie(Auth::user(),'create');
        $permissions = Permission::all();
        return view('roles.create-edit',compact('permissions'));
    }

    public function store(Request $request)
    {
        Helper::generalPolicie(Auth::user(),'create');
        //validation du formulaire
        request()->validate(Role::$rules);

        //enregistrement du role
        $role = Role::create([
            'libelle' => $request->libelle
        ]);

        //association du role et des permission
        if(is_array($request->permissions)){
        foreach ($request->permissions as $permission_id) {
            PermissionRole::create([
                'permission_id' => $permission_id,
                'role_id' => $role->id
            ]);
        }}

        //retour à la vue
        return redirect()->route('roles.index')
            ->with('success', 'Role enregistré avec succés.');
    }

    public function show($id)
    {
        return redirect(route('roles.edit',$id));
    }

    public function edit($id)
    {
        Helper::generalPolicie(Auth::user(),'edit');
        $role = Role::find($id);
        $permissions = Permission::all();

        return view('roles.create-edit', compact('role','permissions'));
    }

    public function update(Request $request, Role $role)
    {
        Helper::generalPolicie(Auth::user(),'edit');
        //validation du formulaire
        request()->validate(Role::$rules);

        //mise a jour du role
        $role->update([
            'libelle' => $request->libelle
        ]);


        if(is_array($request->permissions)){
        //enregistrement des nouvelles permissions
        foreach ($request->permissions as $permission_id) {
            if(!Helper::existPermissionRole($permission_id, $role->id)){
                PermissionRole::create([
                    'permission_id' => $permission_id,
                    'role_id' => $role->id
                ]);
            }
        }

        //suppression des anciennes permissions
        $oldPermissions = $role->permissions;
        foreach ($oldPermissions as $permission) {
            if(!in_array($permission->id, $request->permissions)){
                $role = PermissionRole::where('permission_id', $permission->id)
                ->where('role_id', $role->id)->delete();
            }
        }}else{
            foreach ($role->permissionRoles as $value) {
                $value->delete();
            }
        }

        //retour vers index
        return redirect()->route('roles.index')
            ->with('success', 'Role modifié avec succés');
    }

    public function destroy($id)
    {
        Helper::generalPolicie(Auth::user(),'delete');
        $role = Role::findOrFail($id);

        foreach ($role->permissionRoles as $value) {
            $value->delete();
        }

        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Role supprimé avec succés');
    }
}
