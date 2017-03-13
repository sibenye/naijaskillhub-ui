<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the profile edit page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('profile.edit.profile-edit');
    }
}