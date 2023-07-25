<div>

    @if(\Illuminate\Support\Facades\Session::get('message_cart'))
        {{\Illuminate\Support\Facades\Session::get('message_cart')}}
    @endif
    <section class="product_details_page stage_padding">
        <div class="container">
            <div class="row">

                @if($item->productImages->count())
                    <div class="col-lg-6">
                        <div class="block-product-slide">
                            <div class="slider slider-for clearfix">
                                @foreach($item->productImages as $one)
                                    <div class="pro-slide-item">
                                        <div class="pro--Thumb slider-for__item ex1" data-src="{{asset($one->image)}}">
                                            <img src="{{asset($one->image)}}" alt=""/>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <div class="slider slider-nav clearfix">

                                @foreach($item->productImages as $one)
                                    <div class="sp-nav">
                                        <img src="{{asset($one->image)}}" alt="" class="img-responsive">
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-lg-6">
                        <div class="block-product-slide">
                            <div class="slider slider-for clearfix">

                                <div class="pro-slide-item">
                                    <div class="pro--Thumb slider-for__item ex1" data-src="{{asset($item->image)}}">
                                        <img src="{{asset($item->image)}}" alt=""/>
                                    </div>
                                </div>


                            </div>
                            <div class="slider slider-nav clearfix">

                                <div class="sp-nav">
                                    <img src="{{asset($item->image)}}" alt="" class="img-responsive">
                                </div>

                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-lg-6">
                    <div class="data-product">
                        <div class="name-product">
                            <h5>{{$item->title}}….</h5>
                            <p>{{@$item->brand->name }} </p>

                            <ul>
                                <strong style="color: #9b8181">{{__('cp.price')}}: </strong>
                                <li>
                                    <p>
                                        @if($item->is_offer == '1')
                                            KWD   {{@$item->is_discount }}
                                            <del>   {{$item->IdToPrice}}</del>
                                        @endif
                                    </p>

                                </li>
                                <li>
                                    <p>   {{$item->IdToPrice}}</p>
                                </li>
                            </ul>
                        </div>
                        <form wire:submit.prevent="AddToCart">
                            <div class="pdp--list">
                                @if($item->colors->count() != null)
                                    <div class="pdp-ro">
                                        <strong>{{__('cp.Color')}} </strong>
                                        <div class="color-choose">
                                            @foreach($item->colors as $one)
                                                <div>
                                                    <input data-image="color1" type="radio" id="{{$one->name}}"
                                                           wire:model.lazy="color_id"
                                                           name="color"
                                                           value="{{$one->id}}">
                                                    <label for="{{$one->name}}"><span
                                                            style="background:{{$one->code}}"></span></label>

                                                </div>
                                            @endforeach
                                            @if($errors->has('color_id'))
                                                <span class="text-danger">{{ $errors->first('color_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if($item->colors->count() != null)
                                    <div class="pdp-ro">
                                        <strong>{{__('cp.Size')}}</strong>
                                        <div class="size-pro">
                                            @foreach($item->sizes as $one)
                                                <div>
                                                    <input data-image="" type="radio" id="{{$one->size}}" name="size"
                                                           wire:model.lazy="size_id"
                                                           value="{{$one->id}}">

                                                    <label for="{{$one->size}}">
                                                        <span>{{$one->size}}</span>
                                                    </label>
                                                </div>
                                                @if($errors->has('size_id'))
                                                    <span class="text-danger">{{ $errors->first('size_id') }}</span>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                @if($item->required_addition=='on')
                                    <div class="pdp-ro">
                                        <strong>Addition</strong>

                                        <div>
                                            <br>
                                            <p> {{__('cp.max_addition')}} : <span
                                                    style="color: #b02a37">{{$item->max_addition}} </span></p>
                                            <p> {{__('cp.required_addition')}} :
                                                <span
                                                    style="color: #b02a37">{{$item->required_addition=='on' ? 'required':'not required' }} </span>
                                            </p>
                                        </div>


                                        <div class="size-pro">
                                            <div>
                                                <table class="table table-hover tableWithSearch" id="tableWithSearch">
                                                    <thead>
                                                    <tr>
                                                        <th class="wd-10p"> {{ucwords(__('cp.choose'))}}</th>
                                                        <th class="wd-25p"> {{ucwords(__('cp.name'))}}</th>
                                                        <th class="wd-25p"> {{ucwords(__('cp.price'))}}</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody id="t_data">

                                                    @foreach($item->extras as $one)

                                                        <tr class="odd gradeX" id="tr-{{$one->id}}">

                                                            <td class="v-align-middle wd-25p">
                                                                <input type="checkbox" name="addition_id"
                                                                       value="{{$one->id}}"
                                                                       wire:model.lazy="addition_id">
                                                                @if($errors->has('addition_id'))
                                                                    <span
                                                                        class="text-danger">{{ $errors->first('addition_id') }}</span>
                                                                @endif
                                                            </td>
                                                            <td class="v-align-middle wd-25p">{{$one->name}}</td>
                                                            <td class="v-align-middle wd-25p">{{$one->price}}</td>

                                                        </tr>

                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>

                                    </div>
                                @endif
                            </div>
                            <div class="opt-produ">
                                <div class="add-cart">
                                    <button class="btn-site"><span><i
                                                class="icon-cart "></i>{{__('cp.AddToCart')}}</span></button>
                                </div>

                                <div class="quantity">
                                    <div class="btn button-count dec" wire:click="decreas" minimum="1"><i
                                            class="fa fa-minus" aria-hidden="true"></i></div>

                                    <input type="text" class="count-quat" value="{{$quantity}}" nonce="quat"
                                           name="quantity"
                                           wire:model.lazy="quantity">
                                    <div class="btn button-count inc " wire:click="increas"><i class="fa fa-plus"
                                                                                               aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="product-description">
                            <h5>{{__('cp.proDes')}}</h5>
                            <p>
                                {{$item->description}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--product_details_page-->
</div>

<script>
    window.addEventListener('swal', function (e) {
        Swal.fire(e.detail);
    });

</script>
