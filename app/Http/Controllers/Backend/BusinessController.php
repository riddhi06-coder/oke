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

use App\Models\Business;


class BusinessController extends Controller
{

    public function index()
    {
        $business = Business::whereNull('deleted_by')->get();
        return view('backend.business.index', compact('business'));
    }
    
    public function create(Request $request)
    { 
        return view('backend.business.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string|max:255|unique:business,business_name',
        ]);

        $slug = Str::slug($request->business_name, '-');

        $count = Business::where('slug', 'LIKE', "$slug%")->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        $business = Business::create([
            'business_name' => $request->business_name,
            'slug' => $slug,
            'inserted_at'      => Carbon::now(),
            'inserted_by'      => Auth::id(),
        ]);

        return redirect()->route('business.index')->with('message', 'Business created successfully!');
    }

    public function edit($id)
    {
        $business = Business::findOrFail($id);
        return view('backend.business.edit', compact('business'));
    }
    
    public function update(Request $request, $id)
    {
        // Retrieve the business instance
        $business = Business::findOrFail($id);
    
        $request->validate([
            'business_name' => 'required|string|max:255|unique:business,business_name,' . $business->id,
        ]);
    
        $slug = Str::slug($request->business_name, '-');
        
        $count = Business::where('slug', 'LIKE', "$slug%")
                        ->where('id', '!=', $business->id)
                        ->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }
    
        $business->update([
            'business_name' => $request->business_name,
            'slug' => $slug,
            'modified_at' => Carbon::now(),
            'modified_by' => Auth::id(),
        ]);
    
        return redirect()->route('business.index')->with('message', 'Business updated successfully!');
    }


    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = Business::findOrFail($id);
            $industries->update($data);

            return redirect()->route('business.index')->with('message', 'Business deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}