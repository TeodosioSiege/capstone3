<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\User;

use App\Job;

use App\Job_User;

use DB;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->roles()->pluck('name') == '["admin"]') {
            return redirect('/applications');
        } else {
        $job_user = DB::table('job__users')
        ->leftJoin('jobs','job__users.job_id','=','jobs.id')
        ->leftJoin('users','job__users.user_id','=','users.id')
        ->where('users.id','=',Auth::user()->id)
        ->get();
        return view('home')->with('job_user', $job_user);
        }
    }
    public function sandbox() {
        $user = User::find(10);
        return view('sandbox')->with('user',$user);
    }
}
