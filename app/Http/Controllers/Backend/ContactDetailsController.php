<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use App\Models\ContactDetail;


class ContactDetailsController extends Controller
{

    public function index()
    {
        return view('backend.contact.index');
    }
    
    public function create(Request $request)
    { 
        return view('backend.contact.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            // Banner Fields
            'banner_title' => 'required|string|max:255',
            'banner_heading' => 'required|string|max:255',
            'banner_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        
            // Address & URL
            'address' => 'required|string|max:255',
            'url' => 'required|url|max:255',
        
            // Business Contact Details
            'business_name.*' => 'required|string|max:255',
            'contact_no.*' => 'required|digits:10',
        
            // Business Emails
            'b_name.*' => 'required|string|max:255',
            'email_id.*' => 'required|email|max:255',
        
            // Contact Card Details
            'business_n.*' => 'required|string|max:255',
            'name.*' => 'required|string|max:255',
            'email.*' => 'required|email|max:255',
            'phone.*' => 'required|digits:10',
        
        ], [
            // Banner Fields Messages
            'banner_title.required' => 'Please enter a banner title.',
            'banner_title.string' => 'The banner title must be a valid text.',
            'banner_title.max' => 'The banner title must not exceed 255 characters.',
        
            'banner_heading.required' => 'Please enter a banner heading.',
            'banner_heading.string' => 'The banner heading must be a valid text.',
            'banner_heading.max' => 'The banner heading must not exceed 255 characters.',
        
            'banner_image.required' => 'Please upload a banner image.',
            'banner_image.image' => 'The uploaded file must be an image.',
            'banner_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP image formats are allowed.',
            'banner_image.max' => 'The banner image size must not exceed 2MB.',
        
            // Address & URL Messages
            'address.required' => 'Please enter an address.',
            'address.string' => 'The address must be a valid text.',
            'address.max' => 'The address must not exceed 255 characters.',
        
            'url.required' => 'Please enter a valid map URL.',
            'url.url' => 'Please provide a valid URL format.',
            'url.max' => 'The URL must not exceed 255 characters.',
        
            // Business Contact Messages
            'business_name.*.required' => 'Please enter a business name.',
            'business_name.*.string' => 'The business name must be valid text.',
            'business_name.*.max' => 'The business name must not exceed 255 characters.',
        
            'contact_no.*.required' => 'Please enter a contact number.',
            'contact_no.*.digits' => 'Each contact number must be exactly 10 digits.',
        
            // Business Email Messages
            'b_name.*.required' => 'Please enter a business name in the email section.',
            'b_name.*.string' => 'The business name in the email section must be valid text.',
            'b_name.*.max' => 'The business name in the email section must not exceed 255 characters.',
        
            'email_id.*.required' => 'Please enter an email address.',
            'email_id.*.email' => 'Each email must be a valid email address.',
            'email_id.*.max' => 'Each email must not exceed 255 characters.',
        
            // Contact Card Messages
            'business_n.*.required' => 'Please enter a business name in the contact card section.',
            'business_n.*.string' => 'Each business name in the contact card must be valid text.',
            'business_n.*.max' => 'Each business name in the contact card must not exceed 255 characters.',
        
            'name.*.required' => 'Please enter a name.',
            'name.*.string' => 'Each name must be valid text.',
            'name.*.max' => 'Each name must not exceed 255 characters.',
        
            'email.*.required' => 'Please enter an email address in the contact card.',
            'email.*.email' => 'Each contact card email must be a valid email address.',
            'email.*.max' => 'Each contact card email must not exceed 255 characters.',
        
            'phone.*.required' => 'Please enter a contact number in the contact card.',
            'phone.*.digits' => 'Each contact number in the contact card must be exactly 10 digits.',
        ]);
        

        $bannerImageName = null;
        if ($request->hasFile('banner_image')) {
            $bannerImage = $request->file('banner_image');
            $bannerImageName = time() . rand(10, 999) . '.' . $bannerImage->getClientOriginalExtension();
            $bannerImage->move(public_path('uploads/contact-details/'), $bannerImageName);
        }

        ContactDetail::create([
            'banner_title' => $request->banner_title,
            'banner_heading' => $request->banner_heading,
            'banner_image' => $bannerImageName,
            'address' => $request->address,
            'url' => $request->url,

            'business_names' => json_encode($request->business_name),
            'contact_numbers' => json_encode($request->contact_no),

            'business_emails' => json_encode($request->b_name),
            'email_ids' => json_encode($request->email_id),

            'business_cards' => json_encode($request->business_n),
            'contact_names' => json_encode($request->name),
            'contact_emails' => json_encode($request->email),
            'contact_phones' => json_encode($request->phone),
            'inserted_at' => Carbon::now(),
            'inserted_by' => Auth::id(),
        ]);

        return redirect()->route('contact-details.index')->with('message', 'Contact details stored successfully.');
    }


}