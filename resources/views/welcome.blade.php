@extends('layouts.main')
@section('content')
<div class="banner_wrap">
    <div>
        <div class="place-image">
            <div class="img">
                <section class="point clearfix">
                    <article class="pointPan">
                        <img src="{{asset('images/2_bw.jpg')}}" class="img-fluid" alt="" srcset="">
                        <div class="pointPanCont" style="height: 239.672px; bottom: -239.672px; opacity: 1;">
                            <div class="ppcIn" style="opacity: 0;">
                                <h3></h3>
                                <p>Our Broking and Distribution business helps retail customers take informed investment
                                    decisions with a strong ..</p>

                                <a class="learnMore" href="/Our-Businesses/Broking-And-Distribution">Read more</a>
                            </div>
                        </div>
                        <div class="overlay" style="z-index: 1; opacity: 1;">
                            <div class="heading"> <span><img class="d-none" src="{{asset('images/broking.png')}}" alt=""
                                        width="28px" height="24px" style="top: 0px;"></span>
                                <h1><a href="{{route('trading')}}"
                                        class="text-decoration-none fs-1 button-89 text-warning">Trading</a></h1>
                            </div>
                        </div>
                    </article>
                    <article class="pointPan">
                        <img src="{{asset('images/1_bw.jpg')}}" class="img-fluid" alt="" srcset="">
                        <div class="overlay" style="z-index: 1; opacity: 1;">
                            <div class="heading"> <span><img class="d-none" src="{{asset('images/broking.png')}}" alt=""
                                        width="28px" height="24px" style="top: 0px;"></span>
                                <h1><a href="{{route('insurance')}}"
                                        class="text-decoration-none trading-button fs-1 text-warning">Insurance</a></h1>
                            </div>
                        </div>
                    </article>
                    <article class="pointPan">
                        <img src="{{asset('images/5_bw.jpg')}}" class="img-fluid" alt="" srcset="">
                        <div class="overlay" style="z-index: 1; opacity: 1;">
                            <div class="heading"> <span><img class="d-none" src="{{asset('images/broking.png')}}" alt=""
                                        width="28px" height="24px" style="top: 0px;"></span>
                                <h1><a href="{{route('investment')}}"
                                        class="text-decoration-none trading-button fs-1 text-warning">Funds &amp;
                                        Investments
                                    </a></h1>
                            </div>
                        </div>
                    </article>
                    <article class="pointPan">
                        <img src="{{asset('images/4_bw.jpg')}}" class="img-fluid" alt="" srcset="">
                        <div class="overlay" style="z-index: 1; opacity: 1;">
                            <div class="heading"> <span><img class="d-none" src="{{asset('images/broking.png')}}" alt=""
                                        width="28px" height="24px" style="top: 0px;"></span>
                                <h1><a href="{{route('training')}}"
                                        class="text-decoration-none trading-button fs-1 text-warning">Training</a></h1>
                            </div>
                        </div>
                    </article>
                </section>
            </div>
        </div>
    </div>


</div>
@endsection
