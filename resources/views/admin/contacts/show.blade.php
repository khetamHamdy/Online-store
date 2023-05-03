@extends('layout.adminLayout')
@section('title') {{ucwords(__('cp.contacts'))}}
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
                        <h3>{{__('cp.show_contact')}}</h3>
                    </div>
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <a href="{{url(getLocal().'/admin/contacts')}}" class="btn btn-secondary  mr-2">{{__('cp.cancel')}}</a>
                    <button id="submitButton" class="btn btn-success ">{{__('cp.edit')}}</button>

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
                <div class="card card-custom gutter-b example example-compact">
                    <form  enctype="multipart/form-data" class="form-horizontal" action="{{url(app()->getLocale().'/admin/contacts/'.$item->id)}}" method="post" role="form" id="form">
                        {{ csrf_field() }}
                        {{ method_field('PATCH')}}
                        <div class="card-header">
                            <h3 class="card-title">{{__('cp.main_info')}}</h3>
                        </div>
                        <div class="row col-sm-12">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">{{__('cp.read_status')}}</label>
                                            <select id="multiple2" class="form-control form-control-solid"
                                                    name="is_read">
                                                <option value="1" {{$item->is_read == '1'?'selected':''}}>
                                                    {{__('cp.seen')}}
                                                </option>
                                                <option value="0" {{$item->is_read == '0'?'selected':''}}>
                                                    {{__('cp.pending')}}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{__('cp.name')}}</label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="name" value="{{old('name',@$item->name)}}" disabled />
                                            </div>
                                        </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('cp.email')}}</label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="name" value="{{old('email',@$item->email)}}" disabled />
                                        </div>
                                    </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('cp.mobile')}}</label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="mobile" value="{{old('mobile',@$item->mobile)}}" disabled />
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('cp.message')}}</label>
                                            <textarea type="text" class="form-control"
                                                      name="message" disabled >{{$item->message}}</textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <button type="submit" id="submitForm" style="display:none"></button>
                    </form>
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
