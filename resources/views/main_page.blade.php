@extends('layouts.main_layout');

@section('css_link');

    <link rel="stylesheet" href="{{ asset('assets/css/main_page.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/common_css.css') }}">

@endsection

@section('content');


    <!-- This main container is naccesary for avoiding to placing the STORY part behind the main header -->
    <div class="main-container">


            <!-- Stories part -->
                <div class="stories">
                    @foreach($stories as $story)
                        <div class="story" onclick="openOrCloseStoryProductPage({{ $story->Product_id }}, {{ json_encode($story->Product_image) }}, openMode = true)">
                            <img src="{{ $story->Product_image }}" alt="">
                            <span>{{ $story->Story_sub_title }}</span>
                        </div>
                    @endforeach
                </div>
            <!-- Stories part -->


            <!-- slider -->

                <div class="slider">
                    @foreach($sliders as $slider)

                        <!-- This if is naccesary for putting CURRENT-SLIDE class in first slide -->
                        @if($sliders[0]->Product_image == $slider->Product_image)  
                            <img onclick="setTheUrl({{ $slider->Product_id }})" class="slide current-slide" src="{{ $slider->Product_image }}" alt="">
                        @else
                            <img onclick="setTheUrl({{ $slider->Product_id }})" class="slide none" src="{{ $slider->Product_image }}" alt="">
                        @endif
                        
                    @endforeach
                    <!-- <div class="slider-btn"> -->
                    <img class="next" src="{{ asset('assets/images/next_icon.png') }}" alt="">
                    <img class="back" src="{{ asset('assets/images/next_icon.png') }}" alt="">
                    <!-- </div> -->
                </div>

            <!-- slider -->


    <div>



    <!-- Amazing offers part -->

        <div class="amazing-test">
            <div class="timer-container">
                <div><span class="hour">Time left</span></div>
                <div>
                    <span class="hour">00</span>
                    :
                    <span class="min">00</span>
                    :
                    <span class="sec">00</span>
                </div>
            </div>
            <div class="amazing">
                <div class="text-and-timer-container">
                    <div class="text-container">
                        <h3>Amazing</h3>
                        <h3>Offers</h3>
                    </div>
                </div>
                <div class="offers">
                    <img class="next-amaz-offer" src="{{ asset('assets/images/next_icon.png') }}" alt="">
                    <img class="perv-amaz-offer" src="{{ asset('assets/images/next_icon.png') }}" alt="">
                    @foreach($amazing_offers as $amazing_offer)
                        <div class="offer" onclick="setTheUrl({{ $amazing_offer->Product_id }})">
                            <div class="img-and-text-container">
                                <img src="{{ $amazing_offer->Product_image }}" alt="">
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

    <!-- Amazing offers part -->




    <!-- Advertisment -->

        <div class="advertisment-container">
            @foreach($ads as $ad)
                <div class="ad">
                    <img src="{{ $ad->ad_image }}" alt="">
                </div>
            @endforeach
        </div>

    <!-- Advertisment -->



    <!-- Sidiq part -->   <!-- Bad coded -->  

        @php 
            $counter = 0;
            $sec_counter = 0;
            $images_list = [];
            $products_catagories = [];
            foreach($watchs as $watch){
                if( !in_array($watch->Product_catagory, $products_catagories) ) {
                    array_push($products_catagories, $watch->Product_catagory);
                }
                array_push($images_list, $watch->Product_image);
            };
        @endphp
        <div class="container">
            @for($i = 0; $i <= 13 ; $i++)
                <div class="row">
                    <div class="titles">
                        <h2 class="title1">2</h2>
                        <h3 class="title2">Title Two</h3>
                    </div>
                    @for($i = $counter ; $i < $counter + 4 ; $i ++)
                        <img src="{{ asset($images_list[$i]) }}" alt="Image 1">
                    @endfor
                    @php
                        $counter += 4;
                    @endphp
                    <div class="btn-con">
                        <button onclick="viewALLBtnFunc('{{ $products_catagories[$sec_counter] }}')" class="see_all">< View</button>
                    </div>
                    @php
                        $sec_counter += 1;
                    @endphp
                </div>
            @endfor
        </div>

    <!-- Sidiq part -->

        

    <!-- Shoppin by catagory -->

        <div class="shop-by-catagory-container">
            <div class="title">
                <span>Shop by catagory</span>
            </div>
            <div class="catagories">
                @foreach($catagories_content as $catagory)
                    <div class="catagory" onclick="setThisUrl({{ json_encode($catagory->Catagory_name) }},{{ $catagory->id }})">
                        <img src="{{ $catagory->Catagory_image }}" alt="">
                        <span>
                            @if($catagory->Catagory_name != '')
                                {{ $catagory->Catagory_name }}
                            @else
                                somthing
                            @endif
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

    <!-- Shoppin by catagory -->


    <!-- Best selling products part -->

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
                        <img src="{{ $best_selling_product->Product_image }}" alt="">
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

    <!-- Best selling products part -->

    <!-- Footer -->

        <footer style="color: #f0f0f0; padding: 40px 20px;">
            <div style="display: flex; flex-wrap: wrap; justify-content: space-between; max-width: 1200px; margin: 0 auto;">
                
                <!-- Company Information Section -->
                <div style="flex: 1; min-width: 200px; margin-bottom: 20px;">
                <h3>About Us</h3>
                <p>We are a dropshipping platform dedicated to providing high-quality products and excellent services to our customers.</p>
                </div>
                
                <!-- Quick Links Section -->
                <div style="flex: 1; min-width: 200px; margin-bottom: 20px;">
                <h3>Quick Links</h3>
                <ul style="list-style: none; padding: 0;">
                    <li><a href="/about" style="color: #d3d3d3; text-decoration: none;">About Us</a></li>
                    <li><a href="/faq" style="color: #d3d3d3; text-decoration: none;">FAQ</a></li>
                    <li><a href="/contuct" style="color: #d3d3d3; text-decoration: none;">Contact Us</a></li>
                    <li><a href="/support" style="color: #d3d3d3; text-decoration: none;">Customer Support</a></li>
                </ul>
                </div>
                
                <!-- Policies Section -->
                <div style="flex: 1; min-width: 200px; margin-bottom: 20px;">
                <h3>Policies</h3>
                <ul style="list-style: none; padding: 0;">
                    <li><a href="/privacy-policy" style="color: #d3d3d3; text-decoration: none;">Privacy Policy</a></li>
                    <li><a href="/terms" style="color: #d3d3d3; text-decoration: none;">Terms & Conditions</a></li>
                    <li><a href="/return-policy" style="color: #d3d3d3; text-decoration: none;">Return Policy</a></li>
                </ul>
                </div>
                
                <!-- Social Media & Contact Section -->
                <div style="flex: 1; min-width: 200px; margin-bottom: 20px;">
                <h3>Follow Us</h3>
                <a href="https://instagram.com" style="color: #d3d3d3; margin-right: 10px; text-decoration: none;">Instagram</a>
                <a href="https://facebook.com" style="color: #d3d3d3; margin-right: 10px; text-decoration: none;">Facebook</a>
                <a href="https://linkedin.com" style="color: #d3d3d3; text-decoration: none;">LinkedIn</a>
                <h3 style="margin-top: 20px;">Contact Us</h3>
                <p>Phone: +93796903893</p>
                <p>Email: sediqj42@gmail.com</p>
                </div>
                
                <!-- Newsletter Subscription and Payment Methods Section -->
                <div style="flex: 1; min-width: 200px; margin-bottom: 20px;">
                <h3>Subscribe to Our Newsletter</h3>
                <input type="email" class="email_for_sub" placeholder="Enter your email" style="padding: 10px; width: 100%; margin-bottom: 10px; border: 1px solid #555; border-radius: 5px; color: #333;">
                <button class="subscribe-btn" onclick="varifyEmail({{ Auth::id() == null }})" style="padding: 10px; width: 100%; color: white; border: none; border-radius: 5px;background-color:#A044FF"><img style="width:20px;display:none" src="{{ asset('assets/images/giphy.gif') }}" alt=""><span>Subscribe</span></button>
                <h3 style="margin-top: 20px;">Secure Payment Options</h3>
                <p>
                    <img src="visa-logo.png" alt="Visa" style="width: 40px; margin-right: 10px;">
                    <img src="mastercard-logo.png" alt="MasterCard" style="width: 40px; margin-right: 10px;">
                    <img src="paypal-logo.png" alt="PayPal" style="width: 40px;">
                </p>
                </div>
                
            </div>
            <hr style="border-color: #555;">
            <p style="text-align: center; margin-top: 10px;">&copy; 2024 Your Website Name. All rights reserved.</p>
        </footer>

    <!-- Footer -->



    <!-- Stories page -->

        <!-- This layout will sansor main page when story page appear -->
            <div class="overlay"></div>
        <!-- This layout will sansor main page when story page appear -->

        <div class="story-page">
            <div style="display:none;" class="story-page-content">
                <img class="hide-stories-page-children" src="assets/images/close.png" alt="" onclick="openOrCloseStoryProductPage()">
                <img class="product-img hide-stories-page-children" src="" alt="">
                <div class="stories-page-btns hide-stories-page-children">
                    <button>Buy</button>
                    <button class='add-to-cart add-btn' onclick="sentIdToServer(id = this.productId)"><img style="display:none;" src="{{ asset('assets/images/giphy.gif') }}" alt=""><span>Add to Cart</span></button>
                </div>
            </div>
        </div>
        
    <!-- Stories page -->

    <!-- Varify page -->

        <div class="varify_page">
            <h2>Varifying your email</h2>
            <input class="inserted_code" type="text" placeholder="Enter varification code " maxlength="6">
            <div class="timer" id="timer">Remaining time : 30</div>
            <button class="varify_email_btn">Varify</button>
        </div>

    <!-- Varify page -->


@endsection;


@section('script-tag')
    <script src="{{ asset('assets/js/index.js') }}"></script>
    <script src="{{ asset('assets/js/common_funcs.js') }}"></script>
@endsection