<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SocialNetwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SocialNetworkController extends Controller
{
    public function showSocial(){
        $socials=SocialNetwork::all();
        return view('admin.social-networks.index',compact('socials'));
    }

    public function create()
    {
        return view('admin.social-networks.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'page_icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'page_name' => 'required|string',
            'url' => 'required',

        ]);

        $imagePath = $request->file('page_icon')->store('social_images','public');

        $socialNetwork = new SocialNetwork();
        $socialNetwork->page_icon = $imagePath;
        $socialNetwork->page_name = $request->input('page_name');
        $socialNetwork->page_url = $validatedData['url'];
        $socialNetwork->save();

        return redirect()->route('admin.social-networks')->with('success', 'Social network added');
    }

    public function edit(SocialNetwork $social)
    {
        return view('admin.social-networks.edit', compact('social'));
    }

    public function update(Request $request, SocialNetwork $social)
    {
        $validatedData = $request->validate([
            'page_icon' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'page_name' => 'required|string',
            'url' => 'required',
        ]);


        if ($request->hasFile('page_icon')) {
            $imagePath = $request->file('page_icon')->store('social_images');
            Storage::delete($social->page_icon);
            $social->page_icon = $imagePath;
        }


        $social->page_name = $request->input('page_name');
        $social->page_url = $validatedData['url'];
        $social->save();

        return redirect()->route('admin.social-networks')->with('success', 'Social network updated');
    }

    public function destroy($id)
    {
        $socialNetwork = SocialNetwork::findOrFail($id);
        $socialNetwork->delete();

        return redirect()->route('admin.social-networks')->with('success', 'Social network deleted');
    }

}
