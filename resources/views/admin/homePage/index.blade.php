@extends('layout.adminLayout')
@section('title') {{ucwords(__('cp.homePage'))}}
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
                    <form class="form" method="post" action="{{url(app()->getLocale().'/admin/homePage/')}}"
                          id="form" role="form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-header">
                            <h3 class="card-title">{{__('cp.homePage')}}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                             @foreach($locales as $locale)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('cp.banner_text')}} <span class="text-danger"> {{$locale->name}} <span></label>
                                            <textarea class="form-control ckEditor-y"   {{($locale->lang == 'ar') ? 'dir=rtl' :'' }} name="banner_text_{{$locale->lang}}"
                                                              id="order" rows="4" required>{!! @$item->translate($locale->lang)->banner_text!!}</textarea>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                             @foreach($locales as $locale)
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label>{{__('cp.who_we_are_description')}} <span class="text-danger"> {{$locale->name}} <span></label>
                                            <textarea class="form-control ckEditor-y"   {{($locale->lang == 'ar') ? 'dir=rtl' :'' }} name="who_we_are_description_{{$locale->lang}}"
                                                              id="order" rows="4" required>{!! @$item->translate($locale->lang)->who_we_are_description!!}</textarea>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                             @foreach($locales as $locale)
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label>{{__('cp.what_we_do_description')}} <span class="text-danger"> {{$locale->name}} <span></label>
                                            <textarea class="form-control ckEditor-y"   {{($locale->lang == 'ar') ? 'dir=rtl' :'' }} name="what_we_do_description_{{$locale->lang}}"
                                                              id="order" rows="4" required>{!! @$item->translate($locale->lang)->what_we_do_description!!}</textarea>
                                    </div>
                                </div>
                            @endforeach
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
<script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/super-build/ckeditor.js"></script>
    <script>
@include('admin.settings.editor_script')
    </script>

@endsection

@section('script')

@endsection
