@extends('layouts.main_layout');



@section('css_link');
    <link rel="stylesheet" href="{{ asset('assets/css/catagory_page.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/common_css.css') }}">
@endsection



@section('content');
    <div class="main-container">
        <div>
            <!-- slider -->
            <div class="slider">
                @foreach($sliders as $slider)
                    @if($slider === 'assets/images/catagory_images/slider/1.webp') <!-- Needs to get fixed -->
                        <img class="slide current-slide" src='{{ asset($slider) }}' alt="">
                    @else
                        <img class="slide none" src="{{ asset($slider) }}" alt="">
                    @endif
                @endforeach
                <!-- <div class="slider-btn"> -->
                <img class="next" src="{{ asset('assets/images/next_icon.png') }}" alt="">
                <img class="back" src="{{ asset('assets/images/next_icon.png') }}" alt="">
                <!-- </div> -->
            </div>
            <!-- slider -->
        </div>
        <div class="amazing">
            <div class="text-and-timer-container">
                <div class="text-container">
                    <h3>Amazing</h3>
                    <h3>Offers</h3>
                </div>
                <div class="timer-container">
                    <span class="hour bg-white">00</span>
                    :
                    <span class="min bg-white">00</span>
                    :
                    <span class="sec bg-white">00</span>
                </div>
            </div>
            <div class="offers">
                <img class="next-amaz-offer" src="{{ asset('assets/images/next_icon.png') }}" alt="">
                <img class="perv-amaz-offer" src="{{ asset('assets/images/next_icon.png') }}" alt="">
                @foreach($amazing_offers as $amazing_offer)
                    <div class="offer" onclick="setTheUrl({{ $amazing_offer->Product_id }})">
                        <div class="img-and-text-container">
                            <img src="{{ asset($amazing_offer->Product_image) }}" alt="">
                            <p>Lorem ipsum dolor sit, amet ...</p>
                        </div>
                        <div class="prices-and-discount-container">
                            <div class="new-price-and-discount-con">
                                <span class="price">$ {{ $amazing_offer->Product_price }}</span>
                                <span class="discount">{{ $amazing_offer->Product_discount }} %</span>
                            </div>
                            <div class="old-price">
                                <span class="old-price">$ {{ $amazing_offer->Product_old_price }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        </div>
        <div class="best-selling-products-main-con">
            <div class="title">
                <span>Best selling products</span>
            </div>
            <div class="best-selling-products">
                @php
                    $counter = 1;
                @endphp
                @foreach($best_selling_products as $best_selling_product)
                    <div class="product" onclick="setTheUrl({{ $best_selling_product->Product_id }})">
                        <img src="{{ asset($best_selling_product->Product_image) }}" alt="">
                        <span style="font-size: 30px;color: gray;font-weight: bold;">{{ $counter++ }} &nbsp</span>
                        <div style="display: inline;" class="product-text">
                            Lorem ipsum dolor sit amet.
                        </div>                        
                    </div>
                    <hr style="color: gray;width: 20%;margin-bottom: 10px;">
                @endforeach
            </div>
        </div>
    </div>
    <footer>
        <div class="footer-content">
            <div class="email-bar">
                <h2>Want us to email you occasionally with new offers ?</h2>
                <input type="email" placeholder="Enter your email address ">
            </div>
            <div class="some-explain">
                <div class="left-side">
                    <h1>DIGIKALA</h1><br>
                    <P>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur, assumenda?</P>
                </div>
            </div>
        </div>
        <div class="website-creator">
            <span>Website design and implement by : sorce web group</span>
            <span>Website : sorceweb.com</span>
            <span>@copyright 2024</span>
        </div>
    </footer>
@endsection



@section('script-tag')
    <script src="{{ asset('assets/js/catagory_page.js') }}"></script>
    <script src="{{ asset('assets/js/common_funcs.js') }}"></script>
@endsection