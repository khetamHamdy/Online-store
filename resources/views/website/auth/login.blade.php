@extends('layout.siteLayout')
@section('content')
    <section class="sign_page stage_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="cont-login">
                        <div class="hd-sign">
                            <h6>{{__('cp.login')}}</h6>
                        </div>

                        <form class="form-st form-login" method="post" action="{{route('login')}}">
                            @csrf
                            <div class="form-group">
                                <label>{{__('cp.email')}}*</label>
                                <input type="text" class="form-control" placeholder="Enter Here" name="email">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>{{__('cp.password')}}*</label>
                                <input type="password" class="form-control" placeholder="Enter Here" name="password">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="forgot-pass text-end">
                                <a href="forgot-password.html">{{__('cp.forget_password')}}?</a>
                            </div>
                            <div class="form-group">
                                <button class="btn-site " data-bs-toggle="modal" data-bs-target="#modalSendMs">
                                    <span>{{__('cp.login')}}</span></button>
                            </div>
                            <div class="forgot-pass text-end">
                                create account ? <a class="text-success" href="{{route('register.form')}}">register</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--found_page-->
@endsection
