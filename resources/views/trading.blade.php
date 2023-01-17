@extends('layouts.main')
@section('content')
<div class="container-fluid trading">
    <div class="row">
        <div class="col col-12 col-md-4 trading-one border-bottom border-info ">
            <div class="d-flex justify-content-center align-items-center mt-5">
                <button class="fs-3 trading-button"><span></span>Equity</button>
            </div>
            <img src="{{asset('images/trading_2.jpeg')}}" alt="" class="img-fluid img-filter pt-5 mt-1">
            <p class="mt-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Beatae molestiae consequuntur
                perspiciatis
                ea nisi nostrum officiis aut dolorem deleniti commodi culpa, assumenda vitae reiciendis eius odio quam
                qui corrupti ex?</p>
        </div>
        <div class="col col-12 col-md-4 trading-two pt-5 border-bottom border-info">
            <div class="d-flex justify-content-center align-items-center ">
                <button class="fs-3 trading-button">Forex</button>
            </div>
            <img src="{{asset('images/trading_1.jpeg')}}" alt="" class="img-fluid img-filter pt-5 mt-1">
            <p class="pt-3">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Beatae molestiae consequuntur
                perspiciatis
                ea nisi nostrum officiis aut dolorem deleniti commodi culpa, assumenda vitae reiciendis eius odio quam
                qui corrupti ex?</p>
        </div>
        <div class="col col-12 col-md-4 trading-three pt-5 border-bottom border-info">
            <div class="d-flex justify-content-center align-items-center">
                <button class="fs-3 trading-button">Crypto</button>
            </div>
            <img src="{{asset('images/trading_3.jpeg')}}" alt="" class="img-fluid img-filter pt-5 mt-1">
            <p class="pt-3">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Beatae molestiae consequuntur
                perspiciatis
                ea nisi nostrum officiis aut dolorem deleniti commodi culpa, assumenda vitae reiciendis eius odio quam
                qui corrupti ex?</p>
        </div>
    </div>
</div>
@endsection
