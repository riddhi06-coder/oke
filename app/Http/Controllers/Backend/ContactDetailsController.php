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
        $contacts = ContactDetail::all(); 
        return view('backend.contact.index', compact('contacts'));
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

    public function edit($id)
    {
        $contact = ContactDetail::findOrFail($id);

        // Decode JSON fields into arrays for easy iteration in the form
        $contact->businessPhones = json_decode($contact->business_names, true) ?? [];
        $contact->contactNumbers = json_decode($contact->contact_numbers, true) ?? [];

        $contact->businessEmails = json_decode($contact->business_emails, true) ?? [];
        $contact->emailIds = json_decode($contact->email_ids, true) ?? [];

        $contact->contactCards = json_decode($contact->business_cards, true) ?? [];
        $contact->contactNames = json_decode($contact->contact_names, true) ?? [];
        $contact->contactEmails = json_decode($contact->contact_emails, true) ?? [];
        $contact->contactPhones = json_decode($contact->contact_phones, true) ?? [];

        return view('backend.contact.edit', compact('contact'));
    }


    public function update(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'banner_title' => 'required|string|max:255',
            'banner_heading' => 'required|string|max:255',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        
            'address' => 'required|string|max:255',
            'url' => 'required|url|max:255',
        
            'business_name.*' => 'required|string|max:255',
            'contact_no.*' => 'required|digits:10',
        
            'b_name.*' => 'required|string|max:255',
            'email_id.*' => 'required|email|max:255',
        
            'business_n.*' => 'required|string|max:255',
            'name.*' => 'required|string|max:255',
            'email.*' => 'required|email|max:255',
            'phone.*' => 'required|digits:10',
        ], [
            'banner_title.required' => 'The banner title is required.',
            'banner_title.max' => 'The banner title must not exceed 255 characters.',
        
            'banner_heading.required' => 'The banner heading is required.',
            'banner_heading.max' => 'The banner heading must not exceed 255 characters.',
        
            'banner_image.image' => 'The uploaded file must be an image.',
            'banner_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'banner_image.max' => 'The image size must be less than 2MB.',
        
            'address.required' => 'The address field is required.',
            'address.max' => 'The address must not exceed 255 characters.',
        
            'url.required' => 'The URL field is required.',
            'url.url' => 'Please enter a valid URL.',
            'url.max' => 'The URL must not exceed 255 characters.',
        
            'business_name.*.required' => 'The business name is required.',
            'business_name.*.max' => 'The business name must not exceed 255 characters.',
        
            'contact_no.*.required' => 'The contact number is required.',
            'contact_no.*.digits' => 'The contact number must be exactly 10 digits.',
        
            'b_name.*.required' => 'The business name is required for the email field.',
            'b_name.*.max' => 'The business name must not exceed 255 characters.',
        
            'email_id.*.required' => 'The email field is required.',
            'email_id.*.email' => 'Please enter a valid email address.',
            'email_id.*.max' => 'The email must not exceed 255 characters.',
        
            'business_n.*.required' => 'The business name is required.',
            'business_n.*.max' => 'The business name must not exceed 255 characters.',
        
            'name.*.required' => 'The name field is required.',
            'name.*.max' => 'The name must not exceed 255 characters.',
        
            'email.*.required' => 'The email field is required.',
            'email.*.email' => 'Please enter a valid email address.',
            'email.*.max' => 'The email must not exceed 255 characters.',
        
            'phone.*.required' => 'The phone number is required.',
            'phone.*.digits' => 'The phone number must be exactly 10 digits.',
        ]);
        

        $contact = ContactDetail::findOrFail($id);

        $bannerImageName = $contact->banner_image; 
        if ($request->hasFile('banner_image')) {
            $bannerImage = $request->file('banner_image');
            $bannerImageName = time() . rand(10, 999) . '.' . $bannerImage->getClientOriginalExtension();
            $bannerImage->move(public_path('uploads/contact-details/'), $bannerImageName);

        }

        $contact->update([
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
            'modified_at' => Carbon::now(),
            'modified_by' => Auth::id(),
        ]);

        return redirect()->route('contact-details.index')->with('message', 'Contact details updated successfully.');
    }
    
    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = ContactDetail::findOrFail($id);
            $industries->update($data);

            return redirect()->route('contact-details.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }
}