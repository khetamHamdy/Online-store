@extends('layout.adminLayout')
@section('title') {{ucwords(__('cp.users'))}}
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
                        <h3>{{__('cp.add')}}</h3>
                    </div>
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <a href="{{url(getLocal().'/admin/users')}}" class="btn btn-secondary  mr-2">{{__('cp.cancel')}}</a>
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
                    <form class="form" method="post" action="{{url(app()->getLocale().'/admin/users')}}"
                          role="form" id="form" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h3 class="card-title">{{__('cp.main_info')}}</h3>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_name">{{__('cp.name')}}</label>
                                        <input type="text" class="form-control form-control-solid" name="user_name"
                                               value="{{ old('user_name') }}" id="user_name" autocomplete="off" required/>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">{{__('cp.mobile')}}</label>
                                        <input type="mobile"
                                               onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                               class="form-control form-control-solid" name="mobile"
                                               value="{{ old('mobile') }}" id="mobile" maxlength="8" minlength="8" min="0" required/>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_number">{{__('cp.email')}}</label>
                                        <input type="email" class="form-control form-control-solid" name="email"
                                               value="{{ old('email') }}" id="email" required/>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">{{__('cp.password')}}</label>
                                        <input type="password" class="form-control form-control-solid" name="password"
                                               value="{{ old('password') }}" id="password" required/>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">{{__('cp.confirm_password')}}</label>
                                        <input type="password" class="form-control form-control-solid"
                                               name="confirm_password"
                                               value="{{ old('confirm_password') }}" id="confirm_password" required/>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('cp.status')}}</label>
                                        <select class="form-control form-control-solid"
                                                name="status" required>
                                            <option
                                                value="active">
                                                {{__('cp.active')}}
                                            </option>
                                            <option
                                                value="not_active">
                                                {{__('cp.not_active')}}
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('cp.notifications')}}</label>
                                        <span class="switch">
                                    <label>
                                        <input type="checkbox" name="notifications" {{request()->notifications?'checked':''}}/>
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
@endsection

@section('script')

@endsection
