@extends('layouts.front')

@section('content')

<!-- section -->
<div class="section layout_padding">
    <div class="container">
        <div class="row">
            
           <div class="col-md-6">
                <div class="full main_heading_1">
                    <h2>{{$product->name}}</h2>
                    <p><strong>Price: {{$product->price}} Rs./kilo </strong> </p>
                    <p><strong>Quantity Available: {{$product->quantity}} kilos </strong> </p>
                </div>   
                <div class="full margin_top_30">
                    <a class="main_bt" href="#">Add To Cart</a>
                </div>
                <div class="full margin_top_30">
                    <a class="main_bt" href="#">Add To Wishlist</a>
                </div>
            </div>
            <div class="col-md-6 margin_top_30 padding_right_0">
                <div class="full">
                    <img src="/storage/images/{{$product->image}}" alt="#" />
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end section -->
@endsection