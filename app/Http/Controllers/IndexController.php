<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Information;
use App\Models\Branch;
use App\Models\Hairdresser;

class IndexController extends Controller
{
    public function home(Request $request)
    {
        $service_list = Service::where('service_status', 1)->get();
        $minPrice = Service::min('service_price');
        $information = Information::where('id', 1)->first();
        $branch = Branch::where('branch_status', 1)->get();
        $hairdresser_list = Hairdresser::where('hairdresser_status', 1)->get();

        return view('welcome', compact('service_list', 'minPrice', 'information', 'branch', 'hairdresser_list'));
    }
}
