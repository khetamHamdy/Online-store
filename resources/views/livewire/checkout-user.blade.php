<div>
    <section class="checkout_page stage_padding">
        <div class="container">
            <div class="sec_head wow fadeInUp">
                <h2>Checkout</h2>
            </div>


            <div class="row">
                <div class="col-lg-8">
                    <div class="cont-checkout wow fadeInUp">
                        <div class="head-page">
                            <h5>MY Address</h5>
                            <a class="btn-site btnSt" data-bs-toggle="modal" data-bs-target="#modalAdderss"><span>Add Address</span></a>
                        </div>
                        <div class="list-address">
                            <div class="row">
                                @if(isset($user->userAddress))
                                    @foreach($user->userAddress as $one)
                                        <div class="col-lg-6">
                                            <div class="item--adress checked-address wow fadeInUp">
                                                <div class="radio-item">
                                                    <input type="radio" id="{{$one->add_name}}"
                                                           wire:model.prevent="address_id" value="{{$one->id}}"
                                                    >
                                                    <label for="{{$one->add_name}}">
                                                        <h6>{{$one->add_name}}</h6>
                                                        <p>{{@$one->country->name}}</p>
                                                        <p>{{@$one->city->name}}</p>
                                                        <p>{{$one->street_descriptions}}</p>
                                                        <p>{{$one->notes}}</p>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                @if($errors->has('address_id'))
                                    <span class="text-danger">{{ $errors->first('address_id') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('livewire.componnests.promo')
                    <div class="payment-method wow fadeInUp">
                        <h5>Payment Method</h5>
                        <ul class="form-check">
                            <li>
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                       value="2"
                                       wire:model.lazy="payment_method"
                                       id="flexRadioDefault1" checked="">
                                <label class="form-check-label" for="flexRadioDefault1">CASH ON DELIVERY</label>
                            </li>
                            <li>
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                       value="1"
                                       wire:model.lazy="payment_method"
                                       id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">Online Payment</label>
                            </li>
                        </ul>
                        @if($errors->has('payment_method'))
                            <span class="text-danger">{{ $errors->first('payment_method') }}</span>
                        @endif
                    </div>
                    <div class="tot-cart wow fadeInUp">
                        <div class="d-flex justify-content-between d-total">
                            <p>Sub Total</p>
                            <p>{{' KWD ' .$price}}</p>
                        </div>

                        <div class="d-flex justify-content-between d-total">
                            <p>Delivery Charges</p>
                            <p>{{' KWD ' .$DeliveryCharges}}</p>
                        </div>
                        <div class="d-flex justify-content-between d-total total-crt">
                            <p>Discount Price:</p>
                            <p>

                                @if(@$order->discount_price != null)
                                    {{' KWD ' .@$order->discount_price }}
                                @else
                                    KWD  0
                                @endif
                            </p>
                        </div>
                        <div class="d-flex justify-content-between d-total total-crt">
                            <strong>Total:</strong>
                            <strong>
                                @if(@$order->discount_price != null)
                                    {{' KWD ' .@$order->discount_price+$DeliveryCharges }}
                                @else
                                    {{' KWD ' .$total}}
                                @endif
                            </strong>
                        </div>

                        <div class="proceed-checkout">
                            <button type="submit" class="btn-site" wire:click="store_order"><span>Place Order</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!--section_checkout_page-->
    <div class="modal fade" id="modalAdderss" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="closeModal" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <div class="modal-body ms-succ">
                    <h5>Add Address </h5>
                    <form class="form-st form-address" method="post" action="{{route('create_my_address')}}">
                        @csrf
                        <div class="form-group">
                            <label>Address Name* </label>
                            <input type="text" class="form-control" placeholder="Enter Here" name="address_name">
                        </div>
                        <div class="form-group selectBt">
                            <label>Country*</label>
                            <select class="form-control" name="country_id">
                                @foreach($countries as $one)
                                    <option value="{{$one->id}}">{{$one->name}}</option>
                                @endforeach
                                @if ($errors->has('country_id'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('country_id') }}</strong>
                                    </span>
                                @endif
                            </select>

                        </div>
                        <div class="form-group">
                            <label>City*</label>
                            <select class="form-control" name="city_id">
                                @foreach($citys as $one)
                                    <option value="{{$one->id}}">{{$one->name}}</option>

                                    @if ($errors->has('city_id'))
                                        <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('city_id') }}</strong>
                                    </span>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Block,Street, Building*</label>
                            <input type="text" class="form-control" placeholder="Enter Here"
                                   name="street_descriptions">
                            @if ($errors->has('street_descriptions'))
                                <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('street_descriptions') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Notes(Optional)</label>
                            <textarea class="form-control" placeholder="Enter Here" name="notes"></textarea>
                            @if ($errors->has('notes'))
                                <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('notes') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button class="btn-site"><span>Add Address7</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
