@extends('layout.adminLayout')
@section('title')
    {{ucwords(__('cp.pages'))}}
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
                        <h3>{{__('cp.pages')}}</h3>
                    </div>
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <a href="{{url(getLocal().'/admin/pages')}}" class="btn btn-secondary  mr-2">{{__('cp.cancel')}}</a>
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
                    <form method="post" action="{{url(app()->getLocale().'/admin/pages/'.$item->id)}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form" id="form">
                        {{ csrf_field() }}
                        {{ method_field('PATCH')}}
                        <div class="card-header">
                            <h3 class="card-title">{{$item->title}}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($locales as $locale)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('cp.title')}} <span
                                                    class="text-danger"> {{$locale->name}} <span></label>
                                            <input class="form-control "
                                                   {{($locale->lang == 'ar') ? 'dir=rtl' :'' }} name="title_{{$locale->lang}}"
                                                   required value="{!! @$item->translate($locale->lang)->title!!}"/>
                                        </div>
                                    </div>
                                @endforeach
                                @foreach($locales as $locale)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('cp.description')}} <span class="text-danger"> {{$locale->name}} <span></label>
                                            <textarea class="form-control ckEditor-y"
                                                      {{($locale->lang == 'ar') ? 'dir=rtl' :'' }} name="description_{{$locale->lang}}"
                                                      id="order" rows="4"
                                                      required>{!! @$item->translate($locale->lang)->description!!}</textarea>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="col-md-6">
                                    <div class="fileinputForm">
                                        <label>{{__('cp.image')}}</label>
                                        <div class="fileinput-new thumbnail"
                                             onclick="document.getElementById('edit_image4').click()"
                                             style="cursor:pointer">
                                            <img src="{{$item->image}}" id="editImage4">
                                        </div>
                                        <div class="btn btn-change-img red"
                                             onclick="document.getElementById('edit_image4').click()">
                                            <i class="fas fa-pencil-alt"></i>
                                        </div>
                                        <input type="file" class="form-control" name="image"
                                               id="edit_image4"
                                               style="display:none">
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
    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/super-build/ckeditor.js"></script>
    <script>
        @include('admin.settings.editor_script')
    </script>
    <script>
        $('#edit_image1').on('change', function (e) {
            readURL(this, $('#editImage1'));
        });
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
