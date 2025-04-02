<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\HomePage;
use App\Models\About;

use Carbon\Carbon;

class HomePageController extends Controller
{

    public function index()
    {
        $homeDetails = HomePage::whereNull('deleted_by')->get()->map(function ($home) {
            return (object) [
                'banner_title'  => $home->banner_title,
                'banner_heading' => $home->banner_heading,
                'banner_image'  => $home->banner_image,
                'titles'       => json_decode($home->card_title, true) ?? [],
                'logos'        => json_decode($home->company_logo, true) ?? [],
                'companyNames' => json_decode($home->company_name, true) ?? [],
                'descriptions' => json_decode($home->description, true) ?? [],
            ];
        });
    
        return view('frontend.home', compact('homeDetails'));
    }
    


    public function about()
    {
        $about = About::whereNull('deleted_by')->first();
        return view('frontend.about', compact('about'));
    }

    public function commingSoon()
    {
        return view('frontend.comming-soon');
    }

}