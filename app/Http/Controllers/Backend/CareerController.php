<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\PageCareer;


class CareerController extends Controller
{

    public function index()
    {
        $careerPages = PageCareer::all();
        return view('backend.career.index', compact('careerPages'));
    }
    
    public function create(Request $request)
    { 
        return view('backend.career.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'banner_heading' => 'required|string|max:255',
            'banner_title' => 'required|string|max:255',
            'banner_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'page_heading' => 'required|string|max:255',
            'page_title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'required|string',
            'review_heading' => 'required|string|max:255',
            'review_title' => 'required|string|max:255',
            'rating_heading' => 'required|string|max:255',
            'ratings' => 'required|string|max:255',
            'other_description' => 'required|string',
            'service_image.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'banner_heading.required' => 'Banner Heading is required.',
            'banner_title.required' => 'Banner Title is required.',
            'banner_image.required' => 'Banner Image is required.',
            'banner_image.image' => 'Banner Image must be an image file.',
            'page_heading.required' => 'Page Heading is required.',
            'page_title.required' => 'Page Title is required.',
            'image.required' => 'Section Image is required.',
            'description.required' => 'Description is required.',
            'review_heading.required' => 'Review Heading is required.',
            'review_title.required' => 'Review Title is required.',
            'rating_heading.required' => 'Rating Heading is required.',
            'ratings.required' => 'Ratings field is required.',
            'other_description.required' => 'Review Description is required.',
            'service_image.*.required' => 'Each profile image is required.',
            'service_image.*.image' => 'Each profile image must be an image file.',
            'service_image.*.mimes' => 'Profile images must be jpg, jpeg, png or webp.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Store Banner Image
        $bannerImage = null;
        if ($request->hasFile('banner_image')) {
            $bannerFile = $request->file('banner_image');
            $bannerImage = time() . rand(10, 999) . '.' . $bannerFile->getClientOriginalExtension();
            $bannerFile->move(public_path('uploads/career/'), $bannerImage);
        }

        // Store Section Image
        $sectionImage = null;
        if ($request->hasFile('image')) {
            $sectionFile = $request->file('image');
            $sectionImage = time() . rand(10, 999) . '.' . $sectionFile->getClientOriginalExtension();
            $sectionFile->move(public_path('uploads/career/'), $sectionImage);
        }

        // Store Profile Images
        $profileImages = [];
        if ($request->hasFile('service_image')) {
            foreach ($request->file('service_image') as $img) {
                $imgName = time() . rand(10, 999) . '.' . $img->getClientOriginalExtension();
                $img->move(public_path('uploads/career/'), $imgName);
                $profileImages[] = $imgName;
            }
        }

        PageCareer::create([
            'banner_heading' => $request->banner_heading,
            'banner_title' => $request->banner_title,
            'banner_image' => $bannerImage,
            'page_heading' => $request->page_heading,
            'page_title' => $request->page_title,
            'image' => $sectionImage,
            'description' => $request->description,
            'review_heading' => $request->review_heading,
            'review_title' => $request->review_title,
            'rating_heading' => $request->rating_heading,
            'ratings' => $request->ratings,
            'other_description' => $request->other_description,
            'profile_images' => json_encode($profileImages),
            'inserted_at'      => Carbon::now(),
            'inserted_by'      => Auth::id(),
        ]);

        return redirect()->route('page-career.index')->with('message', 'Career page data saved successfully!');
    }
}