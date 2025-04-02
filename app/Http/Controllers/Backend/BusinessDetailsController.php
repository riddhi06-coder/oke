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

use App\Models\BusinessDetail;
use App\Models\Business;



class BusinessDetailsController extends Controller
{

    public function index()
    {
        $details = BusinessDetail::select(
                'business_details.*',
                'business.business_name'
            )
            ->join('business', 'business.id', '=', 'business_details.business_id')
            ->whereNull('business_details.deleted_by')
            ->get();
    
        return view('backend.business-details.index', compact('details'));
    }

    public function create(Request $request)
    { 
        $businesses = Business::wherenull('deleted_by')->pluck('business_name', 'id'); 
        return view('backend.business-details.create', compact('businesses'));
    }


    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'business_id' => 'required|exists:business,id|unique:business_details,business_id',
            'banner_label' => 'required|string|max:255',
            'banner_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'logo' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner_heading' => 'required|string|max:255',
            'banner_description' =>  'nullable|string|max:255',
            'description' => 'required',
            'year' => 'nullable|integer',
            'project_completed' => 'nullable|integer',
            'industry_label' => 'required|string|max:255',
            'industry_heading' => 'required|string|max:255',
            'industry_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description.*' => 'nullable|string|max:255',
            'service_image.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'service_description.*' => 'nullable|string|max:255',
        ], [
            'business_id.required' => 'Business Type is required.',
            'business_id.exists' => 'Invalid Business Type selected.',
            'banner_label.required' => 'Banner Label is required.',
            'banner_image.required' => 'Banner Image is required.',
            'banner_image.image' => 'Banner Image must be a valid image file.',
            'description.required' => 'Banner Description is required.',
            'logo.required' => 'Banner Logo is required.',
            'logo.image' => 'Banner Logo must be a valid image file.',
            'banner_heading.required' => 'Banner Heading is required.',
            'industry_label.required' => 'Industry Label is required.',
            'industry_heading.required' => 'Industry Heading is required.',
            'industry_image.required' => 'Industry Image is required.',
            'image.*.image' => 'Industry Served Image must be a valid image file.',
            'service_image.*.image' => 'Service Image must be a valid image file.',
        ]);

        // Upload Banner Image
        $bannerImageName = null;
        if ($request->hasFile('banner_image')) {
            $bannerImage = $request->file('banner_image');
            $bannerImageName = time() . rand(10, 999) . '.' . $bannerImage->getClientOriginalExtension();
            $bannerImage->move(public_path('uploads/business-details/'), $bannerImageName);
        }

        // Upload Logo Image
        $logoImageName = null;
        if ($request->hasFile('logo')) {
            $logoImage = $request->file('logo');
            $logoImageName = time() . rand(10, 999) . '.' . $logoImage->getClientOriginalExtension();
            $logoImage->move(public_path('uploads/business-details/'), $logoImageName);
        }

        // Upload Industry Image
        $industryImageName = null;
        if ($request->hasFile('industry_image')) {
            $industryImage = $request->file('industry_image');
            $industryImageName = time() . rand(10, 999) . '.' . $industryImage->getClientOriginalExtension();
            $industryImage->move(public_path('uploads/business-details/'), $industryImageName);
        }

        // Process Industry Served Data (Images and Descriptions Separately)
        $industryImages = [];
        $industryDescriptions = [];

        if ($request->has('description')) {
            foreach ($request->description as $index => $desc) {
                $imageName = null;
                if ($request->hasFile("image.$index")) {
                    $image = $request->file('image')[$index];
                    $imageName = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/business-details/'), $imageName);
                }
                $industryImages[] = $imageName;
                $industryDescriptions[] = $desc;
            }
        }

        // Process Service Data (Images and Descriptions Separately)
        $serviceImages = [];
        $serviceDescriptions = [];

        if ($request->has('service_description')) {
            foreach ($request->service_description as $index => $serviceDesc) {
                $serviceImageName = null;
                if ($request->hasFile("service_image.$index")) {
                    $serviceImage = $request->file('service_image')[$index];
                    $serviceImageName = time() . rand(10, 999) . '.' . $serviceImage->getClientOriginalExtension();
                    $serviceImage->move(public_path('uploads/business-details/'), $serviceImageName);
                }
                $serviceImages[] = $serviceImageName;
                $serviceDescriptions[] = $serviceDesc;
            }
        }

        // Store Data in Database
        BusinessDetail::create([
            'business_id' => $request->business_id,
            'banner_label' => $request->banner_label,
            'banner_image' => $bannerImageName,
            'logo' => $logoImageName,
            'banner_heading' => $request->banner_heading,
            'banner_description' => $request->banner_description,
            'description' => is_array($request->description) ? json_encode($request->description) : $request->description, // ✅ FIX HERE
            'year' => $request->year,
            'project_completed' => $request->project_completed,
            'industry_label' => $request->industry_label,
            'industry_heading' => $request->industry_heading,
            'industry_image' => $industryImageName,
            'industry_images' => json_encode($industryImages),
            'industry_descriptions' => json_encode($industryDescriptions),
            'service_heading' => $request->service_heading,
            'service_images' => json_encode($serviceImages),
            'service_descriptions' => json_encode($serviceDescriptions),
            'inserted_at'      => Carbon::now(),
            'inserted_by'      => Auth::id(),
        ]);
        

        return redirect()->route('details.index')->with('message', 'Business details added successfully.');
    }

    public function edit($id)
    {
        $business_details = BusinessDetail::findOrFail($id); 
        $businesses = Business::wherenull('deleted_by')->pluck('business_name', 'id'); 
        return view('backend.business-details.edit', compact('business_details','businesses'));
    }


    public function update(Request $request, $id)
    {
        $businessDetail = BusinessDetail::findOrFail($id);

        $request->validate([
            'business_id' => 'required|exists:business,id|unique:business_details,business_id,' . $businessDetail->id,
            'banner_label' => 'required|string|max:255',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner_heading' => 'required|string|max:255',
            'banner_description' => 'nullable|string|max:255',
            'year' => 'nullable|integer',
            'project_completed' => 'nullable|integer',
            'industry_label' => 'required|string|max:255',
            'industry_heading' => 'required|string|max:255',
            'industry_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description.*' => 'nullable|string|max:255',
            'service_image.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'service_description.*' => 'nullable|string|max:255',
        ], [
            'business_id.required' => 'Business Type is required.',
            'business_id.exists' => 'Invalid Business Type selected.',
            'business_id.unique' => 'Business Type already exsists.',
            'banner_label.required' => 'Banner Label is required.',
            'banner_image.image' => 'Banner Image must be a valid image file.',
            'banner_image.mimes' => 'Banner Image must be in JPG, JPEG, PNG, or WEBP format.',
            'banner_image.max' => 'Banner Image must not exceed 2MB.',
            'logo.image' => 'Logo must be a valid image file.',
            'logo.mimes' => 'Logo must be in JPG, JPEG, PNG, or WEBP format.',
            'logo.max' => 'Logo must not exceed 2MB.',
            'banner_heading.required' => 'Banner Heading is required.',
            'banner_description.max' => 'Banner Description must not exceed 255 characters.',
            'description.required' => 'Description is required.',
            'year.integer' => 'Year must be a valid number.',
            'project_completed.integer' => 'Project Completed must be a valid number.',
            'industry_label.required' => 'Industry Label is required.',
            'industry_heading.required' => 'Industry Heading is required.',
            'industry_image.image' => 'Industry Image must be a valid image file.',
            'industry_image.mimes' => 'Industry Image must be in JPG, JPEG, PNG, or WEBP format.',
            'industry_image.max' => 'Industry Image must not exceed 2MB.',
            'image.*.image' => 'Each Industry Served Image must be a valid image file.',
            'image.*.mimes' => 'Each Industry Served Image must be in JPG, JPEG, PNG, or WEBP format.',
            'image.*.max' => 'Each Industry Served Image must not exceed 2MB.',
            'description.*.max' => 'Each Industry Served Description must not exceed 255 characters.',
            'service_image.*.image' => 'Each Service Image must be a valid image file.',
            'service_image.*.mimes' => 'Each Service Image must be in JPG, JPEG, PNG, or WEBP format.',
            'service_image.*.max' => 'Each Service Image must not exceed 2MB.',
            'service_description.*.max' => 'Each Service Description must not exceed 255 characters.',
        ]);
        

        // Update Banner Image if uploaded
        if ($request->hasFile('banner_image')) {
            $bannerImage = $request->file('banner_image');
            $bannerImageName = time() . rand(10, 999) . '.' . $bannerImage->getClientOriginalExtension();
            $bannerImage->move(public_path('uploads/business-details/'), $bannerImageName);
            $businessDetail->banner_image = $bannerImageName;
        }

        // Update Logo Image if uploaded
        if ($request->hasFile('logo')) {
            $logoImage = $request->file('logo');
            $logoImageName = time() . rand(10, 999) . '.' . $logoImage->getClientOriginalExtension();
            $logoImage->move(public_path('uploads/business-details/'), $logoImageName);
            $businessDetail->logo = $logoImageName;
        }

        // Update Industry Image if uploaded
        if ($request->hasFile('industry_image')) {
            $industryImage = $request->file('industry_image');
            $industryImageName = time() . rand(10, 999) . '.' . $industryImage->getClientOriginalExtension();
            $industryImage->move(public_path('uploads/business-details/'), $industryImageName);
            $businessDetail->industry_image = $industryImageName;
        }

        // Retrieve existing images and descriptions
        $images = $request->existing_images ?? [];
        $descriptions = $request->description ?? [];

        // Handle new image uploads
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $index => $image) {
                if ($image) {
                    $imageName = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/business-details/'), $imageName);

                    // Append new image path instead of replacing
                    $images[] = $imageName;
                    $descriptions[] = $request->description[$index] ?? '';
                }
            }
        }


        
        // Process Service Data (Images and Descriptions Separately)
        $serviceImages = json_decode($businessDetail->service_images, true) ?? [];
        $serviceDescriptions = json_decode($businessDetail->service_descriptions, true) ?? [];

        if ($request->has('service_description')) {
            foreach ($request->service_description as $index => $serviceDesc) {
                if ($request->hasFile("service_image.$index")) {
                    $serviceImage = $request->file('service_image')[$index];
                    $serviceImageName = time() . rand(10, 999) . '.' . $serviceImage->getClientOriginalExtension();
                    $serviceImage->move(public_path('uploads/business-details/'), $serviceImageName);

                    // Append new image instead of replacing
                    $serviceImages[] = $serviceImageName;
                }

                // Append new description instead of replacing
                $serviceDescriptions[] = $serviceDesc;
            }
        }


        // Update Business Detail
        $businessDetail->update([
            'business_id' => $request->business_id,
            'banner_label' => $request->banner_label,
            'banner_heading' => $request->banner_heading,
            'banner_description' => $request->banner_description,
            'description' => is_array($request->description) ? json_encode($request->description) : $request->description,
            'year' => $request->year,
            'project_completed' => $request->project_completed,
            'industry_label' => $request->industry_label,
            'industry_heading' => $request->industry_heading,
            'industry_images' => json_encode($images),
            'industry_descriptions' => json_encode($descriptions),
            'service_heading' => $request->service_heading,
            'service_images' => json_encode($serviceImages),
            'service_descriptions' => json_encode($serviceDescriptions),
            'modified_at' => Carbon::now(),
            'modified_by' => Auth::id(),
        ]);

        return redirect()->route('details.index')->with('message', 'Business details updated successfully.');
    }

}