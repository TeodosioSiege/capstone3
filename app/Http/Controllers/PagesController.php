<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
    	$title = 'Welcome to finessa!';
    	return view('index')->with('title',$title);
    }
    public function about() {
    	$title = 'About us';
    	return view('about')->with('title',$title);
    }
}
