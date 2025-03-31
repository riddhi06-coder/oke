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

use App\Models\About;


class AboutController extends Controller
{

    public function index()
    {
        $aboutPages = About::whereNull('deleted_by')->get();
        return view('backend.about.index', compact('aboutPages'));
    }
    
    public function create(Request $request)
    { 
        return view('backend.about.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'banner_heading'   => 'nullable|string|max:255',
            'banner_title'     => 'nullable|string|max:255',
            'banner_image'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'page_heading'     => 'required|string|max:255',
            'page_title'       => 'required|string|max:255',
            'image'            => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',

            'card_title'       => 'required|string|max:255',
            'year'             => 'required|string|max:10',

            'description'      => 'required|string',
            'other_description'=> 'required|string',
        ], [
            'page_heading.required' => 'The page heading is required.',
            'page_title.required'   => 'The page title is required.',
            'image.required'        => 'Please upload an image.',
            'image.image'           => 'The uploaded file must be a valid image.',
            'image.mimes'           => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'image.max'             => 'The image size must not exceed 2MB.',
            'card_title.required'   => 'The card title is required.',
            'year.required'         => 'The year is required.',
            'description.required'  => 'Please enter a description.',
            'other_description.required' => 'Please enter the other description.',
        ]);

        // Handle validation errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Store Banner Image (if uploaded)
        $bannerImageName = null;
        if ($request->hasFile('banner_image')) {
            $bannerImage = $request->file('banner_image');
            $bannerImageName = time() . rand(10, 999) . '.' . $bannerImage->getClientOriginalExtension();
            $bannerImage->move(public_path('uploads/about/'), $bannerImageName);
        }

        // Store Page Image (Required)
        $pageImageName = null;
        if ($request->hasFile('image')) {
            $pageImage = $request->file('image');
            $pageImageName = time() . rand(10, 999) . '.' . $pageImage->getClientOriginalExtension();
            $pageImage->move(public_path('uploads/about/'), $pageImageName);
        }

        About::create([
            'banner_heading'   => $request->banner_heading,
            'banner_title'     => $request->banner_title,
            'banner_image'     => $bannerImageName,

            'page_heading'     => $request->page_heading,
            'page_title'       => $request->page_title,
            'image'            => $pageImageName,

            'card_title'       => $request->card_title,
            'year'             => $request->year,

            'description'      => $request->description,
            'other_description'=> $request->other_description,

            'inserted_at'      => Carbon::now(),
            'inserted_by'      => Auth::id(),
        ]);

        return redirect()->route('about.index')->with('message', 'About Page details added successfully!');
    }
}