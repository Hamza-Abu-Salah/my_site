<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $events=Service::count();
        $contacts_count=Contact::count();

        $date=[];
        $services=[];
        $contacts=[];
        for ($i = 0; $i < 7; $i++){
            $range = \Carbon\Carbon::now()->subDays($i)->format('20y-m-d');
            $service=Service::whereDate('created_at',$range)->get();
            $contact=Contact::whereDate('created_at',$range)->orderBy('id', 'DESC')->get();
            $date[]=$range;
            $services[]=$service->count();
            $contacts[]=$contact->count();
        }
        return view('index',compact('events','contacts_count','date','services','contacts'));
    }
}
