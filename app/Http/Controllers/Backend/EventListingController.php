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


class EventListingController extends Controller
{

    public function index()
    {
        $events = EventListing::whereNull('deleted_by')->get();
        return view('backend.events.listing.index', compact('events'));
    }
    
    public function create(Request $request)
    { 
        return view('backend.events.listing.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'banner_heading'     => 'nullable|string|max:255',
            'banner_title'       => 'nullable|string|max:255',
            'banner_image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'events_title'       => 'required|string|max:255',
            'image'              => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'event_loaction'     => 'required|string|max:255',
            'event_date'         => 'required|date',

            'contact_heading'    => 'nullable|string|max:255',
            'contact_title'      => 'nullable|string|max:255',
        ], [
            'banner_image.image'       => 'The banner image must be a valid image file.',
            'banner_image.mimes'       => 'The banner image must be a file of type: jpg, jpeg, png, webp.',
            'banner_image.max'         => 'The banner image size must not exceed 2MB.',

            'events_title.required'    => 'Please enter the Events Title.',
            'image.required'           => 'Please upload the Events Image.',
            'image.image'              => 'The Events Image must be a valid image file.',
            'image.mimes'              => 'The Events Image must be a file of type: jpg, jpeg, png, webp.',
            'image.max'                => 'The Events Image size must not exceed 2MB.',

            'event_loaction.required'  => 'Please enter the Event Location.',
            'event_date.required'      => 'Please select the Event Date.',
            'event_date.date'          => 'The Event Date must be a valid date.',
        ]);

        // Store Banner Image (if uploaded)
        $bannerImageName = null;
        if ($request->hasFile('banner_image')) {
            $bannerImage = $request->file('banner_image');
            $bannerImageName = time() . rand(10, 999) . '.' . $bannerImage->getClientOriginalExtension();
            $bannerImage->move(public_path('uploads/events/'), $bannerImageName);
        }

        // Store Events Image
        $eventImageName = null;
        if ($request->hasFile('image')) {
            $eventImage = $request->file('image');
            $eventImageName = time() . rand(1000, 9999) . '.' . $eventImage->getClientOriginalExtension();
            $eventImage->move(public_path('uploads/events/'), $eventImageName);
        }

        // Generate slug from events title
        $slug = Str::slug($request->events_title);

        // Save data to the database
        EventListing::create([
            'banner_heading'    => $request->banner_heading,
            'banner_title'      => $request->banner_title,
            'banner_image'      => $bannerImageName,
            'events_title'      => $request->events_title,
            'slug'              => $slug,
            'image'             => $eventImageName,
            'event_loaction'    => $request->event_loaction,
            'event_date'        => $request->event_date,
            'contact_heading'   => $request->contact_heading,
            'contact_title'     => $request->contact_title,
            'inserted_at'       => Carbon::now(),
            'inserted_by'       => Auth::id(),
        ]);

        return redirect()->route('events-listing.index')->with('message', 'Event listing created successfully.');
    }

    public function edit($id)
    {
        $event= EventListing::findOrFail($id);
        return view('backend.events.listing.edit', compact('event'));
    }


    public function update(Request $request, $id)
    {
        $event = EventListing::findOrFail($id);

        // Validate request
        $request->validate([
            'banner_heading'     => 'nullable|string|max:255',
            'banner_title'       => 'nullable|string|max:255',
            'banner_image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'events_title'       => 'required|string|max:255',
            'image'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'event_loaction'     => 'required|string|max:255',
            'event_date'         => 'required|date',

            'contact_heading'    => 'nullable|string|max:255',
            'contact_title'      => 'nullable|string|max:255',
        ], [
            'banner_image.image'       => 'The banner image must be a valid image file.',
            'banner_image.mimes'       => 'The banner image must be a file of type: jpg, jpeg, png, webp.',
            'banner_image.max'         => 'The banner image size must not exceed 2MB.',

            'events_title.required'    => 'Please enter the Events Title.',
            'image.image'              => 'The Events Image must be a valid image file.',
            'image.mimes'              => 'The Events Image must be a file of type: jpg, jpeg, png, webp.',
            'image.max'                => 'The Events Image size must not exceed 2MB.',

            'event_loaction.required'  => 'Please enter the Event Location.',
            'event_date.required'      => 'Please select the Event Date.',
            'event_date.date'          => 'The Event Date must be a valid date.',
        ]);

        // Update Banner Image (if new uploaded)
        if ($request->hasFile('banner_image')) {
          
            $bannerImage = $request->file('banner_image');
            $bannerImageName = time() . rand(10, 999) . '.' . $bannerImage->getClientOriginalExtension();
            $bannerImage->move(public_path('uploads/events/'), $bannerImageName);
            $event->banner_image = $bannerImageName;
        }

        // Update Event Image (if new uploaded)
        if ($request->hasFile('image')) {
           
            $eventImage = $request->file('image');
            $eventImageName = time() . rand(1000, 9999) . '.' . $eventImage->getClientOriginalExtension();
            $eventImage->move(public_path('uploads/events/'), $eventImageName);
            $event->image = $eventImageName;
        }

        // Update other fields
        $event->banner_heading = $request->banner_heading;
        $event->banner_title = $request->banner_title;
        $event->events_title = $request->events_title;
        $event->slug = Str::slug($request->events_title);
        $event->event_loaction = $request->event_loaction;
        $event->event_date = $request->event_date;
        $event->contact_heading = $request->contact_heading;
        $event->contact_title = $request->contact_title;
        $event->modified_at = Carbon::now();
        $event->modified_by = Auth::id(); 

        $event->save();

        return redirect()->route('events-listing.index')->with('message', 'Event listing updated successfully.');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = EventListing::findOrFail($id);
            $industries->update($data);

            return redirect()->route('events-listing.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }


}