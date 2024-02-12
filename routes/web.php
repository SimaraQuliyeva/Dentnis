<?php

use App\Http\Controllers\Front\BlogController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[\App\Http\Controllers\Front\BlogController::class,'index'])->name('front.index');
Route::get('/about',[\App\Http\Controllers\Front\BlogController::class,'about'])->name('front.about');
Route::get('/contact',[\App\Http\Controllers\Front\BlogController::class,'contact'])->name('front.contact');
Route::post('/contact',[BlogController::class,'addContact']);
Route::get('/dr-abdulkadir-narin',[BlogController::class,'doctorPageShow'])->name('front.dr_narin');
Route::get('/makaleler',[\App\Http\Controllers\Front\BlogController::class,'article'])->name('article');
Route::get('/tv-programlari',[\App\Http\Controllers\Front\BlogController::class,'tvPrograms'])->name('front.tv-programs');

Route::get('/search', [\App\Http\Controllers\SearchController::class, 'search'])->name('front.search');
Route::get('/langChange/{lang}',[\App\Http\Controllers\Front\BlogController::class,'langChange'])->name('langChange');
Route::get('/{slug}',[BlogController::class,'singlePage'])->name('front.singlePage');

