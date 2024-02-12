<?php

use App\Http\Controllers\admin\AboutController;
use App\Http\Controllers\admin\AboutMenuController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\DoctorImagesController;
use App\Http\Controllers\admin\LanguageController;
use App\Http\Controllers\admin\MainDoctorController;
use App\Http\Controllers\admin\OutsideMessageController;
use App\Http\Controllers\admin\QuoteController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\SlidersController;
use App\Http\Controllers\admin\SocialNetworkController;
use App\Http\Controllers\admin\SponsorsController;
use App\Http\Controllers\admin\TeamsController;
use App\Http\Controllers\admin\TvProgramController;
use App\Http\Controllers\admin\YoutubeController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/login', [AdminController::class, 'authenticate'])->name('admin.login.post');
Route::get('/logout', [AdminController::class, 'logOut'])->name('admin.logOut');

Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/sign/up', [AdminController::class, 'signup'])->name('admin.signup');
Route::post('/sign/up/post', [AdminController::class, 'signupPost'])->name('admin.sign-up.post');

Route::get('/users/count', [AdminController::class, 'showUsersCount'])->name('admin.users.count');


Route::get('/users', [AdminController::class, 'getUsers'])->name('admin.users');

Route::get('/products', [AdminController::class, 'getProducts'])->name('admin.products');


Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
Route::post('/profile', [AdminController::class, 'updateProfile']);


Route::get('/sponsors', [SponsorsController::class, 'index'])->name('admin.sponsors');

Route::get('/sponsors/create', [SponsorsController::class, 'create'])->name('admin.sponsors.create');
Route::post('/store', [SponsorsController::class, 'store'])->name('admin.sponsors.store');
Route::get('/sponsors/edit/{sponsor}', [SponsorsController::class, 'edit'])->name('admin.sponsors.edit');
Route::put('/sponsors/update/{sponsor}', [SponsorsController::class, 'update'])->name('admin.sponsors.update');
Route::delete('/sponsors/delete/{sponsor}', [SponsorsController::class, 'destroy'])->name('admin.sponsors.destroy');


