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


use App\Models\HomePage;


class HomeController extends Controller
{

    public function index()
    {
        return view('backend.home.index');
    }

    public function create(Request $request)
    { 
        return view('backend.home.create');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'banner_title' => 'required|string|max:255',
            'banner_heading' => 'nullable|string|max:255',
            'banner_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        
            'card_title' => 'nullable|array',
            'card_title.*' => 'nullable|string|max:255', // Validate each item in the array
        
            'company_logo' => 'nullable|array',
            'company_logo.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // Validate each logo file
        
            'company_name' => 'nullable|array',
            'company_name.*' => 'nullable|string|max:255', // Validate each item in the array
        
            'description' => 'nullable|array',
            'description.*' => 'nullable|string|max:500', // Validate each item in the array
        
        ], [
            'banner_title.required' => 'The banner title is required.',
            'banner_image.required' => 'Please upload a banner image.',
            'banner_image.image' => 'The banner image must be a valid image file.',
            'banner_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed for the banner image.',
            'banner_image.max' => 'The banner image must not exceed 2MB.',
        
            'card_title.*.string' => 'The card title must be a string.',
            'card_title.*.max' => 'The card title must not exceed 255 characters.',
        
            'company_logo.*.image' => 'Each company logo must be a valid image file.',
            'company_logo.*.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed for the company logo.',
            'company_logo.*.max' => 'Each company logo must not exceed 2MB.',
        
            'company_name.*.string' => 'The company name must be a string.',
            'company_name.*.max' => 'The company name must not exceed 255 characters.',
        
            'description.*.string' => 'The description must be a string.',
            'description.*.max' => 'The description must not exceed 500 characters.',
        ]);
        

        // Handle Validation Errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

            // Store Banner Image
        $bannerImageName = null;
        if ($request->hasFile('banner_image')) {
            $bannerImage = $request->file('banner_image');
            $bannerImageName = time() . rand(10, 999) . '.' . $bannerImage->getClientOriginalExtension();
            $bannerImage->move(public_path('uploads/home/'), $bannerImageName);
        }

        // Initialize arrays for JSON encoding
        $cardTitles = [];
        $companyLogos = [];
        $companyNames = [];
        $descriptions = [];

        if ($request->has('card_title')) {
            foreach ($request->card_title as $index => $cardTitle) {
                $companyLogoName = null;

                // Store Company Logo if uploaded
                if ($request->hasFile("company_logo.$index")) {
                    $companyLogo = $request->file("company_logo")[$index];
                    $companyLogoName = time() . rand(10, 999) . '.' . $companyLogo->getClientOriginalExtension();
                    $companyLogo->move(public_path('uploads/home/'), $companyLogoName);
                }

                // Push data into respective arrays
                $cardTitles[] = $cardTitle;
                $companyLogos[] = $companyLogoName;
                $companyNames[] = $request->company_name[$index];
                $descriptions[] = $request->description[$index];
            }
        }

        HomePage::create([
            'banner_title'  => $request->banner_title,
            'banner_heading' => $request->banner_heading,
            'banner_image'  => $bannerImageName,
            'card_title'    => json_encode($request->card_title ?? []), 
            'company_logo'  => json_encode($companyLogos),
            'company_name'  => json_encode($request->company_name ?? []),
            'description'   => json_encode($request->description ?? []),
            'inserted_at'   => Carbon::now(),
            'inserted_by'   => Auth::id(),
        ]);


        return redirect()->route('home-page.index')->with('message', 'Home Page details added successfully!');
    }
}