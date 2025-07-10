<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\catagory;
use App\Models\product;

class CatagoryPageController extends Controller
{
    function index() {

        $catagory_id = request('id');

        $catagory_slider_imgs = catagory::where('id', $catagory_id)->pluck('Catagory_slider_images')->first();

        $slider_images = array_map('trim', explode(',', $catagory_slider_imgs));

        $best_selling_products = product::orderBy('Number_of_sells', 'desc')->where('Product_catagory', 'test')->take(9)->get();

        $amazing_offers = product::orderBy('Product_discount', 'desc')->where('Product_catagory', 'test')->take('12')->get();

        $catagories = product::select('Product_catagory')->distinct()->get();

        return view('catagory_page', [
            'sliders' => $slider_images,
            'best_selling_products' => $best_selling_products,
            'amazing_offers' => $amazing_offers,
            "catagories" => $catagories,
        ]);

    }
}
