<?php

namespace App\Http\Controllers;

use App\Utils\Helper;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class PermissionController
 * @package App\Http\Controllers
 */
class PermissionController extends Controller
{
    public function index()
    {

        $permissions = Permission::paginate();

        return view('permissions.list', compact('permissions'))
            ->with('i', (request()->input('page', 1) - 1) * $permissions->perPage());
    }

    public function create()
    {
        Helper::generalPolicie(Auth::user(),'create');
        return view('permissions.create-edit');
    }

    public function store(Request $request)
    {
        Helper::generalPolicie(Auth::user(),'create');
        $this->validate($request,Permission::$rules);

        Permission::create($request->all());

        return redirect()->route('permissions.index')
            ->with('success', 'Permission enregistrée avec succés.');
    }

    public function show($id)
    {
        return redirect(route('permissions.edit',$id));
    }

    public function edit($id)
    {
        Helper::generalPolicie(Auth::user(),'edit');
        $permission = Permission::find($id);

        return view('permissions.create-edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        Helper::generalPolicie(Auth::user(),'edit');
        request()->validate(Permission::$rules);

        $permission->update($request->all());

        return redirect()->route('permissions.index')
            ->with('success', 'Permission modifiée avec succés');
    }

    public function destroy($id)
    {
        Helper::generalPolicie(Auth::user(),'delete');
        $permission = Permission::findOrFail($id);
        foreach ($permission->permissionRoles as $value) {
            $value->delete();
        }

        foreach ($permission->permissionUsers as $value) {
            $value->delete();
        }

        $permission->delete();

        return redirect()->route('permissions.index')
            ->with('success', 'Permission supprimée avec succés');
    }
}
