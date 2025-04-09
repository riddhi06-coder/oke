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

use App\Models\PageCareer;
use App\Models\JobRole;

use Carbon\Carbon;

class CareersController extends Controller
{

    public function career()
    {
        $career = PageCareer::orderBy('inserted_at', 'desc')->first();
        $jobs = JobRole::whereNull('deleted_by')->get();
        return view('frontend.career', compact('career','jobs'));
    }

}