@extends('layout.siteLayout')
@section('content')
    <section class="sign_page stage_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="cont-sign">
                        <div class="hd-sign">
                            <h6>NEW ACCOUNT</h6>
                        </div>
                        <form class="form-sign" action="{{route('register')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Name*</label>
                                <input type="text" class="form-control" placeholder="Enter Here" name="user_name">
                                @if ($errors->has('user_name'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('user_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Email Address*</label>
                                <input type="text" class="form-control" placeholder="Enter Here" name="email">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Mobile Number*</label>
                                <div class="d-flex">
                                    <input type="number" class="form-control" placeholder="Enter Here" name="mobile">
                                    @if ($errors->has('mobile'))
                                        <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('mobile') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Password*</label>
                                <input type="password" class="form-control" placeholder="Enter Here" name="password">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Confirm Password*</label>
                                <input type="password" class="form-control" placeholder="Enter Here"
                                       name="password_confirmation">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong
                                            class="text-danger">{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn-site"
                                       ><span>Signup</span></button>
                            </div>
                            <div class="forgot-pass text-end">
                                hava account ? <a class="text-success" href="{{route('login.form')}}">login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--found_page-->
@endsection
