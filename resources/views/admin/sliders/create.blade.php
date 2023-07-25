@extends('layout.adminLayout')
@section('title')
    {{ucwords(__('Sliders'))}}
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
                        <h3>{{__('Add')}}</h3>
                    </div>
                </div>
                <!--end::Info-->
                <form method="post" action="{{url(app()->getLocale().'/admin/sliders')}}"
                      enctype="multipart/form-data" class="form-horizontal" role="form" id="form">
                    <!--begin::Toolbar-->
                    <div class="d-flex align-items-center">
                        <a href="{{url(app()->getLocale().'/admin/sliders')}}"
                           class="btn btn-secondary mr-2"> {{__('Cancel')}} </a>
                        <button id="submitButton" class="btn btn-success"
                                >{{__('Save')}}</button>
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

                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">{{__('cp.main_info')}}</h3>
                    </div>
                    <div class="row col-sm-12">
                        <div class="card-body">

                            <div class="card-body col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('cp.image')}}</label>
                                            <div class="fileinput-new thumbnail"
                                                 onclick="document.getElementById('edit_image').click()"
                                                 style="cursor:pointer">
                                                <img src="{{choose()}}" id="editImage" alt="">
                                            </div>
                                            <div class="btn red"
                                                 onclick="document.getElementById('edit_image').click()">
                                                <i class="fa fa-pencil"></i>
                                            </div>
                                            <input type="file" class="form-control" name="image"
                                                   id="edit_image"
                                                   style="display:none">
                                        </div>
                                    </div>
                                </div>
                            </div>

                                   <!--begin::Group-->
                            <div class="form-group row">
                                <label
                                    class="col-xl-3 col-lg-3 col-form-label">{{__('cp.type')}} </label>
                                <div class="col-lg-9 col-xl-9">
                                    <select
                                        class="form-control form-control-solid form-control-lg" id="input_type"
                                        name="type">
                                         <option value="">select type</option>
                                            <option value="1"
                                                    @if(old('type') == 1) selected @endif> link </option>
                                            <option value="2"
                                                    @if(old('type') == 2) selected @endif> Category </option>
                                            <option value="3"
                                                    @if(old('type') == 3) selected @endif> Product </option>
                                    </select>
                                </div>
                            </div>
                            <!--end::Group-->

                                     <!--begin::Group-->
                            <div class="form-group row links" style="display: none">
                                <label
                                    class="col-xl-3 col-lg-3 col-form-label">{{__('cp.link')}} </label>
                                <div class="col-lg-9 col-xl-9">
                                    <input
                                        class="form-control form-control-solid form-control-lg"
                                        name="link">

                                    </input>
                                </div>
                            </div>
                            <!--end::Group-->

                             <!--begin::Group-->
                            <div class="form-group row categories" style="display: none">
                                <label
                                    class="col-xl-3 col-lg-3 col-form-label">{{__('cp.categories')}} </label>
                                <div class="col-lg-9 col-xl-9">
                                    <select
                                        class="form-control form-control-solid form-control-lg"
                                        name="category_id">
                                        <option value=""></option>
                                        @foreach($catgeories as $one)
                                            <option value="{{$one->id}}"
                                                    @if(old('category_id') == $one->id) selected @endif>{{$one->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--end::Group-->

                                   <!--begin::Group-->
                            <div class="form-group row products" style="display: none">
                                <label
                                    class="col-xl-3 col-lg-3 col-form-label">{{__('cp.products')}} </label>
                                <div class="col-lg-9 col-xl-9">
                                    <select
                                        class="form-control form-control-solid form-control-lg"
                                        name="product_id">
                                         <option value=""></option>
                                        @foreach($products as $one)
                                            <option value="{{$one->id}}"
                                                    @if(old('product_id') == $one->id) selected @endif>{{$one->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--end::Group-->


                            <!--begin::Group-->
                            <div class="form-group row">
                                <label
                                    class="col-xl-3 col-lg-3 col-form-label">{{__('Status')}} </label>
                                <div class="col-lg-9 col-xl-9">
                                    <select
                                        class="form-control form-control-solid form-control-lg"
                                        name="status">
                                        @foreach($status as $one => $key)
                                            <option value="{{$one}}"
                                                    @if(old('status') == $one) selected @endif>{{$key}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--end::Group-->


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

@endsection

@section('script')
<script>
        $(document).on('change', '#input_type', function () {
            var option = $(this).val();

            if (option == "1") {
                $('.links').show();
                $('.categories').hide();
                $('.products').hide();
            } else if(option == "2") {
                $('.links').hide();
                $('.categories').show();
                $('.products').hide();
            }else{
                $('.links').hide();
                $('.categories').hide();
                $('.products').show();
            }

        });
</script>
@endsection
