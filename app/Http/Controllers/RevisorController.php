<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\BecomeRevisor;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;

class RevisorController extends Controller
{
    public function index()
    {
        $announcement_to_check = Announcement::where('is_accepted', null)->first();
        return view('revisor.index', compact('announcement_to_check'));
    }
    public function accept(Announcement $announcement)
    {
        $announcement->setAccepted(true);
        return redirect()->back()->with('message', 'Annuncio accettato');
    }
    public function reject(Announcement $announcement)
    {
        $announcement->setAccepted(false);
        return redirect()->back()->with('status', 'Annuncio rifiutato');
    }
    public function becomeRevisor(Request $request){
     
        $motivation= $request->input('motivation');
        $experience= $request->input('experience');
        $time= $request->input('time');

        $dataToSend=compact('motivation','experience','time');

        Mail::to('admin@presto.it')->send(new BecomeRevisor(Auth::user(),$dataToSend));
        return redirect('/')->with('message', 'Complimenti! Hai richiesto di diventare revisore
    correttamente');
    }
    public function makeRevisor(User $user){
        
      

        Artisan::call('presto:MakeUserRevisor', [
            'email' => $user->email
        ]); 
        return redirect('/')->with('message', 'Complimenti! L\'utente è diventato revisore');
    }
    public function requestRevisor(){
        return view('mail.requestRevisor');
    }
}
