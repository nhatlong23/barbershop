<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Hairdresser;
use App\Models\Booking;
use App\Models\Information;
use App\Models\Branch;

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
        $service_list = Service::all();
        $hairdresser_list = Hairdresser::all();
        $information_list = Information::all();
        $branch_list = Branch::all();
        $booking_list = Booking::orderBy('id', 'desc')->take(10)->get();
        return view('home', compact('service_list', 'hairdresser_list', 'information_list', 'branch_list', 'booking_list'));
    }
}
