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



    public function submitResume(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email',
            'mobile' => 'required',
            'resume' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        $emailData = [
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
        ];

        $resume = $request->file('resume');

        Mail::send('frontend.career_form_email', ['emailData' => $emailData], function ($message) use ($emailData, $resume) {
            $message->to('riddhi@matrixbricks.com')
                    ->subject('New Job Request - ' . $emailData['name']);

            // Attach resume
            $message->attach($resume->getRealPath(), [
                'as' => 'Resume_' . Str::slug($emailData['name']) . '.' . $resume->getClientOriginalExtension(),
                'mime' => $resume->getMimeType(),
            ]);
        });

        return redirect()->route('thank.you')->with('message', 'Job request sent successfully!');
    }

}