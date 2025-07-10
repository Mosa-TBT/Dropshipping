<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\shopping_card;
use Auth;

class ProductPageController extends Controller
{
    function index($id) {

        $exists = product::where('Product_id', $id)->exists();

        if($exists) {

            $product = product::where('Product_id', $id)->get();

            $product_colors = product::where('Product_id', $id)->pluck('Product_colors')->first();
    
            if($product_colors != 'No colors') {
                $product_colors = array_map('trim', explode(',', $product_colors));
            }
    
            $similar_products = product::where('Product_catagory', $product[0]->Product_catagory)->take(4)->get();
    
            return view('product_page',[
                'product' => $product,
                'similar_products' => $similar_products,
                'product_colors' => $product_colors,
            ]);

        }else {

            header('Location: http://127.0.0.1:8000');

            exit;

        }
    }

    function store(Request $request) {

        $exists = shopping_card::where('user_id', Auth::id())->where('Product_id', $request->id)->exists();

        if($exists == 1) {

            $product = shopping_card::where('Product_id', $request->id)->first();

            $product->Quantity += 1;

            $product->save();

            echo json_encode(['is_added' => true]);

        }else if(product::where('Product_id', $request->id)->exists()){

            $shopping_cart = new shopping_card();
            
            $shopping_cart->user_id = Auth::id();

            $shopping_cart->Product_id = $request->id;

            $shopping_cart->save();

            echo json_encode(['is_added' => true]);

        }else {
            echo json_encode(['is_added' => false]);
        }

    }
}
