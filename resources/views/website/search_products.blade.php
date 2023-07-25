@extends('layout.siteLayout')
@section('content')

    <section class="section_products">
        <div class="container">

            <div class="sec_head wow fadeInUp">
                <br>
                <h2 >{{__('cp.RSP')}}/ <span class="text-success">{{$params}}</span></h2>
            </div>
            <div class="row item-cat-prods">
                @if (is_array($products) || is_object($products))
                    @foreach($products as $one)
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
                                    var isDefault = data.is_offer;
                                    var defaultset = "";
                                    if (isDefault === 1) {
                                        defaultset = 'checked';
                                    }
                                    $('.item-cat-prods').append(`
                              <div class="col-lg-4 col-6 ">
                              <div class="item-prod wow fadeInUp">
                              <figure><img src="${one.image}" alt="Image Product"></figure>
                                <div class="txt-prod">
                                    <h5>${one.title}</h5>` +
                                        `${one.is_offer === 1} ?
                                        <ul>
                                            <li><strong>` + one.is_discount + `</strong></li>
                                            <li>
                                                <del>` + one.id_to_price + `</del>
                                            </li>
                                        </ul>
                                        :
                                        <ul>
                                        <li><strong>` + one.id_to_price + `</strong></li>
                                       </ul>
                                        `
                                        + `<a href="product-details/${one.id}"
                                           class="btn-site">
                                            <span>Add to Cart </span>
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
