<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\AboutTranslation;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function showAbout(){
        $abouts = About::all();
        return view('admin.about.about',compact('abouts'));
    }
    public function create()
    {
        $languages = [];
        return view('admin.about.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'youtube' => 'required',
        ]);

        $langs = config('app.languages');
        $validationRules = [];
        foreach ($langs as $lang) {
            $validationRules["description_$lang"] = 'required|string';
        }
        $request->validate($validationRules);

        $imagePath = $request->file('image')->store('about_images');

        $about = new About();
        $about->image = $imagePath;
        $about->youtube = $request->input('youtube');
        $about->save();

        foreach (config('app.languages') as $lang) {
            $language = Language::where('lang', $lang)->first();
            $langId = $language->id;

            // Translation varsa dəyiş, yoxsa yarat
            $aboutTranslation = new AboutTranslation();
            $aboutTranslation->description = $request->input("description_$lang");
            $aboutTranslation->about_id = $about->id;
            $aboutTranslation->language_id = $langId;
            $aboutTranslation->save();
        }
        return redirect()->route('admin.about')->with('success', 'About information added!');
    }

    public function edit(About $about)
    {
        return view('admin.about.edit', compact('about'));
    }


    public function update(Request $request)
    {

        $langs = config('app.languages');

        $validationRules = [];
        foreach ($langs as $lang) {
            $validationRules["description_$lang"] = 'required';
        }
        $validationRules['image'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';


        $request->validate($validationRules);

        $aboutId = $request->input('aboutId');
        $about = About::find($aboutId);

        foreach ($langs as $lang) {
            $language = Language::where('lang', $lang)->first();
            $langId = $language->id;

            $aboutTranslation = AboutTranslation::updateOrCreate(
                ['about_id' => $aboutId, 'language_id' => $langId],
                [
                    'description' => $request->input("description_$lang"),
                    'about_id' => $aboutId,
                ]
            );

            $aboutTranslation->description = $request->input("description_$lang");
            $aboutTranslation->about_id= $aboutId;
            $aboutTranslation->save();
        }
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('quotes_images');
            Storage::delete($about->image);
            $about->image = $imagePath;
        }

        $about->save();


        return redirect()->route('admin.about',['lang'=>'tr'])->with('success', 'About information updated successfully!');
    }


    public function destroy(About $about)
    {
        if ($about) {
            $about->translations()->delete();
            if (Storage::disk('public')->exists($about->image)) {
                Storage::disk('public')->delete($about->image);
            }
            $about->delete();

            return redirect()->back()->with('success', 'Has been deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'About info not found.');
        }
    }
}
