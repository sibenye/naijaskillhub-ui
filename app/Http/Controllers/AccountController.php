<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
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
     * Show the account page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('account.dashboard');
    }
}