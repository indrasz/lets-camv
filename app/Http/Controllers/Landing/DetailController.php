<?php

namespace App\Http\Controllers\Landing;

use Carbon\Carbon;
use App\Models\Camv;
use App\Models\Destination;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    public function index(Request $request, $id)
    {
        $destination = Destination::with(['gallery'])->where('slug', $id)->firstOrFail();
        return view('pages.landing.detail', [
            'destination' => $destination,
        ]);
    }

    // public function add(Request $request, Destination $destination, Camv $camv)
    // {
    //     dd($request->all());
    //     $destination_id = Destination::findOrFail($destination);
    //     $camv_id = Camv::findOrFail($camv);
    //     $data = [
    //         'destinations_id' => $destination_id,
    //         'camvs_id' => $camv_id,
    //         'users_id' => Auth::user()->id,
    //         'transaction_total' => 0,
    //         'booking_date' => Carbon::now()
    //     ];

    //     Transaction::create($data);

    //     return redirect()->route('chekout');
    // }
}
