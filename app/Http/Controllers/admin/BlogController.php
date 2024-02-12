<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogTranslation;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    //
    public function showBlog($lang){
        $blogs = Blog::with(['translations' => function ($query) use ($lang) {
            $query->whereHas('language', function ($subquery) use ($lang) {
                $subquery->where('lang', $lang);
            });
        }])->get();
//        $blogs=Blog::all();
//        dd($blogs);
        return view('admin.blogs.index',compact('blogs'));
    }

    public function create()
    {
        $categories = Category::with('translations')->get();
        return view('admin.blogs.create',compact('categories'));
    }

    public function store(Request $request)
    {
//      dd($request->all());

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $langs=config('app.languages');
        $validationRules = [];

        foreach ($langs as $lang){
            $validationRules["title_$lang"]='required';
            $validationRules["description_$lang"]='required';
        }
        $request->validate($validationRules);

        $imagePath = $request->file('image')->store('blog_images', 'public');
        $slug= Str::slug($request->input('title_tr'));
        $blog = new Blog();
        $blog->image = $imagePath;
        $blog->category_id = $request->input('category');
        $blog->slug = $slug;

        $blog->save();
//        dd($blog);


        foreach (config('app.languages') as $lang) {
            $language = Language::where('lang', $lang)->first();
            $langId = $language->id;

            $translation = new BlogTranslation();
            $translation->title = $request->input("title_$lang");
            $translation->description = $request->input("description_$lang");
            $translation->blog_id = $blog->id;
            $translation->language_id = $langId;
            $translation->save();
        }
//        dd($translation);

        return redirect()->route('admin.blogs',['lang'=>'tr'])->with('success', 'Blog added successfully');
    }


    public function edit(Blog $blog)
    {
//        dd($blog);
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request)
    {

        $langs = config('app.languages');
//        dd($request->all());

        $validationRules = [];
        foreach ($langs as $lang) {
            $validationRules["$lang.title"] = 'required';
            $validationRules["$lang.description"] = 'required';
        }
        $validationRules['image'] = 'image|mimes:jpeg,png,jpg,gif,webp|max:2048';


        $request->validate($validationRules);
//        dd($request->all());

        $blogId = $request->input('blogId');
        $blog = Blog::find($blogId);

        foreach ($langs as $lang) {
            $language = Language::where('lang', $lang)->first();
            $langId = $language->id;

            $blogTranslation = BlogTranslation::updateOrCreate(
                ['blog_id' => $blogId, 'language_id' => $langId],
                ['title' => $request->input("$lang.title"),
                    'description' => $request->input("$lang.description"),
                    'blog_id' => $blogId,
                ]
            );

            $blogTranslation->title = $request->input("$lang.title");
            $blogTranslation->description = $request->input("$lang.description");
            $blogTranslation->blog_id= $blogId;
            $blogTranslation->save();
        }
        if ($request->hasFile('image')) {
            if(Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }
            $blog->image=$request->file('image')->store('blog_images','public');
//            $imagePath= $blog->image;
//            $imagePath = $request->file('image')->store('blog_images','public');
//            Storage::delete($blog->image);

        }
        $blog->save();

        return redirect()->route('admin.blogs',['lang'=>'tr'])->with('success', 'Blog page  updated successfully!');
    }




    public function destroy(Blog $blog)
    {
        if ($blog) {
            $blog->translations()->delete();
            if (Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }
            $blog->delete();

            return redirect()->back()->with('success', 'Has been deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Blog not found.');
        }
    }
}
