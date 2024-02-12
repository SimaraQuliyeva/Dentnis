<?php

namespace App\Http\Controllers\admin;

use App\Events\LanguageAdded;
use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LanguageController extends Controller
{
    public function showLanguage(){
        $languages = Language::all();
        return view('admin.language.index', compact('languages'));
    }
    public function create()
    {
        return view('admin.language.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'language' => 'required',

        ]);

        $imagePath = $request->file('image')->store('language_images', 'public');

       $language= Language::create([
            'image' => $imagePath,
            'lang' => $request->input('language'),
        ]);
//        event(new LanguageAdded($language->image, $language->lang));

        return redirect()->route('admin.language')->with('success', 'New language added');
    }



    public function edit(Language $language){
        return view('admin.language.edit', compact('language'));
    }

    public function update(Request $request, Language $language)
    {
        $request->validate([
            'language' =>'required|string' ,
            'image' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($request->hasFile('image')) {
//            if (Storage::disk('public')->exists($language->image)) {
//                Storage::disk('public')->delete($language->image);
//
//            }
            $language->image = $request->file('image')->store('blog_images', 'public');
        }
        $language->lang = $request->input('language');
        $language->save();

        return redirect()->route('admin.language')->with('success', 'Language updated successfully!');
    }


    public function destroy(Language $language)
    {
        // İlgili çevirileri sil (eğer varsa)
        $language->delete();
        // Slider resmini storage'dan sil
        if (Storage::disk('public')->exists($language->image)) {
            Storage::disk('public')->delete($language->image);
        }
        $language->delete();

        return redirect()->route('admin.language')->with('success', 'Language deleted successfully!');
    }

}
