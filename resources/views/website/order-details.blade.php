@extends('layout.siteLayout')

@section('content')
<section class="order_page stage_padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="data-oder-details">
                    <div>
                        <p>Order Id</p>
                        <strong>#{{$item->id}}</strong>
                    </div>
                    <div>
                        <p>Order Date</p>
                        <strong>{{$item->order_date}}</strong>
                    </div>
                    <div>
                        <p>Status</p>
                        <strong>
                            @if($item->status == 1)
                            confirmed
                            @elseif($item->status == 2)
                            under_preparing
                            @elseif($item->status == 3)
                            ready_for_pickup
                            @elseif($item->status == 4)
                            completed
                            @elseif($item->status == 5)
                            canceled
                            @endif
                        </strong>
                    </div>
                    <div>
                        <p>Payment Method</p>
                        <strong>{{$item->payment_method==2 ? 'cache on pickup' :'online' }}</strong>
                    </div>
                </div>
                <div class="cont-summary wow fadeInUp ">
                    <h5>Order Summary</h5>
                    <div class="pro-det-order">
                        @foreach($item->items as $one)
                        <div class="pro-order wow fadeInUp">
                            <div class="d-flex">
                                <figure><img src="{{$one->product->image}}" alt="" /></figure>
                                <div>
                                    <p>{{$one->product->title}}….</p>
                                    <b>QTY : {{$one->quantity}}</b>
                                </div>
                            </div>
                            <p><span>Add-out</span> {{$one->product->description}}</p>
                            <strong><span>Price</span>{{@$one->id_to_price}}</strong>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cont-address wow fadeInUp ">
                    <h4>Delivery Address</h4>
                    <strong>{{@$item->address->add_name}}</strong>
                    <p>{{@$item->address->country->name}}</p>
                    <p>{{@$item->address->city->name}}</p>
                    <p>{{@$item->address->street_descriptions}}</p>
                    <p>{{@$item->address->delivery_mobile_number ?? '--'}}</p>
                </div>
                <div class="tot--cart wow fadeInUp">
                    <h5>Payment Details</h5>
                    <div class="d-flex justify-content-between d-total">
                        <p>Products Total</p>
                        <p>{{' KWD '.@$item->ProductsTotal}}</p>
                    </div>
                    <div class="d-flex justify-content-between d-total">
                        <p>Discount</p>
                        <p>{{' KWD '.@$item->discount_price}}</p>
                    </div>
                    <div class="d-flex justify-content-between d-total">
                        <p>Delivery Charges</p>
                        <p>{{' KWD '.@$item->DeliveryCharges}}</p>
                    </div>
                    <div class="d-flex justify-content-between d-total total-crt">
                        <strong>Total:</strong>
                        <strong>{{' KWD '.@$item->total}}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--order_page-->
@endsection