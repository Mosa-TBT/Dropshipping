<?php

namespace App\Http\Controllers;

use App\Models\advertisment;
use App\Models\slider;
use App\Models\catagory;
use App\Models\product;

class MainPageController extends Controller
{

    public function index() {

        $stories_content = product::where('Is_story', true)->get();

        $sliders_content = product::where('Is_slider', true)->get();

        $ads_content = advertisment::all();

        $catagories_content = catagory::all();

        $best_selling_products = product::orderBy('Number_of_sells', 'desc')->take(9)->get();

        $amazing_offers = product::orderBy('Product_discount', 'desc')->take('12')->get();

        $test = product::where('Product_catagory', 'test')->take(4)->get();

        $test1 = product::where('Product_catagory', 'test1')->take(4)->get();

        $test2 = product::where('Product_catagory', 'test2')->take(4)->get();

        $watch = product::where('Product_catagory', 'watch')->take(4)->get();

        $watchs = $test->concat($watch->concat($test1->concat($test2)));

        $catagories = product::select('Product_catagory')->distinct()->get();
        
        return view('main_page', [
            "stories" => $stories_content,
            "sliders" => $sliders_content,
            "ads" => $ads_content,
            "catagories_content" => $catagories_content,
            "best_selling_products" => $best_selling_products,
            "amazing_offers" => $amazing_offers,
            "watchs" => $watchs,
            "catagories" => $catagories,
        ]);
    }
}
