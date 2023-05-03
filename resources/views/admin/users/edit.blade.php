@extends('admin.users.sideMenu')
@section('companyContent')
    <div class="flex-row-fluid ml-lg-8">
        <div class="card card-custom gutter-b example example-compact">

            <div class="card-header">
                <h3 class="card-title">{{__('cp.editInformation')}}</h3>
            </div>

            <form method="post" action="{{url(app()->getLocale().'/admin/users/'.$item->id)}}"
                  enctype="multipart/form-data" class="form-horizontal" role="form" id="form">
                {{ csrf_field() }}
                {{ method_field('PATCH')}}


                <div class="row col-sm-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__('cp.name')}}</label>
                            <input type="text" class="form-control form-control-solid"
                                   name="user_name" value="{{old('user_name',$item->user_name)}}" required/>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__('cp.mobile')}}</label>
                            <input type="text" class="form-control form-control-solid" name="mobile"
                                   onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                   value="{{old('mobile',$item->mobile)}}" maxlength="8" minlength="8" min="0" required/>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__('cp.email')}}</label>
                            <input type="email" class="form-control form-control-solid" name="email"
                                   value="{{old('email',$item->email)}}" required/>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__('cp.status')}}</label>
                            <select class="form-control form-control-solid"
                                    name="status" required>
                                <option
                                    value="active" {{old('status',$item->status) == 'active'?'selected':''}}>
                                    {{__('cp.active')}}
                                </option>
                                <option
                                    value="not_active" {{old('status',$item->status)  == 'not_active'?'selected':''}}>
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
                                        <input type="checkbox" name="notifications" {{$item->notifications?'checked':''}}/>
                                        <span></span>
                                    </label>
                                </span>
                        </div>
                    </div>

                </div>


                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <a href="{{url(getLocal().'/admin/users')}}" class="btn btn-secondary  mr-2">{{__('cp.cancel')}}</a>
                    <button id="submitButton" class="btn btn-success ">{{__('cp.save')}}</button>
                </div>
                <!--end::Toolbar-->
                <button type="submit" id="submitForm" style="display:none"></button>
            </form>

        </div>
    </div>
@endsection
@section('js')

    <script>
        $(document).on('click', '#submitButton', function () {
            $('#submitForm').click();
        });
    </script>
@endsection
