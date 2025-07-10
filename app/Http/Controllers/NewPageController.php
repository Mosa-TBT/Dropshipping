<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\product;

class NewPageController extends Controller
{
    //

    function index($product_catagory) {

        $first_catagory = product::where('Product_catagory', $product_catagory)->get();

        return view('new_page', [
            'first_catagory' => $first_catagory,
        ]);
    }
}
