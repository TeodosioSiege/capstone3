<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Artisan;

use App\User;

use App\Resume;

use Illuminate\Support\Facades\Storage;

class ResumesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $filenameWithExt = $request->file('resume')->getClientOriginalName();
        $filename = Auth::user()->name;
        $extension = $request->file('resume')->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;        

        //upload resume
        $path = $request->file('resume')->storeAs('public/resumes', $fileNameToStore);

        $resume = new Resume;
        $resume->user_id = Auth::user()->id;
        $resume->resume = $fileNameToStore;
        $resume->save();

        return redirect('/home')->with('success', 'Resume Uploaded');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::guest()) {
            return redirect()->back();
        }
        if (Auth::user()->roles()->pluck('name') == '["applicant"]'){
            return redirect()->back();
        }
        if (Auth::user()->roles()->pluck('name') == '["admin"]') {
             $resume = Resume::where('user_id', $id)->get();
            if (count($resume) > 0) {
            foreach ($resume as $resume) {
            $file = $resume->resume;
            $filePath = public_path()."/storage/resumes/".$file;
            $fileName = $resume->resume;
            $headers = [
                  'Content-Type' => 'application/msword',
               ];

    return response()->download($filePath, $fileName, $headers);
    }
            }else{return redirect()->back()->with('error','Unable to access Resume');}
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->hasFile('resume')) {
            $oldResume =  Auth::user()->resume->resume;
            Storage::delete("public/resumes/$oldResume");

        $filenameWithExt = $request->file('resume')->getClientOriginalName();
        $filename = Auth::user()->name;
        $extension = $request->file('resume')->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;   
        //upload resume
        $path = $request->file('resume')->storeAs('public/resumes', $fileNameToStore);

        $resume = Resume::where('user_id', Auth::user()->id)->first();
        $resume->resume = $fileNameToStore;
        $resume->save();

        return redirect('/home')->with('success', 'Resume Uploaded');
        } else {
            return redirect('/home')->with('error','Please select a file');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function downloadResume() {
        if (!empty(Auth::user()->resume)) {
            
        $file = Auth::user()->resume->resume;
        $filePath = public_path()."/storage/resumes/".$file;
        $fileName = Auth::user()->name.".docx";
        $headers = [
              'Content-Type' => 'application/msword',
           ];

    return response()->download($filePath, $fileName, $headers);
        } else {
            return redirect('/');
        }
    }
    
    }
