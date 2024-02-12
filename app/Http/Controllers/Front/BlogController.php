<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Contact;
use App\Models\DoctorImages;
use App\Models\MainDoctor;
use App\Models\Menu;
use App\Models\MenuBuilder;
use App\Models\OutsideMessage;
use App\Models\Quotes;
use App\Models\Slider;
use App\Models\Sponsors;
use App\Models\Team;
use App\Models\TvProgram;
use App\Models\Youtubes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{

    public function langChange($lang){
//       dd( $lang);
        session()->put('language',$lang);
        return redirect()->back();
    }



    public function index()
    {

//       session()->flush();
        $lang = session()->get('language','tr');
//        dd($lang);
        $sliders = Slider::get();

        $quotes = Quotes::with(['translations' => function ($query) use ($lang) {
            $query->whereHas('language', function ($subquery) use ($lang) {
                $subquery->where('lang', $lang);
            });
        }])->get();

//        $quotes = Quote::with('translations')->get();

        $sponsors = Sponsors::get();
        $youtube = Youtubes::get();

        $teams = Team::with(['translations' => function ($query) use ($lang) {
            $query->whereHas('language', function ($subquery) use ($lang) {
                $subquery->where('lang', $lang);
            });
        }])->get();

        $blogs = Blog::with(['translations' => function ($query) use ($lang) {
            $query->whereHas('language', function ($subquery) use ($lang) {
                $subquery->where('lang', $lang);
            });
        }])->inRandomOrder()->limit(9)->get();
//        $blogs = Blog::with('translations')->get();
//        dd($lang, $quotes);
        return view('Front.pages.main', compact('sliders', 'quotes', 'sponsors', 'youtube', 'teams', 'blogs'));
    }


    public function singlePage($slug)
    {
//        $lang = 'tr';
        $lang = session()->get('language', 'tr');
        $blogItem = Blog::with(['translations' => function ($query) use ($lang) {
            $query->whereHas('language', function ($subquery) use ($lang) {
                $subquery->where('lang', $lang);
            });
        }])->where('slug', $slug)->get();

        $blogs=Blog::all();
//        return redirect('front.singlePage', compact('blogs','blogItem'));
        return view('Front.pages.singlePage',compact('blogs','blogItem','slug'));
    }

    public function about()
    {
        $lang = session()->get('language', 'tr');
        $about = About::with(['translations' => function ($query) use ($lang) {
            $query->whereHas('language', function ($subquery) use ($lang) {
                $subquery->where('lang', $lang);
            });
        }])->get();
        $images = DoctorImages::all();

        return view('Front.pages.about', compact('about','images'));
    }


    public function contact()
    {
        $contacts=Contact::all();
        return view('Front.pages.contact', compact('contacts'));
    }

    public function addContact(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'kvkk' => 'required',
        ]);
//        OutsideMessage::create([
//            'fullname'=> $request->input('fullname'),
//            'phone' => $request->input('phone'),
//            'email' => $request->input('email'),
//            'subject' =>$request->input('subject'),
//            'message' =>$request->input('message'),
//        ]);
        $outsideMessage = new OutsideMessage();
        $outsideMessage->fullname = $request->input('fullname');
        $outsideMessage->phone = $request->input('phone');
        $outsideMessage->email = $request->input('email');
        $outsideMessage->subject = $request->input('subject');
        $outsideMessage->message = $request->input('message');
        $outsideMessage->save();

        return redirect()->back()->with('success','Mesajınız başarıyla gönderildi.');
    }
    public function tvPrograms()
    {
        $programs=TvProgram::all();
        return view('Front.pages.tv-programs',compact('programs'));
    }

    public function article()
    {
        $lang = session()->get('language', 'tr');
        $articles = Blog::with(['translations' => function ($query) use ($lang) {
            $query->whereHas('language', function ($subquery) use ($lang) {
                $subquery->where('lang', $lang);
            });
        }])->get();
//
        $blogs=Blog::all();
        return view('Front.pages.articles',compact('blogs', 'articles'));
    }

    public function doctorPageShow(){

        $lang = session()->get('language', 'tr');
        $about = MainDoctor::with(['translations' => function ($query) use ($lang) {
            $query->whereHas('language', function ($subquery) use ($lang) {
                $subquery->where('lang', $lang);
            });
        }])->get();
        $images = DoctorImages::all();

        return view('Front.pages.doctor', compact('about','images'));
    }
}
