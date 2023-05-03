@extends('layout.adminLayout')
@section('title')  {{ucwords(__('cp.system_maintenance'))}}
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
                        <h3>{{__('cp.system_maintenance')}}</h3>
                    </div>
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    {{--                    <a href="{{url(getLocal().'/admin/companies')}}" class="btn btn-secondary  mr-2">{{__('cp.cancel')}}</a>--}}
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
                    <form method="post" action="{{url(app()->getLocale().'/admin/system_maintenance')}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form" id="form">
                        {{ csrf_field() }}

                        <div class="card-header">
                            <h3 class="card-title">{{__('cp.main_info')}}</h3>
                            <br>
                        </div>

                        <div class="row col-sm-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">{{__('cp.is_maintenance_mode')}}</label>
                                    <div >
                                    <span class="switch">
                                        <label>
                                            <input type="checkbox"
                                                   {{$item->is_maintenance_mode == 1 ? "checked" : ""}}  name="is_maintenance_mode"/>
                                            <span></span>
                                        </label>
                                    </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">{{__('cp.is_allow_register')}}</label>
                                    <div >
                                    <span class="switch">
                                        <label>
                                            <input type="checkbox"
                                                   {{$item->is_allow_register == 1 ? "checked" : ""}}  name="is_allow_register"/>
                                            <span></span>
                                        </label>
                                    </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">{{__('cp.is_allow_login')}}</label>
                                    <div >
                                    <span class="switch">
                                        <label>
                                            <input type="checkbox"
                                                   {{$item->is_allow_login == 1 ? "checked" : ""}}  name="is_allow_login"/>
                                            <span></span>
                                        </label>
                                    </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">{{__('cp.is_allow_buy')}}</label>
                                    <div >
                                    <span class="switch">
                                        <label>
                                            <input type="checkbox"
                                                   {{$item->is_allow_buy == 1 ? "checked" : ""}}  name="is_allow_buy"/>
                                            <span></span>
                                        </label>
                                    </span>
                                    </div>
                                </div>
                            </div>


                        </div>


                        <button type="submit" id="submitForm" style="display:none"></button>
                    </form>
                </div>
                <!--end::Card-->
            </div>
        </div>
        @endsection
        @section('script')
        @endsection
        @section('js')
            <script>
                $(document).on('click', '#submitButton', function () {
                    $('#submitForm').click();
                });
            </script>
@endsection
