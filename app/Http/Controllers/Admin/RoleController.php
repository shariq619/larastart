<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $permission = Role::all();
        // Sharing is caring
        View::share('total', $permission->count());
    }

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $roles = Role::orderByDesc('id')->get();
        return view('admin.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);
        $data['guard_name'] = 'admin';
        $role = Role::create($data);

        //
        $permissions = $request->input('permissions');
        $role->syncPermissions($permissions);


        return redirect()->back()->with('message', 'Role Added');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        $role = Role::find($id);
        return view('admin.roles.show',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $all_permissions = Permission::all();
        $perm = $role->getAllPermissions();
        $permissions = $perm->pluck('id')->toArray();
        return view('admin.roles.edit',compact('role','all_permissions','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);
        $role = Role::find($id);
        $data['guard_name'] = 'admin';
        $role->update($data);

        $permissions = $request->input('permissions');
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('message', 'Role Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        return redirect()->route('roles.index')->with('message', 'Role Deleted Successfully');
    }
}
