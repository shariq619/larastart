<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AdminAd;
use App\Models\Admin\AdminBadge;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminAdController extends Controller
{
    public function __construct()
    {
        $ads = AdminAd::all();
        // Sharing is caring
        View::share('total', $ads->count());
    }

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $ads = AdminAd::orderByDesc('id')->get();
        return view('admin.ads.index',compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.ads.create');
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
            'type' => 'required',
        ]);

        $ad = new AdminAd;
        $ad->name = $request->name;
        $ad->url = $request->url;
        $ad->type = $request->type;

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move(public_path('img/ads/'), $imageName);

            $ad->image = $imageName;
        }

        $ad->save();
        return redirect()->back()->with('message', 'Ad/Banner Added');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        $ad = AdminAd::find($id);
        return view('admin.ads.show',compact('ad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        $ad = AdminAd::find($id);
        return view('admin.ads.edit',compact('ad'));
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

        $ad = AdminAd::find($id);

        $ad->name = $request->name;
        $ad->url = $request->url;
        $ad->type = $request->type;

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move(public_path('img/ads/'), $imageName);

            $ad->image = $imageName;
        }


        $ad->save();

        return redirect()->route('ads.index')->with('message', 'Ad/Banner Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        $role = AdminAd::find($id);
        $role->delete();
        return redirect()->route('ads.index')->with('message', 'Ad/Banner Deleted Successfully');
    }
}
