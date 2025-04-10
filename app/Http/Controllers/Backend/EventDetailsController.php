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

use App\Models\EventListing;
use App\Models\EventDetail;


class EventDetailsController extends Controller
{

    public function index()
    {
        $events = EventDetail::whereNull('deleted_by')->get();
        return view('backend.events.details.index',compact('events'));
    }
    
    public function create(Request $request)
    { 
        $events = EventListing::whereNull('deleted_by')->pluck('events_title', 'id');
        return view('backend.events.details.create', compact('events'));
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'event_name'       => 'required|exists:events_listing,id',
            'banner_title'     => 'required|string|max:255',
            'banner_image'     => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description'      => 'required|string',
            'service_image.*'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'contact_heading'  => 'nullable|string|max:255',
            'contact_title'    => 'nullable|string|max:255',
        ], [
            'event_name.required'      => 'Please select an event.',
            'event_name.exists'        => 'Selected event is invalid.',
            'banner_title.required'    => 'Please enter a banner title.',
            'banner_image.required'    => 'Please upload a banner image.',
            'banner_image.image'       => 'Banner image must be an image file.',
            'banner_image.mimes'       => 'Banner image must be in jpg, jpeg, png, or webp format.',
            'banner_image.max'         => 'Banner image size must be less than 2MB.',
            'description.required'     => 'Please enter the event description.',
            'service_image.*.image'    => 'Each event image must be an image file.',
            'service_image.*.mimes'    => 'Each event image must be in jpg, jpeg, png, or webp format.',
            'service_image.*.max'      => 'Each event image must be less than 2MB.',
        ]);

        // Store banner image
        $bannerImageName = null;
        if ($request->hasFile('banner_image')) {
            $bannerImage = $request->file('banner_image');
            $bannerImageName = time() . rand(1000, 9999) . '.' . $bannerImage->getClientOriginalExtension();
            $bannerImage->move(public_path('uploads/events/'), $bannerImageName);
        }

        // Store multiple service images
        $serviceImages = [];
        if ($request->hasFile('service_image')) {
            foreach ($request->file('service_image') as $file) {
                if ($file) {
                    $imageName = time() . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/events/'), $imageName);
                    $serviceImages[] = $imageName;
                }
            }
        }

        // Store event details
        EventDetail::create([
            'event_id'         => $request->input('event_name'),
            'banner_title'     => $request->input('banner_title'),
            'banner_image'     => $bannerImageName,
            'description'      => $request->input('description'),
            'event_images'     => json_encode($serviceImages),
            'contact_heading'  => $request->input('contact_heading'),
            'contact_title'    => $request->input('contact_title'),
            'inserted_at'      => Carbon::now(),
            'inserted_by'      => Auth::id(),
        ]);

        return redirect()->route('events-details.index')->with('message', 'Event details added successfully!');
    }

    

}