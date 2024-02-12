<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Youtubes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class YoutubeController extends Controller
{
    public function showYoutube(){
        $youtubes = Youtubes::all();
        return view('admin.youtube.index', compact('youtubes'));
    }

    public function create()
    {
        return view('admin.youtube.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'url' => 'required',

        ]);

        Youtubes::create([
            'url' => $validatedData['url'],
        ]);

        return redirect()->route('admin.youtube')->with('success', 'Youtube added');
    }


    public function edit(Youtubes $youtube){
        return view('admin.youtube.edit', compact('youtube'));
    }

    public function update(Request $request, Youtubes $youtube)
    {
        $request->validate([
            'url' => 'required',
        ]);

        $youtube->url = $request->input('url');
        $youtube->save();

        return redirect()->route('admin.youtube')->with('success', 'Youtube updated successfully!');
    }


    public function destroy(Youtubes $youtube)
    {
        $youtube->delete();
        // Slider'ı sil
        $youtube->delete();

        return redirect()->route('admin.youtube')->with('success', 'Youtube deleted successfully!');
    }
}
