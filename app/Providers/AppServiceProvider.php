<?php

namespace App\Providers;

use App\Models\AboutMenu;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Language;
use App\Models\Setting;
use App\Models\SocialNetwork;
use App\Models\User;
use Hamcrest\Core\Set;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer(['Front.*','admin.*'], function ($view){
            $lang = session()->get('language', 'tr');
            App::setLocale($lang);
//            $categories=Category::with(['translations', 'blogs.translations'])->get();
            $languages=Language::all();
            $categories = Category::with([
                'translations' => function ($query) use ($lang) {
                    $query->whereHas('language', function ($subquery) use ($lang) {
                        $subquery->where('lang', $lang);
                    });
                },
                'blogs.translations' => function ($query) use ($lang) {
                    $query->whereHas('language', function ($subquery) use ($lang) {
                        $subquery->where('lang', $lang);
                    });
                },
            ])->get();

            $aboutMenu = AboutMenu::with(['translations' => function ($query) use ($lang) {
                $query->whereHas('language', function ($subquery) use ($lang) {
                    $subquery->where('lang', $lang);
                });
            }])->get();
            $socials = SocialNetwork::all();

            $blogs=Blog::all();
    foreach ($blogs as $blog) {
        $blogModel = Blog::find($blog->id);
    }

            $contacts=Contact::all();
            $settings=Setting::all();

            $users=User::all();

            return $view->with(compact('categories', 'lang','languages', 'aboutMenu', 'socials' , 'blogs', 'contacts', 'settings', 'users'));
        });
    }
}
