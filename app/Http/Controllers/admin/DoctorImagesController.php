<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DoctorImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DoctorImagesController extends Controller
{
    public function showDImages()
    {
        $dImages = DoctorImages::all();
        return view('admin.doctor-images.index', compact('dImages'));
    }

    public function create()
    {
        return view('admin.doctor-images.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',

        ]);

        $imagePath = $request->file('image')->store('doctor_images','public');

        DoctorImages::create([
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.doctor-images')->with('success', 'Image added');
    }

    public function edit(DoctorImages $dImage){
        return view('admin.doctor-images.edit', compact('dImage'));
    }

    public function update(Request $request, DoctorImages $dImage)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('doctor_images');
            Storage::delete($dImage->image);
            $dImage->image = $imagePath;
        }

        $dImage->save();

        return redirect()->route('admin.doctor-images')->with('success', 'Image updated successfully!');
    }


    public function destroy(DoctorImages $dImage)
    {
        $dImage->delete();
        if (Storage::disk('public')->exists($dImage->image)) {
            Storage::disk('public')->delete($dImage->image);
        }
        $dImage->delete();

        return redirect()->route('admin.doctor-images')->with('success', 'Image deleted successfully!');
    }

}
