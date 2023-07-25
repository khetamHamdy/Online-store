<div>

    <section class="cart_page stage_padding">
        <div class="container">
            <div class="sec_head wow fadeInUp">
                <h2>Cart</h2>
            </div>
            <div class="content-cart wow fadeInUp">
                @if($carts->count() !=0)
                    <div class="table-responsive-lg">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Total</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($carts as $one)
                                <tr>
                                    <td>
                                        <div class="pdu-tb">
                                            <a href="{{route('product_details', ['id' =>$one->product->id])}}">
                                                <figure><img src="{{$one->product->image}}" alt=""/></figure>
                                            </a>
                                            <div class="txt-pdu">
                                                <h5></h5>
                                                <p>Color : {{$one->color->name}}</p>
                                                <p>Size : {{$one->size->size}}</p>
                                                <p>Additions : {{$one->addition->name}}</p>
                                            </div>

                                        </div>
                                    </td>
                                    <td><strong class="price-product">{{$one->id_to_price}}</strong></td>
                                    <td>
                                        <div class="quantity qty-cart">
                                            <div class="btn button-count inc jsQuantityIncrease"
                                                 onclick="updateQuantity({{ $one->id }}, 'increase')">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </div>

                                            <input type="text" name="count-quat1" class="count-quat"
                                                   id="quantity-{{ $one->id }}"
                                                   value="{{$one->quantity}}">

                                            <div class="btn button-count dec jsQuantityDecrease " minimum="1"
                                                 onclick="updateQuantity({{ $one->id }}, 'decrease')">
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="total-price">
                                            <p id="item-total-price-{{$one->id}}">
                                                {{$this->total($one->id)}}
                                            </p>
                                        </div>
                                    </td>
                                    <td>
                                        <a wire:click="delete({{$one->id}})" class="remove-tb"><i
                                                class="fa-solid fa-trash-can"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tot-cart">
                        <div class="d-flex justify-content-between d-total">
                            <strong>Sub Total :</strong>
                            <strong id="overall-total-price">{{$total}}</strong>
                        </div>
                        <div class="proceed-checkout">
                            <a href="{{Auth('web')->user() != null ? route('checkout-user') : route('checkout')}}"
                               class="btn-site"><span>Proceed To Checkout</span></a>
                        </div>
                    </div>
            </div> @else
                <div class="empty  wow fadeInUp">
                    <div class="item-empty">
                        <p>No items in cart (Add items)</p>
                        <span>We Have Found No Items Added In Your Cart To Checkout</span> <br>
                        <a class="btn-site" href="{{route('home')}}"><span>Add Items</span></a>
                        <br> <br> <br> <br>
                    </div>
                </div>

            @endif


        </div>
    </section>
    <!--cart_page-->

</div>

@section('js')
    <script>
        // JavaScript code
        function updateQuantity(CartId, action) {
            $.ajax({
                url: '/update-quantity',
                type: 'POST',
                data: {
                    CartId: CartId,
                    action: action,
                    _token: '{{ csrf_token() }}'
                },
                success: function (data) {
                    $('#quantity-' + CartId).val(data.quantity);
                    $(`#item-total-price-${CartId}`).empty();
                    $('#item-total-price-' + CartId).text(data.itemTotalPrice);
                    $(`#overall-total-price`).empty();
                    $('#overall-total-price').text(data.overallTotalPrice);
                }
            });
        }
    </script>
@endsection
