@extends('layout.adminLayout')
@section('title')
    {{ucwords(__('cp.promoCodes'))}}
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
                        <h3>{{__('cp.add')}}</h3>
                    </div>
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <a href="{{url(getLocal().'/admin/promoCodes')}}"
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
                    <form method="post" action="{{url(app()->getLocale().'/admin/promoCodes')}}"
                          enctype="multipart/form-data" class="form">
                        {{ csrf_field() }}

                        <div class="card-header">
                            <h3 class="card-title">{{__('cp.main_info')}}</h3>
                        </div>

                        <div class="row col-sm-12">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('cp.promo_code_name')}}
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="promo_code_name"
                                                   value="{!! old('promo_code_name')!!}"
                                                   required/>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('cp.promo_code_amount')}}
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="promo_code_amount"
                                                   value="{!! old('promo_code_amount')!!}"
                                                   required/>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('cp.discount')}}
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="discount"
                                                   value="{!! old('discount')!!}"
                                                   required/>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('cp.promo_code_type')}}
                                            </label>
                                            <select class="form-control" name="promo_code_type">
                                                <option value="0">percentage</option>
                                                <option value="1">amount</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" id="submitForm" style="display:none"></button>



                        </div>
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
