<?php

namespace App\Http\Controllers\Admin\Academics;

use App\ApiBaseMethod;
use App\Http\Controllers\Controller;
use App\Models\Objective;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SmObjectiveController extends Controller
{
    public function __construct()
    {
        $this->middleware('PM');
        // User::checkAuth();
    }

    public function index(Request $request)
    {
        try {
            $objective = Objective::where('active_status', 1)->where('school_id', Auth::user()->school_id);
            $objective = $objective->where('subject_id', Auth::user()->school_id);
            $objective = $objective->where('subject_id', Auth::user()->school_id)->get();

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendResponse($objective, null);
            }
            return view('backEnd.academics.objective', compact('objective'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function show(Request $request, $id)
    {
        try {
            if (checkAdmin()) {
                $academic_year = Objective::find($id);
            } else {
                $academic_year = Objective::where('id', $id)->where('school_id', Auth::user()->school_id)->first();
            }
            $academic_years = Objective::where('school_id', Auth::user()->school_id)->get();
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['academic_year'] = $academic_year->toArray();
                $data['academic_years'] = $academic_years->toArray();
                return ApiBaseMethod::sendResponse($data, null);
            }
            return view('backEnd..academics.objective', compact('academic_year', 'academic_years'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        Toastr::error('Operation Failed', 'Failed');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'subject_id' => 'required',
            'text' => 'required',
            'term_type' => 'required',
            'section_id' => 'required',
        ]);

        try {
            $objective = Objective::find($id);
            $objective->update([
                'subject_id' => $request->input('subject_id'),
                'text' => $request->input('text'),
                'term_no' => $request->input('term_type'),
                'section_id' => $request->input('section_id'),
            ]);

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['success'] = true;
                return ApiBaseMethod::sendResponse($data, null);
            }
            return view('backEnd.academics.objective', compact('academic_year', 'academic_years'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }

        // Return a response indicating success
        return response()->json(['message' => 'Objective updated successfully', 'data' => $objective], 200);
    }

    public function destroy(Request $request, $id)
    {
        try {
            if (checkAdmin()) {
                $objective = Objective::find($id);
                $objective->delete();
            } 
         
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['success'] = true;
                return ApiBaseMethod::sendResponse($data, null);
            }
            return view('backEnd.academics.objective', compact('academic_year', 'academic_years'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }

       
        
    }
}
