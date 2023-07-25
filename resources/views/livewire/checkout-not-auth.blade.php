<div>
    <section class="checkout_page stage_padding">
        <div class="container">
            <div class="sec_head wow fadeInUp">
                <h2>Checkout</h2>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <form class="form-checkout form-st">
                        <div class="cont-checkout wow fadeInUp">
                            <h5>User Details</h5>
                            <div class="d-flex">
                                <div class="form-group">
                                    <label>Full Name*</label>
                                    <input type="text" class="form-control" wire:model.lazy="fullname" name="fullname"
                                           placeholder="Enter Here ">
                                    @if($errors->has('fullname'))
                                        <span class="text-danger">{{ $errors->first('fullname') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Email Address*</label>
                                    <input type="email" class="form-control" wire:model.lazy="email" name="email"
                                           placeholder="Enter Here ">
                                    @if($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="form-group">
                                    <label>Mobail Number*</label>
                                    <input type="number" class="form-control" placeholder="Enter Here " name="mobail"
                                           wire:model.lazy="mobail">
                                    @if($errors->has('mobail'))
                                        <span class="text-danger">{{ $errors->first('mobail') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="cont-checkout wow fadeInUp">
                            <h5>Shipping Address</h5>
                            <div class="d-flex">
                                <div class="form-group selectBt">.
                                    <label>Area* </label>
                                    <select class="form-control" wire:model.lazy="country_id">
                                        @foreach($countries as $one)
                                            <option value="{{$one->id}}" name="country_id"
                                            >{{$one->name }}</option>
                                        @endforeach

                                    </select>
                                    @if($errors->has('country_id'))
                                        <span class="text-danger">{{ $errors->first('country_id') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Block*</label>
                                    <input type="text" class="form-control" name="block" placeholder="Enter Block"
                                           wire:model.lazy="block">
                                    @if($errors->has('block'))
                                        <span class="text-danger">{{ $errors->first('block') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="form-group">
                                    <label>Street*</label>
                                    <input type="text" class="form-control" wire:model.lazy="street" name="street"
                                           placeholder="Enter St">
                                    @if($errors->has('street'))
                                        <span class="text-danger">{{ $errors->first('street') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="form-group">
                                    <label>House Number *</label>
                                    <input type="number" class="form-control" wire:model.lazy="house_num"
                                           name="house_num"
                                           placeholder="Please Enter">
                                    @if($errors->has('house_num'))
                                        <span class="text-danger">{{ $errors->first('house_num') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Delivery Mobile Number*</label>
                                    <input type="number" class="form-control" placeholder="Please Enter"
                                           name="delivery_mobile"
                                           wire:model.lazy="delivery_mobile">
                                    @if($errors->has('delivery_mobile'))
                                        <span class="text-danger">{{ $errors->first('delivery_mobile') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="form-group">
                                    <label>Extra Directions</label>
                                    <textarea class="form-control" wire:model.lazy="extra_directions"
                                              name="extra_directions"
                                              placeholder="Please Enter"></textarea>
                                    @if($errors->has('extra_directions'))
                                        <span class="text-danger">{{ $errors->first('extra_directions') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    @include('livewire.componnests.promo')
                    <div class="payment-method wow fadeInUp">
                        <h5>Payment Method</h5>
                        <ul class="form-check">
                            <li>
                                <input class="form-check-input" type="radio" name="payment_method"
                                       value="2"
                                       wire:model.lazy="payment_method"
                                       id="flexRadioDefault1" checked="">
                                <label class="form-check-label" for="flexRadioDefault1">CASH ON DELIVERY</label>
                            </li>
                            <li>
                                <input class="form-check-input" type="radio" name="payment_method"
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
                            <strong>{{' KWD ' .$total}}</strong>
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
    <!--section_categories-->
</div>
