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
    @if (session()->has('message'))
        <div class="alert alert-success" style="background: green; margin:auto;
    padding:20px ; color:white; width:300px ; text-align:center">
            {{ session('message') }}
        </div>
    @endif
    <section class="section_categories">
        <div class="container">

            <div class="owl-carousel" id="categoris-slider">
                @foreach($categories as $one)
                    <div class="item">
                        <div class="item_categoris">
                            <a onclick="test({{$one->id}})">
                                <figure><img src="{{$one->image}}" alt=""></figure>
                                <p>{{$one->name}}</p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
    <!--section_categories-->

    <section class="section_products">
        <div class="container">

            <div class="sec_head wow fadeInUp">
                <h2>{{__('cp.LatestProducts')}}</h2>
                </p>
            </div>
            <div class="row item-cat-prods">
                @if (is_array($LatestProducts) || is_object($LatestProducts))
                    @foreach($LatestProducts as $one)
                        <div class="col-lg-4 col-6 item-cat-prod">
                            <div class="item-prod wow fadeInUp">
                                <figure><img src="{{$one->image}}" alt="Image Product"></figure>
                                <div class="txt-prod">
                                    <h5>{{$one->title}}</h5>
                                    <p>{{@$one->brand->name}}</p>
                                    @if($one->is_offer == '1')
                                        <ul>
                                            <li><strong>{{$one->is_discount}}</strong></li>
                                            <li>
                                                <del>{{$one->id_to_price}}</del>
                                            </li>
                                        </ul>
                                    @else
                                        <ul>
                                            <li><strong>{{$one->id_to_price}}</strong></li>
                                        </ul>
                                    @endif

                                    <a href="{{route('product_details', ['id' => $one->id])}}"
                                       class="btn-site">
                                        <span>{{__('cp.AddToCart')}} </span>
                                    </a>

                                </div>

                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <br>
            <br>
            <hr>
            <br>
            <br>
            <div class="sec_head wow fadeInUp">
                <h2>{{__('cp.best_product')}}</h2>
                </p>
            </div>
            <div class="row item-cat-prods">
                @if (is_array($best_products) || is_object($best_products))
                    @foreach($best_products as $one)
                        <div class="col-lg-4 col-6 item-cat-prod">
                            <div class="item-prod wow fadeInUp">
                                <figure><img src="{{$one->image}}" alt="Image Product"></figure>
                                <div class="txt-prod">
                                    <h5>{{$one->title}}</h5>
                                    <p>{{@$one->brand->name}}</p>
                                    @if($one->is_offer == '1')
                                        <ul>
                                            <li><strong>{{$one->is_discount}}</strong></li>
                                            <li>
                                                <del>{{$one->id_to_price}}</del>
                                            </li>
                                        </ul>
                                    @else
                                        <ul>
                                            <li><strong>{{$one->id_to_price}}</strong></li>
                                        </ul>
                                    @endif

                                    <a href="{{route('product_details', ['id' => $one->id])}}"
                                       class="btn-site">
                                        <span>{{__('cp.AddToCart')}} </span>
                                    </a>

                                </div>

                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="view-all">
                {{--                <i class="fa-solid fa-spinner"></i>--}}
                <center>
                    <a href="{{route('products-all')}}"
                       class="btn-site text-white align-center text-center align-content-center">{{__('cp.viewAll')}}</a>
                </center>

                <img src="{{asset('website/images/sad.gif')}}" style=" width: 100px ; height: 100px">

            </div>
        </div>
    </section>
    <!--section_products-->

@endsection

@section('js')

    <script>
        function test($id) {
            if ($id) {
                $.ajax({
                    url: '/get-category-products/' + $id,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $(`.item-cat-prods`).empty();
                        $.each(data, function (index, data) {
                            $.each(data,
                                function (index_one, one) {

                                    $('.item-cat-prods').append(`
                              <div class="col-lg-4 col-6 ">
                              <div class="item-prod wow fadeInUp">
                              <figure><img src="${one.image}" alt="Image Product"></figure>
                                <div class="txt-prod">
                                    <h5>${one.title}</h5>

                                    ${one.is_offer == '1' ?
                                            `  <ul>
                                            <li><strong>${one.is_discount}</strong></li>
                                            <li>
                                                <del>${one.id_to_price}</del>
                                            </li>
                                        </ul> ` :
                                            ` <ul>
                                        <li><strong>${one.id_to_price}</strong></li>
                                        </ul>`
                                        }
                                    <a href="product-details/${one.id}"
                                           class="btn-site">
                                            <span>{{__('cp.AddToCart')}} </span>
                                        </a>
                                </div>
                                </div>
                                </div> `
                                    )
                                    ;
                                });
                        });
                    }
                });
            }
        }
    </script>
@endsection
