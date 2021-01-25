<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AdminBadge;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminBadgeController extends Controller
{
    public function __construct()
    {
        $badges = AdminBadge::all();
        // Sharing is caring
        View::share('total', $badges->count());
    }

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $badges = AdminBadge::orderByDesc('id')->get();
        return view('admin.badges.index',compact('badges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.badges.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $badge = new AdminBadge;
        $badge->name = $request->name;

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move(public_path('img/badges/'), $imageName);

            $badge->image = $imageName;
        }

        $badge->save();

        return redirect()->back()->with('message', 'Badge Added');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        $badge = AdminBadge::find($id);
        return view('admin.badges.show',compact('badge'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        $badge = AdminBadge::find($id);
        return view('admin.badges.edit',compact('badge'));
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
        $request->validate([
            'name' => 'required',
        ]);

        $badge = AdminBadge::find($id);

        $badge->name = $request->name;

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move(public_path('img/badges/'), $imageName);

            $badge->image = $imageName;
        }


        $badge->save();

        return redirect()->route('badges.index')->with('message', 'Badge Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        $badge = AdminBadge::find($id);
        $badge->delete();
        return redirect()->route('badges.index')->with('message', 'Badge Deleted Successfully');
    }
}
