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

use App\Models\About;
use App\Models\EventListing;
use App\Models\EventDetail;

use Carbon\Carbon;

class ExhibitionController extends Controller
{

    public function events_exhibitions()
    {
        $events = EventListing::whereNull('deleted_by')->first();
        $events_list = EventListing::whereNull('deleted_by')->get();
        return view('frontend.events', compact('events','events_list'));
    }




    public function events_exhibitions_details($slug)
    {
        $events = EventListing::whereNull('deleted_by')->first();
        $events_list = EventListing::whereNull('deleted_by')->get();

        // Get the current event by slug
        $event = EventListing::where('slug', $slug)->whereNull('deleted_by')->firstOrFail();

        // Join EventDetail with EventListing to get event title
        $event_details = EventDetail::where('event_details.deleted_by', null)
            ->where('event_details.event_id', $event->id)
            ->join('events_listing', 'events_listing.id', '=', 'event_details.event_id')
            ->select('event_details.*', 'events_listing.events_title','events_listing.event_date','events_listing.event_loaction','event_details.event_images')
            ->first();

        return view('frontend.events-details', compact('events', 'events_list', 'event_details'));
    }

    
    
}