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
use App\Models\EventDetails;


class EventDetailsController extends Controller
{

    public function index()
    {
        return view('backend.events.details.index');
    }
    
    public function create(Request $request)
    { 
        $events = EventListing::whereNull('deleted_by')->pluck('events_title', 'id');
        return view('backend.events.details.create', compact('events'));
    }
    

}