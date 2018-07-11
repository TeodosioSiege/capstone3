<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Job;

class JobsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$jobs = Job::all();
        $jobs = Job::orderBy('created_at','desc')->paginate(5);
        return view('jobs.index')->with('jobs',$jobs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->roles()->pluck('name') == '["admin"]') {
            return view('jobs.create');
        } else {
            return redirect('/join-us');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'jobTitle' => 'required',
            'location' => 'required',
            'minQualifications' => 'required'
        ]);

        //Create Job

        $job = new Job;
        $job->jobTitle = $request->input('jobTitle');
        $job->location = $request->input('location');
        $job->minQualifications = $request->input('minQualifications');
        $job->status = 'Open';
        $job->save();

        return redirect('/join-us')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return $id;
        $job = Job::find($id);
        //return $job;
        return view('jobs.show')->with('job',$job);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->roles()->pluck('name') == '["admin"]') {
            //return $id;
        $job = Job::find($id);
        // return $job;
        return view('jobs.edit')->with('job',$job);
        } else {
            return redirect('/join-us');
        }  
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
        $this->validate($request, [
            'jobTitle' => 'required',
            'location' => 'required',
            'minQualifications' => 'required'
        ]);

        $job = Job::find($id);
        $job->jobTitle = $request->input('jobTitle');
        $job->location = $request->input('location');
        $job->minQualifications = $request->input('minQualifications');
        $job->status = 'Open';
        $job->save();

        return redirect('/join-us')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = job::find($id);
        $job->delete();

         return redirect('/join-us')->with('success','Post Deleted');     
    }
    public function back(){
        return redirect()->back();
    }
}
