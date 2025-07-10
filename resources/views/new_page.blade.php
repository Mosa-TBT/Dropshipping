<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Fixed Sidebar with Image Gallery</title>
    <link rel="stylesheet" href="{{ asset('assets/css/new_page.css') }}">
</head>
<body>
    <!-- Sidebar section -->
    <div class="sidebar">
        <h2>Main Menu</h2>
        <a href="#" class="links">Phones</a>
        <a href="#" class="links">Clothing</a>
        <a href="#" class="links">Fashion</a>
        <a href="#" class="links">watches</a>
        <a href="#" class="links">ladies cosmetics</a>
        <a href="#" class="links">Home Appliances</a>
        <a href="#" class="links">Discount</a>
        <a href="#" class="links">new porduct</a>
    </div>
    <div class="content">
        <div class="main-title">{{ $first_catagory[0]->Product_catagory }}s</div>
        <div class="tow-con">
            @for($i = 2; $i < 3; $i++)
                <div class="container_{{ $i }}">
                    @foreach($first_catagory as $index => $first)
                        <div class="container">
                            <img src="{{ asset($first->Product_image) }}" alt="Image" class="image">
                            <div class='details-con'>
                                <div class="title-c">
                                    <span>Title :</span>
                                    <p class='titles'>{{ $first->Product_title }}</p>
                                </div>
                                <div class='details-c'>
                                    <span>Details :</span><br>
                                    <p class='details'>{{ $first->Product_details }}</p>
                                </div>
                            </div>
                            <button class='add-to-cart add-btn' onclick="sentIdToServer(id = {{ $first->Product_id }}, this)"><img style="display:none;" src="{{ asset('assets/images/giphy.gif') }}" alt=""><span>Add to Cart</span></button>
                            <button>Buy</botton>
                        </div>
                    @endforeach
                </div>
            @endfor
        </div>
    </div>
    <script src="{{ asset('assets/js/new_page.js') }}"></script>
</body>
</html>