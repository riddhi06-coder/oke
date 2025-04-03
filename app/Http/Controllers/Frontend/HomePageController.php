<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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


    public function thankyou()
    {
        return view('frontend.thank-you');
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

        return view('frontend.contact', compact('contact_us'));
    
    }

    public function sendContactMail(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'enquiry_id' => 'required',
            'message' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Email data
        $emailData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'enquiry' => $request->enquiry_id,
            'message' => $request->message,
        ];
    
        // Send email
        Mail::send('frontend.contact_form_email', ['emailData' => $emailData], function ($message) use ($emailData) {
            $message->to('riddhi@matrixbricks.com')
                    ->subject('New Contact Form Submission')
                    ->from($emailData['email'], $emailData['name']);
        });
    
        return redirect()->route('thank.you')->with('success', 'Your message has been sent successfully!');
    }
    

}