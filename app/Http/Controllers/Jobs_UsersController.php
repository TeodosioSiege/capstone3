<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\User;

use App\Job;

use App\Job_User;

use DB;

use Validator;

class Jobs_UsersController extends Controller
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
        if (Auth::user()->roles()->pluck('name') == '["admin"]') {
        $applications = Job::all();

        return view('applications.index')->with('applications', $applications);
         }else {
            return redirect('/join-us');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($job_id)
    {
        if (Auth::user()->roles()->pluck('name') == '["applicant"]') {
        $info = array(
        'job' => Job::find($job_id),
        'user' => User::find(Auth::user()->id) 
        );
        return view('applications.create')->with($info);
        } else {
            return redirect('/applications');
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
        $job_user = Job_User::where('user_id', Auth::user()->id)
        ->where('job_id', $request->input('job_id'))
        ->get();
        if (count($job_user) > 0) {
            $this->validate($request, [
            'user_id' => 'required',
            'job_id' => 'required|unique:job__users,job_id',
        ]);
        }else {
            $this->validate($request, [
            'user_id' => 'required',
            'job_id' => 'required',
        ]);
        }
            

        //Create Job

        $apply = new Job_User;
        $apply->user_id = $request->input('user_id');
        $apply->job_id = $request->input('job_id');
        $apply->comment = $request->input('comment');
        $apply->save();

        return redirect('/join-us')->with('success', 'Application Sent');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $application = Job::find($id);
        return view('applications.show')->with('application',$application);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->roles()->pluck('name') == '["admin"]'){
            return redirect('/applications');
        }elseif (Auth::user()->roles()->pluck('name') == '["applicant"]') {
            $info = array(
        'job_user' => Job_User::where('user_id',Auth::user()->id)->where('job_id',$id)->get(),
        'job' => Job::find($id)
        );
        return view('applications.edit')->with($info);
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
        $job_user = Job_User::find($id);
        $job_user->comment = $request->input('comment');
        $job_user->save();
        return redirect('/home')->with('success','Application Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->roles()->pluck('name') == '["admin"]') {
        $job_user = DB::table('job__users')
        ->where('job_id',$id);
        $job_user->delete();

        return redirect('/applications')->with('success','Application Closed'); 
        } elseif (Auth::user()->roles()->pluck('name') == '["applicant"]') {
            $job_user = DB::table('job__users')
            ->where('job_id', $id)
            ->where('user_id', Auth::user()->id);
            $job_user->delete();
            return redirect('/home')->with('success','Application Cancelled'); 
        }
        
    }
    public function goBack(){
        return redirect(session('links')[2]);
    }
}
