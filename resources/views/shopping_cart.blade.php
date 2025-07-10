@extends('layouts.main_layout')

@section('css_link');
<link rel="stylesheet" href="assets/css/shopping_cart.css">
@endsection

@section('content');

    <div class="main-container">

        <div class="left-side-content-container">
            <!-- <div class="title-and-num-of-goods-con"> -->
                <div class="title-and-num-of-goods-con">
                    <span>Your shopping cart</span>
                    <span style="color: gray;">Number of goods in your shopping cart ( {{ $number_of_goods_in_cart }} )</span>
                </div>
            <!-- </div> -->
            <hr style="color: gray;width: 90%;">
            <div class="goods-in-cart">
                <div class="commodity">
                    @foreach($shopping_carts_content as $shopping_cart_content)
                        <div class="commodity-in-cart">
                            <div class="commodity-img-and-details">
                                <img src="{{ $shopping_cart_content[0]->Product_image }}" alt="">
                                <div class="commodity-details">
                                    <span>{{ $shopping_cart_content[0]->Product_title }}</span>
                                    <br>
                                    <span>{{ $shopping_cart_content[0]->Product_colors }}</span>
                                    <br>
                                    <span>{{ $shopping_cart_content[0]->Product_details }}</span>
                                    <br>
                                    <span>Number of available in cart : {{ $shopping_cart_content->Quantity }}</span>
                                    <br>
                                    <span>Lorem ipsum dolor sit.</span>
                                </div>
                            </div>
                            <hr style="color: gray;width: 90%;margin-bottom: 10px;">
                            <div class="price-and-delete-and-perches-btn">
                                <span>Price : {{ $shopping_cart_content[0]->Product_price }} $</span>
                                <form onsubmit="hundleDeleteBtnPer(event, {{ $shopping_cart_content->id }})">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit">Delete from cart</button>
                                </form>
                                <a href="{{ route('stripe.form', ['id' => $shopping_cart_content[0]->Product_id]) }}"><button class="perches-btn" product-name="{{ $shopping_cart_content[0]->Product_name }}" product-price="{{ $shopping_cart_content[0]->Product_price }}">Perchase</button></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Calculating the total price of products which placed in shopping cart before -->

        @php
            $total_price = 0;
            foreach($shopping_carts_content as $shopping_cart_content) {
                $total_price += $shopping_cart_content[0]->Product_price;
            }
                    
        @endphp

        <!-- Calculating the total price of products which placed in shopping cart before -->
        <div class="right-side-content-container">
            <div class="price-and-perchese-btn-con">
                <div class="price">
                    <span>Total price of {{ $number_of_goods_in_cart }} goods in your cart: </span>
                    <span>{{ $total_price }} $</span>
                </div>
                <button>Perchase all orders</button>
            </div>
            <div class="txt">
                <div class="main-title">somthing</div>
                <div class="details">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum tempora ducimus esse est cum officiis repellat unde tempore optio fugit earum provident dolorum, magnam voluptatibus? Voluptates doloribus nam deserunt adipisci?
                </div>
                <button onclick="delAllFromShoppingCart()">Delete all goats <br> from shopping cart</button>
            </div>
        </div>
        
    </div>

@endsection;

@section('script-tag')
<script src="{{ asset('assets/js/sopping_cart.js') }}"></script>
@endsection