@extends('layout.adminLayout')
@section('title')
    {{ucwords(__('cp.settings'))}}
@endsection
@section('css')

    <style>
        a:link {
            text-decoration: none;

        }

        #map-canvas {
            width: 800px;
            height: 550px;

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
                        <h3>{{__('cp.edit')}}</h3>
                    </div>
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <button id="submitButton" class="btn btn-success ">{{__('cp.save')}}</button>
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
                    <form class="form" method="post" action="{{url(app()->getLocale().'/admin/settings/')}}"
                          id="form" role="form" enctype="multipart/form-data">
                        {{ csrf_field() }}


                        <div class="card-header">
                            <h3 class="card-title">{{__('cp.contact_info')}}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('cp.info_email')}}</label>
                                        <input type="email" class="form-control form-control-solid"
                                               name="info_email" value="{{$item->info_email}}" required/>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('cp.mobile')}}</label>
                                        <input type="number" class="form-control form-control-solid"
                                               name="mobile" value="{{$item->mobile}}" required/>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('cp.colorWeb')}}</label>
                                        <input type="color" class="form-control form-control-solid"
                                               name="color_webSite" value="{{$item->color_webSite}}" required/>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('cp.facebook')}}</label>
                                        <input type="url" class="form-control form-control-solid"
                                               name="facebook" value="{{$item->facebook}}" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('cp.twitter')}}</label>
                                        <input type="url" class="form-control form-control-solid"
                                               name="twitter" value="{{$item->twitter}}" required/>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('cp.instagram')}}</label>
                                        <input type="url" class="form-control form-control-solid"
                                               name="instagram" value="{{$item->instagram}}" required/>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('cp.paginateTotal')}}</label>
                                        <input type="number" class="form-control form-control-solid"
                                               name="paginateTotal" min="0" value="{{$item->paginateTotal}}" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @foreach($locales as $locale)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('cp.title')}} <span
                                                    class="text-danger">{{$locale->name}}</span></label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="title_{{$locale->lang}}"
                                                   value="{!! @$item->translate($locale->lang)->title!!}"
                                                   required/>
                                        </div>
                                    </div>
                                @endforeach

                                @foreach($locales as $locale)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('cp.Delivery_company_name')}} <span
                                                    class="text-danger">{{$locale->name}}</span></label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="Delivery_company_name_{{$locale->lang}}"
                                                   value="{!! @$item->translate($locale->lang)->Delivery_company_name!!}"
                                                   required/>
                                        </div>
                                    </div>
                                @endforeach

                                    @foreach($locales as $locale)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{__('cp.description_contact')}} <span
                                                        class="text-danger">{{$locale->name}}</span></label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="description_contact_{{$locale->lang}}"
                                                       value="{!! @$item->translate($locale->lang)->description_contact!!}"
                                                       required/>
                                            </div>
                                        </div>
                                    @endforeach
                            </div>

                        </div>


                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="fileinputForm">
                                        <label>{{__('cp.app_logo')}}</label>
                                        <div class="fileinput-new thumbnail"
                                             onclick="document.getElementById('edit_image2').click()"
                                             style="cursor:pointer">
                                            <img src="{{$item->app_logo}}" id="editImage2">
                                        </div>
                                        <div class="btn btn-change-img red"
                                             onclick="document.getElementById('edit_image2').click()">
                                            <i class="fas fa-pencil-alt"></i>
                                        </div>
                                        <input type="file" class="form-control" name="app_logo"
                                               id="edit_image2"
                                               style="display:none">
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="fileinputForm">
                                        <label>{{__('cp.favicon')}}</label>
                                        <div class="fileinput-new thumbnail"
                                             onclick="document.getElementById('edit_image4').click()"
                                             style="cursor:pointer">
                                            <img src="{{$item->fav_icon}}" id="editImage4">
                                        </div>
                                        <div class="btn btn-change-img red"
                                             onclick="document.getElementById('edit_image4').click()">
                                            <i class="fas fa-pencil-alt"></i>
                                        </div>
                                        <input type="file" class="form-control" name="favicon"
                                               id="edit_image4"
                                               style="display:none">
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="fileinputForm">
                                        <label>{{__('cp.login_image')}}</label>
                                        <div class="fileinput-new thumbnail"
                                             onclick="document.getElementById('edit_image3').click()"
                                             style="cursor:pointer">
                                            <img src="{{$item->login_image}}" id="editImage3">
                                        </div>
                                        <div class="btn btn-change-img red"
                                             onclick="document.getElementById('edit_image3').click()">
                                            <i class="fas fa-pencil-alt"></i>
                                        </div>
                                        <input type="file" class="form-control" name="login_image"
                                               id="edit_image3"
                                               style="display:none">
                                    </div>
                                </div>

                            </div>

                        </div>

                        <!--end::Card-->
                        <button type="submit" id="submitForm" style="display:none"></button>
                    </form>

                    <!--end::Container-->
                </div>
                <!--end::Entry-->
            </div>
        </div>
    </div>

@endsection
@section('js')

    <script>
        $('#edit_image2').on('change', function (e) {
            readURL(this, $('#editImage2'));
        });
        $('#edit_image3').on('change', function (e) {
            readURL(this, $('#editImage3'));
        });
        $('#edit_image4').on('change', function (e) {
            readURL(this, $('#editImage4'));
        });
    </script>
@endsection

@section('script')

@endsection
