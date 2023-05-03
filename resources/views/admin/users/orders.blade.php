@extends('admin.users.sideMenu')
@section('companyContent')
    <div class="container">
        <div class="card card-custom gutter-b example example-compact" style="padding: 30px">
            <div class="table-responsive">
                <table class="table table-hover tableWithSearch" id="tableWithSearch">
                    <thead>
                    <tr>
                        <th class="wd-25p"> {{ucwords(__('cp.vendor'))}}</th>
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
                            <td class="v-align-middle wd-25p">{{@$one->provider->name}}</td>
                            <td class="v-align-middle wd-25p">{{$one->total}}</td>
                            <td data-field="Status" aria-label="6" class="datatable-cell"><span style="width: 108px;"><span class="label font-weight-bold label-lg  label-light-{{$one->payment_method==1?'success':'warning'}} label-inline">{{$one->payment_method==1?__('cp.online'):__('cp.cache_on_pickup')}}</span></span></td>


                            <td class="v-align-middle wd-10p"> <span id="label-{{$one->id}}"
                                                                     class="badge badge-pill badge-{{$one->status_badge}}">
                                                {{$one->status_text}}</span>
                            </td>

                            <td class="v-align-middle wd-10p">{{$one->created_at->format('Y-m-d')}}</td>

                            <td class="v-align-middle wd-15p optionAddHours">


                                <a href="{{url(getLocal().'/admin/users/'.$item->id.'/'.$one->id.'/editOrder')}}"
                                   class="btn btn-sm btn-bg-clean btn-icon" title="{{__('cp.show')}}">
                                    <i class="la la-eye"></i>

                                </a>
                                <a
                                    class="btn btn-sm btn-bg-clean btn-icon" title="{{__('cp.invoice')}}">
                                    <i class="flaticon-interface-10"></i>

                                </a>
                                @if($one->status !=4 && $one->status!=5)
                                    <a href="#myModal{{$one->id}}" role="button" title="{{__('cp.change_status')}}"
                                       data-toggle="modal" class="btn btn-sm btn-clean btn-icon"><i
                                            class="las la-exchange-alt"></i></a>
                                @endif
                                @if($one->status == '5' && $one->payment_status !='2')
                                    <a href="{{url(getLocal().'/admin/refund/orders/'.$one->id)}}" class="btn btn-sm btn-bg-clean btn-icon" title="{{__('cp.refund')}}">
                                        <i class="la la-reply"></i>
                                    </a>
                                @endif

                                {{--                                            <a target="_blank" href="{{url(getLocal().'/admin/bill/'.$one->id)}}"--}}
                                {{--                                                class="btn btn-sm btn-bg-clean btn-icon" title="{{__('cp.bill')}}">--}}
                                {{--                                                <i class="la la-print"></i>--}}
                                {{--                                            </a>--}}

                            </td>
                        </tr>
                        <div id="myModal{{$one->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                  <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">{{__('cp.change_status')}}</h4>
                                                </div>
                                                <form method="post" action="{{route('admin.changeOrderStatus',[$one->id])}}">
                                                    @csrf
                                                <div class="modal-body">
                                           <div class="radio-list">
																<label class="radio">
																<input type="radio" {{$one->status == '1' ? 'checked="checked"' : ''}} name="status" value='1'>
																<span></span>@lang('cp.confirmed')</label>
															
																<label class="radio">
																<input type="radio" {{$one->status == '2' ? 'checked="checked"' : ''}} name="status" value='2'>
																<span></span>@lang('cp.under_preparing')</label>
															
															
																<label class="radio">
																<input type="radio" {{$one->status == '3' ? 'checked="checked"' : ''}} name="status" value='3'>
																<span></span>@lang('cp.ready_for_pickup')</label>
															
															
																<label class="radio">
																<input type="radio" {{$one->status == '4' ? 'checked="checked"' : ''}} name="status" value='4'>
																<span></span>@lang('cp.completed')</label>
															
															
																<label class="radio">
																<input type="radio" {{$one->status == '5' ? 'checked="checked"' : ''}} name="status" value='5'>
																<span></span>@lang('cp.canceled')</label>
															
															
															</div>
													
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn default" data-dismiss="modal" aria-hidden="true">{{__('cp.cancel')}}</button>
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
@endsection

@section('sideScript')
     $(document).on('click', '.submitStatusForm', function (e) {
       
          var form = $('#statusForm');
            $.ajax({
                type: form.attr('method'),
                headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                url: form.attr('action'),
                data: form.serialize(),
                success: function (response) {
                    
                },
                error: function (jqXHR, error, errorThrown) {

                }
            });

       });
    
@endsection
