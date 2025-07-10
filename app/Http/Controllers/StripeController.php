<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use App\Models\product;

class StripeController extends Controller
{
    public function stripe(string $id)
    {

        $productPrice = product::select("Product_price")->where("Product_id", $id)->firstOrFail()->Product_price;

        return view('payment_page', [
            "price" => $productPrice
        ]);
    }

    public function stripePost(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        \Stripe\Charge::create([
            "amount" => "100",
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "پرداخت تستی توسط موسی"
        ]);

        return back()->with('success', 'پرداخت با موفقیت انجام شد!');
    }
}

