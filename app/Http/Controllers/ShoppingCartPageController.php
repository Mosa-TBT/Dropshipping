<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\shopping_card;
use App\Models\product;
use Auth;

class ShoppingCartPageController extends Controller
{
    public function index() {

        $user_shopping_cart_content = shopping_card::select('id', 'Product_id', 'Quantity')->where('user_id', Auth::id())->get();

        $catagories = product::select('Product_catagory')->distinct()->get();

        $shopping_cart_products = [];

        $number_of_goods_in_cart = 0;
        
        foreach($user_shopping_cart_content as $no_name) {
            $shopping_cart_products[] = product::where('Product_id', $no_name->Product_id)->get();
            end($shopping_cart_products)->id = $no_name->id;
            end($shopping_cart_products)->Quantity = $no_name->Quantity;
            $number_of_goods_in_cart += $no_name->Quantity;   
        }

        if(Auth::id() == null) {
            return view('auth/login');
        }else {
            return view('shopping_cart', [
                'shopping_carts_content' => $shopping_cart_products,
                'number_of_goods_in_cart' => $number_of_goods_in_cart,
                'catagories' => $catagories,
            ]);
        }
    }

    public function destroy($id) {

        $product_in_cart = shopping_card::findOrFail($id);

        if($product_in_cart && $product_in_cart->Quantity > 1) {

            $product_in_cart->Quantity -= 1;

            $product_in_cart->save();

        }else if($product_in_cart && $product_in_cart->Quantity == 1){

            shopping_card::destroy($id);

        }

        echo json_encode(['is_deleted' => true]);

        // header("Location: http://127.0.0.1:8000/shopping_cart");
        exit;
    }

    public function destroy_all() {

        shopping_card::where('user_id', Auth::id())->delete();

        echo json_encode(['all_deleted' => true]);

    }
}
