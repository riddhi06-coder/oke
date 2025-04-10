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


class EventListingController extends Controller
{

    public function index()
    {
        return view('backend.events.listing.index');
    }
    
    public function create(Request $request)
    { 
        return view('backend.events.listing.create');
    }

}