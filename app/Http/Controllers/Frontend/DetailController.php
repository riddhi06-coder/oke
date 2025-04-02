<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\BusinessDetail;
use App\Models\Business;

use Carbon\Carbon;

class DetailController extends Controller
{

    public function details($slug)
    {
        $business = Business::where('slug', $slug)->firstOrFail();
    
        $details = BusinessDetail::where('business_id', $business->id)
                    ->whereNull('deleted_by')
                    ->first(); 
    
        return view('frontend.business-detail-page', compact('business', 'details'));
    }
    
    
    

}