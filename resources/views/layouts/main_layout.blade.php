<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main_layout.css') }}">

    @yield('css_link');
    
</head>
<body>

    <header class="header">

        <div class="top-notification-container">
            <span class="new-noti">
                NEW OFFERS IS AVAILABLE !!!
            </span>
        </div>
        <div class="main-content-of-header-con">
            <div class="search-bar-and-logo">
                <img src="{{ asset('assets/images/digikala_logo.png') }}" alt="">
                <input class="search-bar" type="text" placeholder="Search for catagory">
            </div>
            <div class="signin-signup-and-perchese-con">
                <a href='login'><button>
                    @if(Auth::id() == null)
                        Sign in | Sign up
                    @else 
                        <p>Signed in &nbsp &#10003</p>
                    @endif
                </button></a>
                <img class='shoping_icon' src="{{ asset('assets/images/shopping_icon.png') }}" alt="">
            </div>
        </div>
        
    </header>


    <div class="menu-bar">
        <div class="menu">

            <img src="{{ asset('assets/images/menu.png') }}" alt="">   <!-- MENU LOGO -->

            <div class="menu-option">
                <span>Classification the goods</span>    <!-- MENU TITLE -->
                <!-- contents ... -->
                <div class="menu-list">
                    <div class="menu-catagories">
                        @foreach($catagories as $catagory)
                            <span onclick="loadCatagoryContent('{{ $catagory->Product_catagory }}')">{{ $catagory->Product_catagory }}</span>
                        @endforeach
                    </div>
                    <div class="catagory-content1">
                        <img src="{{ asset('assets/images/giphy.gif') }}" alt="">
                        <div class="content">
                        </div>
                    </div>
                </div>
            </div>

            &nbsp||&nbsp
            <div class="menu-option">
                <span>Somthing</span>    <!-- MENU TITLE -->
                <!-- contents ... -->
            </div>

            &nbsp||&nbsp
            <div class="menu-option">
                <span>Somthing</span>    <!-- MENU TITLE -->
                <!-- contents ... -->
            </div>

            &nbsp||&nbsp
            <div class="menu-option">
                <span>Somthing</span>    <!-- MENU TITLE -->
                <!-- contents ... -->
            </div>

            &nbsp||&nbsp
            <div class="menu-option">
                <span>Somthing</span>    <!-- MENU TITLE -->
                <!-- contents ... -->
            </div>

            &nbsp||&nbsp
            <div class="menu-option">
                <span>Somthing</span>    <!-- MENU TITLE -->
                <!-- contents ... -->
            </div>

        </div>
    </div>

   
    <div class="search-page">
        <img src="{{ asset('assets/images/giphy.gif') }}" alt="">
        <div class="content-container">
        </div>
    </div>

    
        @yield('content');


    @yield('script-tag')
    <script src="{{ asset('assets/js/main_layout.js') }}"></script>
</body>
</html>