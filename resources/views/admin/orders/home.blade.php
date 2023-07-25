@extends('layout.adminLayout')
@section('title')
    {{ucwords(__('cp.orders'))}}
@endsection
@section('css')

@endsection
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <div class="d-flex align-items-baseline mr-5">
                        <h3>{{ucwords(__('cp.orders'))}}</h3>
                    </div>
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
                <div>
                    <div class="btn-group mb-2 m-md-3 mt-md-0 ml-2 ">
                           <a  class="btn btn-secondary" href="{{url(getLocal().'/admin/order-export')}}">
                            <i class="icon-xl la la-file-excel"></i>
                            <span>{{__('cp.excel')}}</span>
                        </a>

                        <button type="button" class="btn btn-secondary" href="#deleteAll" role="button"
                                data-toggle="modal">
                            <i class="flaticon-delete"></i>
                            <span>{{__('cp.delete')}}</span>
                        </button>

                    </div>

                </div>
                <!--end::Toolbar-->
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="gutter-b example example-compact">

                    <div class="contentTabel">

                        <div class="card-header d-flex flex-column flex-sm-row align-items-sm-start justify-content-sm-between">
                            <div>

                            </div>
                        </div>

                        <div class="table-responsive">
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
                                   <th class="wd-25p"> {{ucwords(__('ID'))}}</th>
                        <th class="wd-25p"> {{ucwords(__('cp.customer_name'))}}</th>
                        <th class="wd-25p"> {{ucwords(__('cp.customer_email'))}}</th>
                        <th class="wd-25p"> {{ucwords(__('cp.customer_mobile'))}}</th>
                       <th class="wd-25p"> {{ucwords(__('Num Of Products'))}}</th>
                        <th class="wd-25p"> {{ucwords(__('cp.total_price'))}}</th>
                        <th class="wd-25p"> {{ucwords(__('cp.payment_method'))}}</th>
                        <th class="wd-10p"> {{ucwords(__('cp.status'))}}</th>
                        <th class="wd-10p"> {{ucwords(__('cp.created'))}}</th>
                        <th class="wd-15p"> {{ucwords(__('cp.action'))}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($items as $one)
                                        <tr class="odd gradeX" id="tr-{{$one->id}}">
                                            <td class="v-align-middle wd-5p">
                                            <div class="checkbox-inline">
                                                <label class="checkbox">
                                                    <input type="checkbox" value="{{$one->id}}" class="checkboxes"
                                                           name="chkBox"/>
                                                    <span></span></label>
                                            </div>
                                        </td>

                            <td class="v-align-middle wd-25p">{{$one->id}}</td>
                            <td class="v-align-middle wd-25p">{{$one->customer_name}}</td>
                            <td class="v-align-middle wd-25p">{{$one->customer_email}}</td>
                            <td class="v-align-middle wd-25p">{{$one->customer_mobile}}</td>
                            <td class="v-align-middle wd-25p">{{@$one->products->count()}}</td>
                            <td class="v-align-middle wd-25p">{{$one->total}}</td>
                            <td data-field="Status" aria-label="6" class="datatable-cell"><span
                                    style="width: 108px;"><span
                                        class="label font-weight-bold label-lg  label-light-{{$one->payment_method==1?'success':'warning'}} label-inline">
                                        {{$one->payment_method==1?__('cp.online'):__('cp.cache_on_pickup')}}</span></span>
                            </td>


                            <td class="v-align-middle wd-10p"> <span id="label-{{$one->id}}"
                                                                     class="badge badge-pill badge-{{$one->status_badge}}">
                                                {{$one->status_text}}</span>
                            </td>

                            <td class="v-align-middle wd-10p">{{$one->created_at->format('Y-m-d')}}</td>

                            <td class="v-align-middle wd-15p optionAddHours">

                        <a href="{{url(getLocal().'/admin/orders/'.$one->id.'/edit')}}"
                                   class="btn btn-sm btn-bg-clean btn-icon" title="{{__('cp.show')}}">
                                    <i class="la la-eye"></i>
                                </a>
                                @if($one->status !=4 && $one->status!=5)
                                    <a href="#myModal{{$one->id}}" role="button" title="{{__('cp.change_status')}}"
                                       data-toggle="modal" class="btn btn-sm btn-clean btn-icon"><i
                                            class="las la-exchange-alt"></i></a>
                                @endif
                                {{--                                @if($one->status == '5' && $one->payment_status !='2')--}}
                                {{--                                    <a href="{{url(getLocal().'/admin/refund/orders/'.$one->id)}}"--}}
                                {{--                                       class="btn btn-sm btn-bg-clean btn-icon" title="{{__('cp.refund')}}">--}}
                                {{--                                        <i class="la la-reply"></i>--}}
                                {{--                                    </a>--}}
                                {{--                                @endif--}}

                                {{--                                <a target="_blank" href="{{url(getLocal().'/admin/bill/'.$one->id)}}"--}}
                                {{--                                   class="btn btn-sm btn-bg-clean btn-icon" title="{{__('cp.bill')}}">--}}
                                {{--                                    <i class="la la-print"></i>--}}
                                {{--                                </a>--}}

                            </td>
                        </tr>
                        <div id="myModal{{$one->id}}" class="modal fade" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true"></button>
                                        <h4 class="modal-title">{{__('cp.change_status')}}</h4>
                                    </div>
                                    <form method="post" action="{{route('admin.changeOrderStatus',[$one->id])}}">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="radio-list">
                                                <label class="radio">
                                                    <input type="radio"
                                                           {{$one->status == '1' ? 'checked="checked"' : ''}} name="status"
                                                           value='1'>
                                                    <span></span>@lang('cp.confirmed')</label>

                                                <label class="radio">
                                                    <input type="radio"
                                                           {{$one->status == '2' ? 'checked="checked"' : ''}} name="status"
                                                           value='2'>
                                                    <span></span>@lang('cp.under_preparing')</label>


                                                <label class="radio">
                                                    <input type="radio"
                                                           {{$one->status == '3' ? 'checked="checked"' : ''}} name="status"
                                                           value='3'>
                                                    <span></span>@lang('cp.ready_for_pickup')</label>


                                                <label class="radio">
                                                    <input type="radio"
                                                           {{$one->status == '4' ? 'checked="checked"' : ''}} name="status"
                                                           value='4'>
                                                    <span></span>@lang('cp.completed')</label>


                                                <label class="radio">
                                                    <input type="radio"
                                                           {{$one->status == '5' ? 'checked="checked"' : ''}} name="status"
                                                           value='5'>
                                                    <span></span>@lang('cp.canceled')</label>

                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn default" data-dismiss="modal"
                                                    aria-hidden="true">{{__('cp.cancel')}}</button>
                                            <button class="btn btn-primary submitStatusForm">{{__('cp.Yes')}}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                                @empty

                                @endforelse
                                </tbody>
                            </table>
                            {{$items->appends($_GET)->links("pagination::bootstrap-4") }}
                        </div>
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>

@endsection
@section('js')

@endsection

@section('script')

@endsection
