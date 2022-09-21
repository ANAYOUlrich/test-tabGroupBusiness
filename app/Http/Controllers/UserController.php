<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Utils\Helper;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionUser;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate();

        return view('users.list', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * $users->perPage());
    }

    public function create()
    {
        Helper::generalPolicie(Auth::user(),'create');
        $roles = Role::all();
        $permissions = Permission::all();
        return view('users.create-edit', compact('roles','permissions'));
    }

    public function store(Request $request)
    {

        Helper::generalPolicie(Auth::user(),'create');
        request()->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password'  => 'required|confirmed|min:4',
            'password_confirmation' => 'required',
            'role_id' => '',
            'permissions' => '',
        ]);

        $user = User::create([
            'name' =>  $request->name,
            'email' =>  $request->email,
            'password' =>  Hash::make($request->password),
            'role_id'=> $request->role_id
        ]);

        //association du user et des permission
        if(is_array($request->permissions)){
            foreach ($request->permissions as $permission_id) {
                PermissionUser::create([
                    'permission_id' => $permission_id,
                    'user_id' => $user->id
                ]);
            }
        }

        return redirect()->route('users.index')
            ->with('success', 'Utilisateur enregistré avec succés.');
    }

    public function show($id)
    {
        return redirect(route('users.edit',$id));
    }

    public function edit($id)
    {
        Helper::generalPolicie(Auth::user(),'edit');
        $user = User::find($id);
        $roles = Role::all();
        $permissions = Permission::all();

        return view('users.create-edit', compact('user','roles','permissions'));
    }

    public function update(Request $request, User $user)
    {
        Helper::generalPolicie(Auth::user(),'edit');
        $user = User::findOrFail($user->id);
        request()->validate([
            'name' => 'required|max:255',
            'email' => ['required','email',Rule::unique('users')->ignore($user->id)],
            'role_id' => '',
            'permissions' => '',
        ]);

        $user->update(
            [
                'name' =>  $request->name,
                'email' =>  $request->email,
                'role_id'=> $request->role_id
            ]
        );

        if(is_array($request->permissions)){
            //enregistrement des nouvelles permissions
            foreach ($request->permissions as $permission_id) {
                if(!Helper::existPermissionUser($permission_id, $user->id)){
                    PermissionUser::create([
                        'permission_id' => $permission_id,
                        'user_id' => $user->id
                    ]);
                }
            }

            //suppression des anciennes permissions
            $oldPermissions = $user->permissions;
            $user_id = $user->id;
            foreach ($oldPermissions as $permission) {
                if(!in_array($permission->id, $request->permissions)){
                    $user = PermissionUser::where('permission_id', $permission->id)
                    ->where('user_id', ''.$user_id)->delete();
                }
            }}else{
                foreach ($user->PermissionUsers as $value) {
                    $value->delete();
                }
            }

        return redirect()->route('users.index')
            ->with('success', "Utilisateur modifié avec succés");
    }

    public function destroy($id)
    {
        Helper::generalPolicie(Auth::user(),'delete');
        $user = User::findOrFail($id);

        foreach ($user->permissionUsers as $value) {
            $value->delete();
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Utilisateur supprimé avec succés');
    }
}
