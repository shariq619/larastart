<?php

namespace App\Http\Controllers;

use App\Mail\SendUserEmail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //$users = User::findOrFail(1);
        //Mail::to('some@mail.com')->send(new SendUserEmail($users));

        //$role = Role::create(['name' => 'reader']);
        //$permission = Permission::create(['name' => 'edit reader']);

        //$role->givePermissionTo($permission);
        //$permission->assignRole($role);

        return view('home');
    }
}
