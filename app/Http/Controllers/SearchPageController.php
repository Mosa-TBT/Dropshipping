<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;

class SearchPageController extends Controller
{
    
    function index(Request $request) {
        
        $litters = $request->query('search', 'test');

        $result = product::where('Product_catagory', 'like', $litters . '%')->get();

        return response()->json($result);
        
    }

}
