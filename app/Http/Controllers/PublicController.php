<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Announcement;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home() {
        $announcements = Announcement::where('is_accepted',true)->take(6)->orderBy('created_at', 'desc')->get();
       
    
        return view('welcome', compact('announcements'));
    }
    public function showCategory(Category $category){
        $announcements = $category->announcements()->where('is_accepted',true)->get();
        return view('category.show',compact('category','announcements'));
    }

    public function searchAnnouncements(Request $request){
        $announcements = Announcement::search($request->searched)->where('is_accepted', true)->paginate(6);
        return view('announcement.index', compact('announcements'));
    }

    public function setLanguage($lang){
        session()->put('locale',$lang);
        return redirect()->back();

    }
}
