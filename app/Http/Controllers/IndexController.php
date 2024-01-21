<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Information;
use App\Models\Branch;
use App\Models\Hairdresser;
use Illuminate\Support\Facades\Http;

class IndexController extends Controller
{
    public function home(Request $request)
    {
        $services = Http::get('http://barbershop.local/api/v1/service')->json();
        $branch = Http::get('http://barbershop.local/api/v1/branch')->json();
        $hairdresser = Http::get('http://barbershop.local/api/v1/hairdresser')->json();
        $information = Http::get('http://barbershop.local/api/v1/information/1')->json();

        $serviceStatusTrue = collect($services)->where('service_status', 1)->all();
        $branchStatusTrue = collect($branch)->where('branch_status', 1)->all();
        $hairdresserStatusTrue = collect($hairdresser)->where('hairdresser_status', 1)->all();
        $minPrice = collect($services)->min('service_price');

        // $information = Information::where('id', 1)->first();

        return view('welcome', compact('serviceStatusTrue', 'minPrice', 'information', 'branchStatusTrue', 'hairdresserStatusTrue'));
    }
}
