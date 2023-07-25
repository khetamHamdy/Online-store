@extends('layout.siteLayout')

@section('content')
    <section class="section_home">
        <div class="owl-carousel" id="slide-home">
            @foreach($silders as $one)
                <div class="item" style="background: url({{asset($one->image)}})"></div>
            @endforeach
        </div>
    </section>
    <!--section_home-->

    <section class="section-Privacy">
        <div class="container" >
            <h2 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.550s"
                style="color: {{$setting->color_webSite}}">{{$item->title}}</h2>
            <div style="display:flex;align-items: center ; margin: 25px">
            <a href="#"><img class=" wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.550s" width="400px" height="400px"
                             src="{{$item->image}}"></a>
            <div class="title-trams wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.550s">
                <p>
                    {!! $item->description !!}
                </p>

            </div>
            </div>
        </div>
    </section>

@endsection
