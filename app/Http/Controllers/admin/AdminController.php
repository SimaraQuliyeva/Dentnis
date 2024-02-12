<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdaterequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
//        if (Auth::check()){
//            dd("yes");
//        }
//        Auth::logout();
        $userCount = $this->showUsersCount();
        return view('admin.dashboard', compact('userCount'));
    }

public function signup(){
        return view('admin.auth.sign-up');
}


    public function login()
    {
//        dd('login');
        return view('admin.auth.login');
    }

    public function authenticate(Request $request): \Illuminate\Http\RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function getUsers(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::query()->paginate(10);
        return view('admin.users.index', compact('users'));
    }


    public function filter(Request $request)
    {
        $userQuery = User::query();

        if ($request->filled('user_name')) {
            $userQuery->where('name', 'like', "%" . $request->get('user_name') . "%");
        }

        if ($request->filled('email')) {
            $userQuery->where('email', 'like', "%" . $request->get('email') . "%");
        }

        $filter = $userQuery->paginate(10);
        return view('admin.users.index', compact('filter'));
    }


    public function profile()
    {
        $user = Auth::user();
        return view('admin.users.profile', compact('user'));
    }

    public function updateProfile(ProfileUpdaterequest $request)
    {
//        dd($request->all());
//        $image=$request->imageFile->move(public_path('uploads'),"xxx.jpg");
        $user = Auth::user();
        $filePath = $file = $request->file('imageFile')->store('public/uploads');
        $user->remember_token = $filePath;
//        if($file){
//            $user->image=Storage::putFile('public/usersPhoto', $file);
//        }
        $user->save();

//        $file=$request->file('imageFile');
//        $file->store('uploads');
//        dd($image);
        return redirect()->route('admin.profile')->with('success', 'Updated.');
//        return view('admin.profile', compact('user'));

    }

    public function logOut(){
//        dd('dgc');
        Auth::logout();
        return redirect()->route('admin.login');
    }

    public function showUsersCount()
    {
        $userCount = User::count();
        return view('admin.dashboard', compact('userCount'));
    }

}
