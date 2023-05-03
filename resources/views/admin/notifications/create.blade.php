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
                        <h3>{{__('cp.notifications')}}</h3>
                    </div>
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <a href="{{url(getLocal().'/admin/notifications')}}" class="btn btn-secondary  mr-2">{{__('cp.cancel')}}</a>
                    <button id="submitButton" class="btn btn-success ">{{__('cp.add')}}</button>
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
                    <form method="post" action="{{url(app()->getLocale().'/admin/notifications')}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form" id="form">
                        {{ csrf_field() }}
                        <div class="card-header">
                            <h3 class="card-title">{{__('cp.main_data')}}</h3>
                        </div>



                        <div class="card-body">
                                <div class="row">
                                    @foreach($locales as $locale)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{__('cp.title_'.$locale->lang)}}</label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="title_{{$locale->lang}}" {{($locale->lang == 'ar') ? 'dir=rtl' :'' }} value="{{old('title_'.$locale->lang)}}" required />
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            <div class="row">
                                    @foreach($locales as $locale)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{__('cp.message_'.$locale->lang)}}</label> <span style="color: #7b7878; font-size: 13px;"> ( @lang('cp.max150') )</span>
                                                <textarea type="text" class="form-control form-control-solid"  maxlength="150" 
                                                          rows="3" {{($locale->lang == 'ar') ? 'dir=rtl' :'' }}  name="message_{{$locale->lang}}" required >{{old('message_'.$locale->lang)}}</textarea>
                                            </div>
                                        </div>
                                    @endforeach
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

    <script src="{{asset('/admin_assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js')}}"></script>

    <script>

        var KTCkeditor = function () {
            // Private functions
            var demos = function () {

                var allEditors = document.querySelectorAll('.kt-ckeditor');
                for (var i = 0; i < allEditors.length; ++i) {
                    ClassicEditor.create(allEditors[i]).then(editor => {
                        console.log(editor);
                    })
                        .catch(error => {
                            console.error(error);
                        });
                    ;
                }

            }

            return {
                // public functions
                init: function () {
                    demos();
                }
            };
        }();

        // Initialization
        jQuery(document).ready(function () {
            KTCkeditor.init();
        });

        $('#edit_image').on('change', function (e) {

            readURL(this, $('#editImage'));

        });

        $(document).on('click', '#submitButton', function () {
            // $('#submitButton').addClass('spinner spinner-white spinner-left');
            $('#submitForm').click();
        });
    </script>



@endsection

@section('script')

@endsection
