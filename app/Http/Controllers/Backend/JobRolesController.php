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

use App\Models\JobRole;


class JobRolesController extends Controller
{

    public function index()
    {
        $job_roles = JobRole::all();
        return view('backend.job.index', compact('job_roles'));
    }
    
    public function create(Request $request)
    { 
        return view('backend.job.create');
    }

    public function store(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'job_position' => 'required|string|max:255',
            'job_location' => 'required|string|max:255',
        ], [
            'job_position.required' => 'Job Position is required.',
            'job_position.string' => 'Job Position must be a valid string.',
            'job_position.max' => 'Job Position may not be greater than 255 characters.',

            'job_location.required' => 'Job Location is required.',
            'job_location.string' => 'Job Location must be a valid string.',
            'job_location.max' => 'Job Location may not be greater than 255 characters.',
        ]);

        // Handle validation failure
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create slug from job position
        $slug = Str::slug($request->job_position);

        // Ensure slug is unique
        $originalSlug = $slug;
        $count = 1;
        while (\App\Models\JobRole::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        // Save the job role
        JobRole::create([
            'job_position' => $request->job_position,
            'job_location' => $request->job_location,
            'slug' => $slug,
            'inserted_at' => Carbon::now(),
            'inserted_by' => Auth::id(), 
        ]);

        return redirect()->route('job-roles.index')->with('message', 'Job role added successfully!');
    }
}