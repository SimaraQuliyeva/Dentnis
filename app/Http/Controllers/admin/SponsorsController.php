<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Sponsors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SponsorsController extends Controller
{
    public function index()
    {
        $sponsors = Sponsors::all();
        return view('admin.sponsors.index', compact('sponsors'));
    }

    public function create()
    {
        return view('admin.sponsors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        // img yuklemek ve add elemek
        $imgPath = $request->file('image')->store('sponsors_images', 'public');

        // Sponsor modelini ist ederek yenisini yaratmaq
//        $sponsor= new Sponsors();
//        $sponsor->image=$imgPath;
//        $sponsor->save();
        Sponsors::create([
            'image' => $imgPath,
        ]);

        return redirect()->route('admin.sponsors')->with('success', 'Sponsor added.');
    }


    public function edit(Sponsors $sponsor)
    {
        return view('admin.sponsors.edit', compact('sponsor'));
    }

    public function update(Request $request, Sponsors $sponsor)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('sponsors_images');
            Storage::delete($sponsor->image);
            $sponsor->image = $imagePath;
        }

        $sponsor->save();

        return redirect()->route('admin.sponsors')->with('success', 'Sponsor image updated successfully!');
    }



    public function destroy(Sponsors $sponsor)
    {
        $sponsor->delete();
        if (Storage::disk('public')->exists($sponsor->image)) {
            Storage::disk('public')->delete($sponsor->image);
        }
        $sponsor->delete();

        return redirect()->route('admin.sponsors')->with('success', 'Sponsor deleted successfully!');
    }

}
