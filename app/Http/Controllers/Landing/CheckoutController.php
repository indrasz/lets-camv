<?php

namespace App\Http\Controllers\Landing;

use App\Models\Cart;
use App\Models\Destination;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request, $id)
    {
        $item = Cart::with(['user', 'camv', 'destination.gallery',])->findOrFail($id);
        return view('pages.landing.checkout', [
            'item' => $item
        ]);
    }

    public function create(Request $request, $id)
    {

        $request->validate([
            'transaction_total' => 'required',
            'booking_date' => 'required',
        ]);


        $data = $request->all();
        $data['destinations_id'] = $id;
        $data['camvs_id'] = $id;
        $data['users_id'] = Auth::user()->id;

        Transaction::create($data);

        toast()->success('Transaction Success');
        return redirect()->route('checkout-success');
    }

    public function success()
    {
        return view('pages.landing.booking');
    }
}
