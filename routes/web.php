<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RevisorController;
use App\Http\Controllers\AnnouncementController;

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

Route::get('/', [PublicController::class,'home'])->name('homePage') ;

// parte annunci
Route::get('/create/announcement',[AnnouncementController::class,'create'])->name('createAnnouncement');
Route::get('/show/announcement/{announcement}',[AnnouncementController::class,'show'])->name('showAnnouncement');
Route::get('/index/announcement',[AnnouncementController::class,'index'])->name('indexAnnouncement');

// parte categoria
Route::get('/category/show/{category}',[PublicController::class,'showCategory'])->name('showCategory');

// parte revisore
Route::get('/revisor/home',[RevisorController::class,'index'])->middleware('IsRevisor')->name('indexRevisor');
// parte mail
Route::post('/become/revisor',[RevisorController::class,'becomeRevisor'])->middleware('auth')->name('becomeRevisor');
Route::get('/richiesta/revisore',[RevisorController::class,'requestRevisor'])->middleware('auth')->name('requestRevisor');
Route::get('/rendi/revisore/{user}',[RevisorController::class,'makeRevisor'])->name('makeRevisor');

// parte accetta e rifiuta annunci
Route::patch('/accept/announcement/{announcement}',[RevisorController::class,'accept'])->name('acceptAnnouncement');
Route::patch('/reject/announcement/{announcement}',[RevisorController::class,'reject'])->name('rejectAnnouncement');

// parte per la ricerca
Route::get('/search/announcement',[PublicController::class,'searchAnnouncements'])->name('searchAnnouncements');

// Parte lingue
Route::post('/set/locale/{lang}',[PublicController::class,'setLanguage'])->name('setLocale');