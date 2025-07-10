<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Product Page</title>
    <link rel="stylesheet" href="{{ asset('assets/css/product_page.css') }}">
</head>
<body>
    <div class="container">
        <!-- Left section with images -->
        <div class="left-section">
            <div class="image-wrapper">
                <img id="main-image" src="{{ asset($product[0]->Product_image) }}" alt="Main Product Image" class="main-image">
            </div>
            <div class="small-images">
                @foreach($similar_products as $similar_product)
                    <img src="{{ asset($similar_product->Product_image) }}" alt="Product Small 1" onclick="setTheUrl({{ $similar_product->Product_id }})">
                @endforeach
            </div>
        </div>

        <!-- Right section with product details -->
        <div class="right-section">
            <div class="product-name">{{ $product[0]->Product_title }}</div>
            <div class="divider"></div>
            <div class="color-section">
                <span>Colors Available:</span>
                @if($product_colors != 'No colors')
                    @foreach($product_colors as $product_color)
                        <span class="color-sample" style="background-color: {{ $product_color }};"></span>
                    @endforeach
                @else
                    No colors
                @endif
            </div>
            <div class="divider"></div>
            <div class="features">
                <h3>Features</h3>
                <p>{{ $product[0]->Product_details }}</p>
            </div>
            <div class="divider"></div>
            <div class="delivery">
                <h3>Delivery to Your Doorstep</h3>
                <ul>
                    <li>Fast delivery within 3-5 days.</li>
                    <li>Free shipping for orders above $50.</li>
                    <li>Track your shipment in real-time.</li>
                </ul>
            </div>
            <div class="divider"></div>
            <div class="seller-info">
                <h3>Seller</h3>
                <p>75% satisfaction with the product</p>
            </div>
            <div class="divider"></div>
            <div class="price-section">
                <div class="discount">{{ $product[0]->Product_discount }} %</div>
                <div class="price">$ {{ $product[0]->Product_price }}</div>
            </div>
            <button class="btn">Buy Now</button>
            <button onclick="sentIdToServer({{ $product[0]->Product_id }})" class="btn secondary add-btn"><img style="display:none;" src="{{ asset('assets/images/giphy.gif') }}" alt=""><span>Add to Cart</span></button>
            <div class="warranty">This product comes with a warranty</div>
        </div>
    </div>
    <script src="{{ asset('assets/js/product_page.js') }}"></script>
</body>
</html>


