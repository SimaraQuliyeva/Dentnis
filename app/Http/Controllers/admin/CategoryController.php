<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
//    public function index(){
//        return view('admin.categories.index');
//    }

    public function showForm($lang)
    {
        $categories = Category::with(['translations' => function ($query) use ($lang) {
            $query->whereHas('language', function ($subquery) use ($lang) {
                $subquery->where('lang', $lang);
            });
        }])->get();
//        $categories = Category::with('translations')->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $languages = [];
        return view('admin.categories.create');
    }


    public function store(Request $request)
    {
        $langs = config('app.languages');

        $validationRules = [];
        foreach ($langs as $lang) {
            $validationRules["name_$lang"] = 'required|string';
        }

        $request->validate($validationRules);
//dd($request->all());

        $category = new Category();
        $category->save();
        foreach ($langs as $lang) {
            $language = Language::where('lang', $lang)->first();
            $langId = $language->id;

            $categoryTranslation = new CategoryTranslation();
            $categoryTranslation->name = $request->input("name_$lang");
            $categoryTranslation->category_id = $category->id;
            $categoryTranslation->language_id = $langId;
            $categoryTranslation->save();
        }

        return redirect()->route('admin.categories', ['lang' => 'tr'])->with('success', 'Category added!');
    }

    public function destroy(Category $category){

        if ($category) {
            $category->blogs()->delete();

            $category->translations()->delete();

            $category->delete();

            return redirect()->back()->with('success', 'Kategori ve bağlı bloglar başarıyla silindi!');
        } else {
            return redirect()->back()->with('error', 'Kategori bulunamadı.');
        }
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request)
    {
        $langs = config('app.languages');


        $validationRules = [];
        foreach ($langs as $lang) {
            $validationRules["name_$lang"] = 'required';
        }
        $request->validate($validationRules);
//        dd($request->all());
        $categoryId = $request->input('category_id');
        $category = Category::find($categoryId);

        foreach ($langs as $lang) {
            $language = Language::where('lang', $lang)->first();
            $langId = $language->id;

            $categoryTranslation = CategoryTranslation::updateOrCreate(
                ['category_id' => $categoryId, 'language_id' => $langId],
                ['name' => $request->input("name_$lang")]
            );
        }

//        $category->save();

        return redirect()->route('admin.categories',['lang'=>'tr'])->with('success', 'Category updated successfully!');
    }

}
