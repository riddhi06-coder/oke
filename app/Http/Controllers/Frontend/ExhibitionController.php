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

use Carbon\Carbon;

class ExhibitionController extends Controller
{

    public function events_exhibitions()
    {
        $events = EventListing::whereNull('deleted_by')->first();
        $events_list = EventListing::whereNull('deleted_by')->get();
        return view('frontend.events', compact('events','events_list'));
    }
}