Route::get('/categories-index/{lang}', [CategoryController::class, 'showForm'])->name('admin.categories');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
Route::post('/categories/store', [CategoryController::class, 'store'])->name('admin.categories.store');
Route::get('/categories/edit/{category}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
Route::put('/categories/update/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
Route::delete('categories/delete/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');



Route::get('/outside/messages', [OutsidemessageController::class, 'showMessages'])->name('admin.outside-messages');
Route::delete('admin/messages/{message}',[OutsidemessageController::class, 'destroy'])->name('admin.messages.destroy');



Route::get('/blogs-index/{lang}', [BlogController::class, 'showBlog'])->name('admin.blogs');
Route::get('/blogs/create', [BlogController::class, 'create'])->name('admin.blogs.create');
Route::post('/blogs/store', [BlogController::class, 'store'])->name('admin.blogs.store');
Route::get('/blogs/edit/{blog}', [BlogController::class, 'edit'])->name('admin.blogs.edit');
Route::put('/blogs/update/{blog}', [BlogController::class, 'update'])->name('admin.blogs.update');
Route::delete('blogs/delete/{blog}', [BlogController::class, 'destroy'])->name('admin.blogs.destroy');


Route::get('/teams-index/{lang}', [TeamsController::class, 'showTeams'])->name('admin.teams');
Route::get('/teams/create', [TeamsController::class, 'create'])->name('admin.teams.create');
Route::post('/teams/store', [TeamsController::class, 'store'])->name('admin.teams.store');
Route::get('/teams/edit/{team}', [TeamsController::class, 'edit'])->name('admin.teams.edit');
Route::put('/teams/update/{team}', [TeamsController::class, 'update'])->name('admin.teams.update');
Route::delete('teams/delete/{team}', [TeamsController::class, 'destroy'])->name('admin.teams.destroy');


Route::get('/youtube', [YoutubeController::class, 'showYoutube'])->name('admin.youtube');
Route::get('/youtube/create', [youtubeController::class, 'create'])->name('admin.youtube.create');
Route::post('/youtube/store', [youtubeController::class, 'store'])->name('admin.youtube.store');
Route::get('/youtube/edit/{youtube}', [YoutubeController::class, 'edit'])->name('admin.youtube.edit');
Route::put('/youtube/update/{youtube}', [YoutubeController::class, 'update'])->name('admin.youtube.update');
Route::delete('/youtube/delete/{youtube}', [YoutubeController::class, 'destroy'])->name('admin.youtube.destroy');


Route::get('/sliders', [SlidersController::class, 'showSliders'])->name('admin.sliders');
Route::get('/sliders/create', [SlidersController::class, 'create'])->name('admin.sliders.create');
Route::post('/sliders/store', [SlidersController::class, 'store'])->name('admin.sliders.store');
Route::get('/sliders/edit/{slider}', [SlidersController::class, 'edit'])->name('admin.sliders.edit');
Route::put('/sliders/update/{slider}', [SlidersController::class, 'update'])->name('admin.sliders.update');
Route::delete('/sliders/delete/{slider}', [SlidersController::class, 'destroy'])->name('admin.sliders.destroy');


Route::get('/contacts', [ContactController::class, 'showContacts'])->name('admin.contacts');
Route::get('/contact/create', [ContactController::class, 'create'])->name('admin.contacts.create');
Route::post('/contact/store', [ContactController::class, 'store'])->name('admin.contacts.store');
Route::get('/contacts/edit/{contact}', [ContactController::class, 'edit'])->name('admin.contacts.edit');
Route::put('/contacts/update/{contact}', [ContactController::class, 'update'])->name('admin.contacts.update');
Route::delete('/contacts/delete/{contact}', [ContactController::class, 'destroy'])->name('admin.contacts.destroy');


Route::get('/about', [AboutController::class, 'showAbout'])->name('admin.about');
Route::get('/about/create', [AboutController::class, 'create'])->name('admin.about.create');
Route::post('/about/store', [AboutController::class, 'store'])->name('admin.about.store');
Route::get('/about/edit/{about}', [AboutController::class, 'edit'])->name('admin.about.edit');
Route::put('/about/update/{about}', [AboutController::class, 'update'])->name('admin.about.update');
Route::delete('/about/delete/{about}', [AboutController::class, 'destroy'])->name('admin.about.destroy');


Route::get('/language', [LanguageController::class, 'showLanguage'])->name('admin.language');
Route::get('/language/create', [languageController::class, 'create'])->name('admin.language.create');
Route::post('/language/store', [languageController::class, 'store'])->name('admin.language.store');
Route::get('/language/edit/{language}', [LanguageController::class, 'edit'])->name('admin.language.edit');
Route::put('/language/update/{language}', [LanguageController::class, 'update'])->name('admin.language.update');
Route::delete('/language/delete/{language}', [LanguageController::class, 'destroy'])->name('admin.language.destroy');


Route::get('/quotes-index/{lang}', [QuoteController::class, 'showQuotes'])->name('admin.quotes');
Route::get('/quotes/create', [QuoteController::class, 'create'])->name('admin.quotes.create');
Route::post('/quotes/store', [QuoteController::class, 'store'])->name('admin.quotes.store');
Route::get('/quotes/edit/{quote}', [QuoteController::class, 'edit'])->name('admin.quotes.edit');
Route::put('/quotes/update/{quote}', [QuoteController::class, 'update'])->name('admin.quotes.update');
Route::delete('/quotes/delete/{quote}', [QuoteController::class, 'destroy'])->name('admin.quotes.destroy');

Route::get('/settings', [SettingController::class, 'showSettings'])->name('admin.settings');
Route::get('/settings/create', [SettingController::class, 'create'])->name('admin.settings.create');
Route::post('/settings/store', [SettingController::class, 'store'])->name('admin.settings.store');
Route::get('/settings/edit/{setting}', [SettingController::class, 'edit'])->name('admin.settings.edit');
Route::put('/settings/update/{setting}', [SettingController::class, 'update'])->name('admin.settings.update');
Route::delete('/settings/delete/{setting}', [SettingController::class, 'destroy'])->name('admin.settings.destroy');


Route::get('/tv-programs', [TvProgramController::class, 'showTvPrograms'])->name('admin.tv-programs');
Route::get('/tv-programs/create', [TvProgramController::class, 'create'])->name('admin.tv-programs.create');
Route::post('/tv-programs/store', [TvProgramController::class, 'store'])->name('admin.tv-programs.store');
Route::get('/tv-programs/edit/{program}', [TvProgramController::class, 'edit'])->name('admin.tv-programs.edit');
Route::put('/tv-programs/update/{program}', [TvProgramController::class, 'update'])->name('admin.tv-programs.update');
Route::delete('/tv-programs/delete/{program}', [TvProgramController::class, 'destroy'])->name('admin.tv-programs.destroy');


Route::get('/about-menus-index/{lang}', [AboutMenuController::class, 'showAboutMenu'])->name('admin.about-menus');
Route::get('/about-menus/create', [AboutMenuController::class, 'create'])->name('admin.about-menus.create');
Route::post('/about-menus/store', [AboutMenuController::class, 'store'])->name('admin.about-menus.store');
Route::get('/about-menus/edit/{menu}', [AboutMenuController::class, 'edit'])->name('admin.about-menus.edit');
Route::put('/about-menus/update/{menu}', [AboutMenuController::class, 'update'])->name('admin.about-menus.update');
Route::delete('/about-menus/delete/{menu}', [AboutMenuController::class, 'destroy'])->name('admin.about-menus.destroy');


Route::get('/doctor-images', [DoctorImagesController::class, 'showDImages'])->name('admin.doctor-images');
Route::get('/doctor-images/create', [DoctorImagesController::class, 'create'])->name('admin.doctor-images.create');
Route::post('/doctor-images/store', [DoctorImagesController::class, 'store'])->name('admin.doctor-images.store');
Route::get('/doctor-images/edit/{dImage}', [DoctorImagesController::class, 'edit'])->name('admin.doctor-images.edit');
Route::put('/doctor-images/update/{dImage}', [DoctorImagesController::class, 'update'])->name('admin.doctor-images.update');
Route::delete('/doctor-images/delete/{dImage}', [DoctorImagesController::class, 'destroy'])->name('admin.doctor-images.destroy');


Route::get('/main-doctor/', [MainDoctorController::class, 'showMainDoctor'])->name('admin.main-doctor');
Route::get('/main-doctor/create', [MainDoctorController::class, 'create'])->name('admin.main-doctor.create');
Route::post('/main-doctor/store', [MainDoctorController::class, 'store'])->name('admin.main-doctor.store');
Route::get('/main-doctor/edit/{doctor}', [MainDoctorController::class, 'edit'])->name('admin.main-doctor.edit');
Route::put('/main-doctor/update/{doctor}', [MainDoctorController::class, 'update'])->name('admin.main-doctor.update');
Route::delete('/main-doctor/delete/{doctor}', [MainDoctorController::class, 'destroy'])->name('admin.main-doctor.destroy');



Route::get('/social/networks', [SocialNetworkController::class, 'showSocial'])->name('admin.social-networks');
Route::get('/social/networks/create', [SocialNetworkController::class, 'create'])->name('admin.social-networks.create');
Route::post('/social/networks/store', [SocialNetworkController::class, 'store'])->name('admin.social-networks.store');
Route::get('/social/networks/edit/{social}', [SocialNetworkController::class, 'edit'])->name('admin.social-networks.edit');
Route::put('/social/networks/update/{social}', [SocialNetworkController::class, 'update'])->name('admin.social-networks.update');
Route::delete('/social/networks/delete/{social}', [SocialNetworkController::class, 'destroy'])->name('admin.social-networks.destroy');
