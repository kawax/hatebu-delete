<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(Request $request)
    {
        return view('home');
    }
}
