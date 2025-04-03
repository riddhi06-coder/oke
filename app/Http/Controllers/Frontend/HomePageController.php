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
use App\Models\ContactDetail;

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
        return view('frontend.coming-soon');
    }


    public function contact_us()
    {
        $contact_us = ContactDetail::whereNull('deleted_by')->first();

        if ($contact_us) {
            $contact_us->businessPhones = json_decode($contact_us->business_names, true) ?? [];
            $contact_us->contactNumbers = json_decode($contact_us->contact_numbers, true) ?? [];
        
            $contact_us->businessEmails = json_decode($contact_us->business_emails, true) ?? [];
            $contact_us->emailIds = json_decode($contact_us->email_ids, true) ?? [];
        
            $contact_us->contactCards = json_decode($contact_us->business_cards, true) ?? [];
            $contact_us->contactNames = json_decode($contact_us->contact_names, true) ?? [];
            $contact_us->contactEmails = json_decode($contact_us->contact_emails, true) ?? [];
            $contact_us->contactPhones = json_decode($contact_us->contact_phones, true) ?? [];
        }

        // dd($contact_us);
        return view('frontend.contact', compact('contact_us'));
    
    }

}