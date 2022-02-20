<?php

namespace App\Http\Controllers\Landing;

use Carbon\Carbon;
use App\Models\Camv;
use App\Models\Destination;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CamvController extends Controller
{
    public function index(Request $request, $id)
    {
        $camv = Camv::orderBy('created_at', 'desc')->with('feature')->get();
        $destination = Destination::findOrFail($id);
        return view('pages.landing.camv', compact('camv', 'destination'));
    }

    public function add(Request $request, $id)
    {
        $data = Cart::create([
            'destinations_id' => $id,
            'users_id' => Auth::user()->id,
            'camvs_id' => $id,
        ]);

        return redirect()->route('checkout', $data->id);
    }
}
