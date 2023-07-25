@extends('layout.adminLayout')
@section('title') {{ucwords(__('cp.permissions'))}}
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
                        <h3>{{__('cp.edit')}} {{@$item->name}}</h3>
                    </div>
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <a href="{{url(getLocal().'/admin/permission')}}"
                       class="btn btn-secondary  mr-2">{{__('cp.cancel')}}</a>
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
                    <form method="post" action="{{url(app()->getLocale().'/admin/permission/'.$item->id)}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form" id="form">
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
                                                <label>{{__('cp.slug')}} </label>
                                                <input type="text" class="form-control form-control-solid"   name="slug" value="{{@$item->slug}}"
                                                       required/>
                                            </div>
                                        </div>
                                    @foreach($locales as $locale)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{__('cp.name')}} <span class="text-danger"> {{$locale->name}} <span></label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="name_{{$locale->lang}}"
                                                       {{($locale->lang == 'ar') ? 'dir=rtl' :'' }} value="{{old('name_'.$locale->lang,@$item->translate($locale->lang)->name)}}"
                                                       required/>
                                            </div>
                                        </div>
                                    @endforeach
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
    <script>
        $('#edit_image').on('change', function (e) {
            readURL(this, $('#editImage'));
        });
        $(document).on('click', '#submitButton', function () {
            // $('#submitButton').addClass('spinner spinner-white spinner-left');
            $('#submitForm').click();
        });
    </script>
<script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/super-build/ckeditor.js"></script>
    <script>
@include('admin.settings.editor_script')
    </script>

@endsection

@section('script')

@endsection
