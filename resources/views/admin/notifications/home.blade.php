@extends('layout.adminLayout')
@section('title') {{ucwords(__('cp.notifications'))}}
@endsection
@section('css')

    <style>
        a:link {
            text-decoration: none;
        }
    </style>

@endsection
@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <div class="d-flex align-items-baseline mr-5">
                        <h3>{{ucwords(__('cp.notifications'))}}</h3>
                    </div>
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->


                <div class="btn-group mb-2 m-md-3 mt-md-0 ml-2 ">

                                        <a href="{{url(getLocal().'/admin/notifications/create')}}" style="margin-right: 5px"
                                           class="btn btn-success"><i class="fa fa-plus"></i>{{__('cp.add')}}
                                        </a>

                    {{--                    <button type="button" class="btn btn-default has-icon" href="#activation" role="button"--}}
                    {{--                            data-toggle="modal">--}}
                    {{--                        <i class="fas fa-check"></i>--}}
                    {{--                        <span>{{__('cp.active')}}</span>--}}
                    {{--                    </button>--}}
                    {{--                    <button type="button" class="btn btn-default  has-icon " href="#cancel_activation" role="button"--}}
                    {{--                            data-toggle="modal">--}}
                    {{--                        <i class="fas fa-na"></i>--}}
                    {{--                        <span>{{__('cp.not_active')}}</span>--}}
                    {{--                    </button>--}}
                    {{--                    <button type="button" class="btn btn-default  has-icon " href="#deleteAll" role="button"--}}
                    {{--                            data-toggle="modal">--}}
                    {{--                        <i class="fas fa-trash"></i>--}}
                    {{--                        <span>{{__('cp.delete')}}</span>--}}
                    {{--                    </button>--}}
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
                        <div
                            class="card-header d-flex flex-column flex-sm-row align-items-sm-start justify-content-sm-between">
                            <div>


                            </div>

                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover tableWithSearch" id="tableWithSearch">
                                <thead>
                                <tr>
                                    <th> {{ucwords(__('cp.title'))}}</th>
                                    <th> {{ucwords(__('cp.message'))}}</th>
                                    <th> {{ucwords(__('cp.created'))}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($items as $item)
                                    <tr>
                                    <td>{{Str::limit($item->title, 30, ' ...') }}</td>
                                    <td>{{Str::limit($item->message,30, ' ...') }}</td>
                                    <td>{{$item->created_at}}</td>
                                    </tr>
                                @empty
                                @endforelse
                                </tbody>
                            </table>
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
