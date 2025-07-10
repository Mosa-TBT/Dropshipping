<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{
    public function showForm()
    {
        return view('payment_page', [
            'stripKey' => env('STRIPE_PUBLIC_KEY'),
        ]);
    }

    public function processPayment(Request $request)
    {

        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        try {

            $charge = Charge::create([
                'amount' => '2000',                            // Amount in cent
                'currency' => 'eur',                           // Currency
                'source' => $request->input('stripeToken'),    // Token
                'description' => 'Payment Description',        // Description
            ]);

            echo json_encode(['is_prosseced' => true]);
            
        } catch (\Exception $e) {


            return redirect()->back()->with('error', $e->getMessage());

        }
    }
}
