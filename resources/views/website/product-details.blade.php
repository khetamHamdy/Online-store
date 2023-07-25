@extends('layout.siteLayout')

@section('content')
    @php $id=explode("/", request()->url())[5];
    @endphp

    @livewire('product-details', [
    'id' => $id
    ])



{{--        <livewire:product-details :id="{{explode("/", request()->url())[5]}}">--}}
@endsection

@section('js')

    <script>
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: false,
            centerMode: true,
            focusOnSelect: true,
            responsive: [
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 3,
                        centerMode: true,
                    }
                }
            ],
            cssEase: 'cubic-bezier(0.645, 0.045, 0.355, 1.000)',
            useTransform: true,
            arrows: true,
            prevArrow: '<button class="slide-arrow prev-arrow"><i class="fa fa-angle-left"></i></button>',
            nextArrow: '<button class="slide-arrow next-arrow"><i class="fa fa-angle-right"></i></button>'
        });
    </script>

@endsection
