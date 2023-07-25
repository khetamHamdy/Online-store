@extends('layout.siteLayout')

@section('content')
    <section class="edit_account_page stage_padding">
        <div class="container">
            <div class="row">
                @include('website.components.aside-profile')
                <div class="col-lg-8">
                    <div class="head-acco wow fadeInUp">
                        <h4>{{__('cp.ChangePassword')}}</h4>
                    </div>
                    <form class="form-edit form-st wow fadeInUp" method="post"
                          action="{{route('change_password' , Auth('web')->id())}}">
                        @csrf
                        <div class="form-group">
                            <label>{{__('cp.OldPassword')}}*</label>
                            <input type="password" class="form-control" placeholder="Enter Here" name="old_password"/>
                        </div>
                        <div class="form-group">
                            <label>{{__('cp.NewPassword')}}*</label>
                            <input type="password" class="form-email form-control" placeholder="Enter Here"
                                   name="password"/>
                        </div>
                        <div class="form-group">
                            <label>{{__('cp.ConfirmNewPassword')}}*</label>
                            <input type="password" class="form-control" placeholder="Enter Here"
                                   name="confirm_password"/>
                        </div>
                        <div class="form-group">
                            <button class="btn-site"><span>{{__('cp.edit')}}</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--edit_account_page-->
@endsection
