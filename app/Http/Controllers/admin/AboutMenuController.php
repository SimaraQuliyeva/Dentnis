<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AboutMenu;
use App\Models\AboutMenuTranslation;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AboutMenuController extends Controller
{
    public function showAboutMenu($lang){
        $menus = AboutMenu::with(['translations' => function ($query) use ($lang) {
            $query->whereHas('language', function ($subquery) use ($lang) {
                $subquery->where('lang', $lang);
            });
        }])->get();
//        $menus = AboutMenu::all();
        return view('admin.about-menus.index', compact('menus'));
    }

    public function create()
    {
        $languages = [];
        return view('admin.about-menus.create');
    }


    public function store(Request $request)
    {
        $langs = config('app.languages');

        $validationRules = [];
        foreach ($langs as $lang) {
            $validationRules["title_$lang"] = 'required|string';
        }
        $request->validate($validationRules);
           //dd($request->all());
        $slug= Str::slug($request->input('title_tr'));
        $menu = new AboutMenu();
        $menu->slug = $slug;
        $menu->save();
        foreach ($langs as $lang) {
            $language = Language::where('lang', $lang)->first();
            $langId = $language->id;

            $menuTranslation = new AboutMenuTranslation();
            $menuTranslation->title = $request->input("title_$lang");
            $menuTranslation->about_menu_id = $menu->id;
            $menuTranslation->language_id = $langId;
            $menuTranslation->save();
        }

        return redirect()->route('admin.about-menus', ['lang' => 'tr'])->with('success', 'Menu added!');
    }

    public function edit(AboutMenu $menu)
    {
        return view('admin.about-menus.edit', compact('menu'));
    }

    public function update(Request $request)
    {
        $langs = config('app.languages');


        $validationRules = [];
        foreach ($langs as $lang) {
            $validationRules["title_$lang"] = 'required';
        }
        $request->validate($validationRules);

        $menuId = $request->input('menuId');
        $menuId = AboutMenu::find($menuId);

        foreach ($langs as $lang) {
            $language = Language::where('lang', $lang)->first();
            $langId = $language->id;

            $menuTranslation = new AboutMenuTranslation();
            $menuTranslation->about_menu_id = $menuId;
            $menuTranslation->language_id = $langId;
            $menuTranslation->title = $request->input("title_$lang");
            $menuTranslation->save();
        }

        return redirect()->route('admin.about-menus',['lang'=>'tr'])->with('success', 'Doctor info updated successfully!');
    }

    public function destroy(AboutMenu $menu){
        if ($menu) {
            $menu->translations()->delete();
            $menu->delete();

            return redirect()->back()->with('success', 'Has been deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Info not found.');
        }
    }

}
