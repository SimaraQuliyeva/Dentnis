<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlidersController extends Controller
{
    public function showSliders(){
        $sliders = Slider::all();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'url' => 'required',

        ]);

        $imagePath = $request->file('image')->store('slider_images','public');

        Slider::create([
            'image' => $imagePath,
            'url' => $validatedData['url'],
        ]);

        return redirect()->route('admin.sliders')->with('success', 'Slider added');
    }

    public function edit(Slider $slider){
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp',
            'url' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('slider_images');
            Storage::delete($slider->image);
            $slider->image = $imagePath;
        }

        $slider->url = $request->input('url');
        $slider->save();

        return redirect()->route('admin.sliders')->with('success', 'Slider updated successfully!');
    }


    public function destroy(Slider $slider)
    {
        $slider->delete();
        if (Storage::disk('public')->exists($slider->image)) {
            Storage::disk('public')->delete($slider->image);
        }
        $slider->delete();

        return redirect()->route('admin.sliders')->with('success', 'Slider deleted successfully!');
    }
}

