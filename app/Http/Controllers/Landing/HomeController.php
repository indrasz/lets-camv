<?php

namespace App\Http\Controllers\Landing;

use App\Models\Destination;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {

        $destination = Destination::orderBy('created_at', 'desc')->with('gallery')->take(6)->get();

        return view('pages.landing.index', compact('destination'));
    }
}
