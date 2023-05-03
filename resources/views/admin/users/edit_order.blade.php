@extends('admin.users.sideMenu')
@section('companyContent')
    <div class="flex-row-fluid ml-lg-8">
        <div class="card card-custom gutter-b example example-compact">

            <div class="card-header">
                <h3 class="card-title">{{__('cp.edit_order')}}</h3>
            </div>

            <form method="post" action="{{url(app()->getLocale().'/admin/orders/'.$order->id)}}"
                  enctype="multipart/form-data" class="form-horizontal" role="form" id="form">
                {{ csrf_field() }}
                {{ method_field('PATCH')}}


                <div class="row col-sm-12">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{__('cp.status')}}</label>
                                    <select class="form-control form-control-solid"
                                            name="status" @if($order->status == '4' || $order->status == '5') disabled @endif required>
                                        <option
                                            value="1" {{$order->status == '1'?'selected':''}}>
                                            {{__('cp.confirmed')}}
                                        </option>
                                        <option
                                            value="2" {{$order->status == '2'?'selected':''}}>
                                            {{__('cp.under_preparing')}}
                                        </option>
                                        <option
                                            value="3" {{$order->status == '3'?'selected':''}}>
                                            {{__('cp.ready_for_pickup')}}
                                        </option>
                                        <option
                                            value="4" {{$order->status == '4'?'selected':''}}>
                                            {{__('cp.completed')}}
                                        </option>
                                        <option
                                            value="5" {{$order->status == '5'?'selected':''}}>
                                            {{__('cp.canceled')}}
                                        </option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('cp.payment_method')}}</label>
                                    <input type="text" class="form-control form-control-solid"
                                           name="payment_method"
                                           value="{{@$order->payment_method=='1'?__('cp.online'):__('cp.cache_on_pickup')}}" disabled/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('cp.payment_ref')}}</label>
                                    <input type="text" class="form-control form-control-solid"
                                           name="payment_ref"
                                           value="{{@$order->payment_ref}}" disabled/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('cp.customer_name')}}</label>
                                    <input type="text" class="form-control form-control-solid"
                                           name="customer_name"
                                           value="{{old('customer_name',@$order->customer_name)}}" disabled/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('cp.customer_email')}}</label>
                                    <input type="text" class="form-control form-control-solid"
                                           name="customer_email"
                                           value="{{old('customer_email',@$order->customer_email)}}" disabled/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('cp.customer_mobile')}}</label>
                                    <input type="text" class="form-control form-control-solid"
                                           value="{{@$order->customer_mobile}}  {{@$order->customer_second_mobile?'-':''}} {{@$order->customer_second_mobile}}" disabled/>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('cp.order_date')}}</label>
                                    <input type="text" class="form-control form-control-solid"
                                           value="{{@$order->order_date}}"
                                           disabled/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('cp.provider')}}</label>
                                    <input type="text" class="form-control form-control-solid"
                                           value="{{@$order->provider->name}}"
                                           disabled/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('cp.payment_status')}}</label>
                                    <input type="text" class="form-control form-control-solid"
                                           name="payment_status"
                                           value="{{@$order->payment_status==1 ?__('cp.payed') : __('cp.not_payed')}}" disabled/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-header col-md-12">
                        <h3 class="card-title">{{__('cp.price')}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('cp.total')}}</label>
                                    <input type="text" class="form-control form-control-solid"
                                           value="{{@$order->sub_total}}" disabled/>
                                </div>
                            </div>
                            @if($order->discount > 0)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('cp.total_after_discount')}}</label>
                                        <input type="text" class="form-control form-control-solid"
                                               value="{{@$order->total}}" disabled/>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>


                    @if($order->discount > 0)
                        <div class="card-header col-md-12">
                            <h3 class="card-title">{{__('cp.discount')}}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{__('cp.promo_code_name')}}</label>
                                        <input type="text" class="form-control form-control-solid"
                                               value="{{@$order->promo_code_name}}" disabled/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{__('cp.promo_code_amount')}}</label>
                                        <input type="text" class="form-control form-control-solid"
                                               value="{{@$order->promo_code_amount}}  {{$order->promo_code_type==0 ? '%' : ''}}" disabled/>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{__('cp.total_discount')}}</label>
                                        <input type="text" class="form-control form-control-solid"
                                               value="{{@$order->discount}}" disabled/>
                                    </div>
                                </div>
                            </div>


                        </div>
                    @endif


                    @foreach($order->meals as $one)
                        <div class="card-header col-md-12">
                            <h3 class="card-title">{{@$one->meal->title}}</h3>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('cp.quantity')}}</label>
                                        <input type="text" class="form-control form-control-solid"
                                               value="{{@$one->quantity}}" disabled/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('cp.price')}}</label>
                                        <input type="text" class="form-control form-control-solid"
                                               value="{{@$one->price}}" disabled/>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                @if(count($one->extras) > 0)
                                    <div class="table-responsive col-md-6">
                                        <div class="form-group">
                                            <label>@lang('cp.extras')</label>
                                        </div>
                                        <table class="table table-hover tableWithSearch" id="tableWithSearch">
                                            <thead>
                                            <tr>
                                                <th class="wd-1p no-sort">
                                                    <div class="checkbox-inline">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="checkAll"/>
                                                            <span></span></label>
                                                    </div>
                                                </th>
                                                <th class="wd-25p"> {{ucwords(__('cp.name'))}}</th>
                                                <th class="wd-25p"> {{ucwords(__('cp.price'))}}</th>
                                                <th class="wd-25p"> {{ucwords(__('cp.quantity'))}}</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($one->extras as $extra)
                                                <tr class="odd gradeX" id="tr-{{$extra->id}}">
                                                    <td class="v-align-middle wd-5p">
                                                        <div class="checkbox-inline">
                                                            <label class="checkbox">
                                                                <input type="checkbox" value="{{$one->id}}" class="checkboxes"
                                                                       name="chkBox"/>
                                                                <span></span></label>
                                                        </div>
                                                    </td>
                                                    <td class="v-align-middle wd-25p">{{@$extra->extra->name}}</td>
                                                    <td class="v-align-middle wd-25p">{{@$extra->price}}</td>
                                                    <td class="v-align-middle wd-25p">{{@$extra->quantity}}</td>
                                                </tr>

                                            @empty

                                            @endforelse

                                            <!-- Modal Backdrop for all -->

                                            <!--Modal Create Folder -->

                                            </tbody>
                                        </table>
                                        {{--                                                                                {{$order->appends($_GET)->links("pagination::bootstrap-4") }}--}}
                                    </div>
                                @endif

                                @if(count($one->options) > 0)
                                    <div class="table-responsive col-md-6">
                                        <div class="form-group">
                                            <label>@lang('cp.options')</label>
                                        </div>
                                        <table class="table table-hover tableWithSearch" id="tableWithSearch">
                                            <thead>
                                            <tr>
                                                <th class="wd-1p no-sort">
                                                    <div class="checkbox-inline">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="checkAll"/>
                                                            <span></span></label>
                                                    </div>
                                                </th>
                                                <th class="wd-25p"> {{ucwords(__('cp.name'))}}</th>
                                                <th class="wd-25p"> {{ucwords(__('cp.price'))}}</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($one->options as $option)
                                                <tr class="odd gradeX" id="tr-{{$option->id}}">
                                                    <td class="v-align-middle wd-5p">
                                                        <div class="checkbox-inline">
                                                            <label class="checkbox">
                                                                <input type="checkbox" value="{{$one->id}}" class="checkboxes"
                                                                       name="chkBox"/>
                                                                <span></span></label>
                                                        </div>
                                                    </td>
                                                    <td class="v-align-middle wd-25p">{{@$option->option->name}}</td>
                                                    <td class="v-align-middle wd-25p">{{@$option->option->price}}</td>
                                                </tr>

                                            @empty

                                            @endforelse
                                            </tbody>
                                        </table>
                                        {{--                                                                                {{$order->appends($_GET)->links("pagination::bootstrap-4") }}--}}
                                    </div>
                                @endif
                            </div>

                        </div>


                    @endforeach


                </div>


                <!--begin::Toolbar-->
                <div class="d-flex align-items-center" style="margin-top: 40px">
                    <a href="{{url(getLocal().'/admin/users/'.$item->id.'/orders')}}" class="btn btn-secondary  mr-2">{{__('cp.cancel')}}</a>
                    <button id="submitButton" class="btn btn-success ">{{__('cp.save')}}</button>
                </div>
                <!--end::Toolbar-->
                <button type="submit" id="submitForm" style="display:none"></button>
            </form>

        </div>
    </div>
@endsection
@section('js')

    <script>

        $(document).on('click', '#submitButton', function () {
            $('#submitForm').click();
        });
    </script>
@endsection
