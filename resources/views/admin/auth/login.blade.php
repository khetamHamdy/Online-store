<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>{{__('cp.Login_Into_Panel')}}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <link rel="icon" href="{{@$setting->favicon}}">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@500;800&display=swap" rel="stylesheet">

	<style>
		html {
		  height: 100%;
		}
		body {
			color: #575a5d;
		    font-family: 'Tajawal', sans-serif !important;
			font-size: 14px;
			font-weight: normal;
			letter-spacing: 0.01em;
			-webkit-font-smoothing: antialiased;
			-webkit-text-size-adjust: 100%;
			-ms-text-size-adjust: 100%;
			-webkit-font-feature-settings: "kern" 1;
			-moz-font-feature-settings: "kern" 1;
			height: 100%;
			margin: 0;
			padding: 0;
			background-color: #f5f6f7;
			@if(app()->getLocale() == "ar")

			text-align:right;
			@else
			direction: ltr;
			@endif
			-moz-osx-font-smoothing: grayscale;
		}
		a:hover {
			text-decoration: none
		}
		.logoLogin {
			padding: 30px 30px 0;
			margin: 30px 20px 0 20px;
		}
		.logoLogin img{
		/*	max-width: 100px*/
		}
		.login-wrapper {
		    height: 100%;
		   /* background-color: #F94B4B;*/
		}
		.login-wrapper > * {
			height: 100%;
		}
		.login-wrapper .bg-pic {
			position: absolute;
			width:80%;
			overflow: hidden;
		}
		.login-wrapper .bg-pic > img {
			  height: 100%;
			  width: 100%;
			  opacity:0.8;
		}
		.login-wrapper .login-container {
			width: 496px;
			display: block;
			position: relative;
			float: right;
			height: 100%;
		}
		.login-wrapper .bg-caption {
    		width: 500px;
		}
		.formLogin {
			padding-top: 15px
		}
		.form-group-default {
			background-color: #fff;
			position: relative;
			border: 1px solid rgba(0, 0, 0, 0.07);
			border-radius: 2px;
			padding-top: 7px;
			padding-left: 12px;
			padding-right: 12px;
			padding-bottom: 4px;
			overflow: hidden;
			width: 100%;
			-webkit-transition: background-color 0.2s ease;
			transition: background-color 0.2s ease;
		}
		.form-group {
			margin-bottom: 10px;
		}
		.form-group label:not(.error) {

			font-size: 10.5px;
			letter-spacing: 0.06em;
			text-transform: uppercase;
			font-weight: 500;
		}
		.form-group-default label {
			margin: 0;
			display: block;
			opacity: 1;
			-webkit-transition: opacity 0.2s ease;
			transition: opacity 0.2s ease;
		}
		.form-group-default .form-control {
			border: none;
			height: 25px;
			min-height: 25px;
			padding: 0;
			margin-top: -4px;
			background: none;
		}
		.form-control {
		  background-color: #fff;
		  background-image: none;
		  border: 1px solid rgba(0, 0, 0, 0.07);

		  -webkit-appearance: none;
		  color: #2c2d2f;
		  outline: 0;
		  padding: 8px 12px;
		  line-height: normal;
		  font-size: 14px;
		  font-weight: normal;
		  vertical-align: middle;
		  min-height: 35px;
		  -webkit-transition: all 0.12s ease;
		  transition: all 0.12s ease;
		  box-shadow: none;
		  border-radius: 2px;
		  -webkit-border-radius: 2px;
		  -moz-border-radius: 2px;
		  -webkit-transition: background 0.2s linear 0s;
		  transition: background 0.2s linear 0s;
		}
		.form-control:focus {
			outline: 0 !important;
			box-shadow: none;
		}
		.form-control:focus::-moz-placeholder {
			  color: inherit;
			  opacity: 0.7;
			  font-size: 12px
		}
		.form-control:focus:-ms-input-placeholder {
			  color: inherit;
			  opacity: 0.7;
			  font-size: 12px
		}
		.form-control:focus::-webkit-input-placeholder {
			  color: inherit;
			  opacity: 0.7;
			  font-size: 12px
		}
		.form-control::-moz-placeholder {
			color: inherit;
			opacity: 0.33;
			font-size: 12px
		}
		.form-control:-ms-input-placeholder {
			color: inherit;
			opacity: 0.33;
			font-size: 12px
		}
		.form-control::-webkit-input-placeholder {
			color: inherit;
			opacity: 0.33;
			font-size: 12px
		}
		.titleLog {
			padding-top: 15px
		}
		.pull-right {
			float: right !important;
		}
		.pull-bottom {
			position: absolute !important;
			bottom: 0;
		}
		.btnSub {
		  	margin-right: 5px;
		  	min-width: 120px;
			margin-top: 10px;
			background: #64cee0;;
			border-color:#64cee0;
			color: white;
			box-shadow: none;
		}
		.btnSub:hover, .btnSub:focus {
			opacity: .7;
			background-color: #4482C2;
			border-color: #4482C2;
			color: #fff;
		}
		@media (max-width: 768px) {
  			.login-wrapper .login-container {
    			width: 100%;
			}
			.register-container {
				width: 100%;
				padding: 15px;
			}
		}
		@media only screen and (max-width: 321px) {
  			.login-wrapper .login-container {
    			width: 100%;
			}
		}

	</style>

  </head>

  <body>
    <div class="login-wrapper">
      <div class="bg-pic">
        <img src="{{$setting->login_image}}" alt="" class="lazy">
      </div>
      <div class="login-container bg-white">
        <div class="logoLogin">
          <img src="{{@$setting->favicon}}" style="width:70px ; hight:70px;" alt="logo">

          <p class="titleLog">{{__('cp.Login_Into_Panel')}}</p>
          @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>{{'Error'}}!</strong>{{' Wrong data entry'}}<br>
                <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

          <form id="formLogin" class="formLogin" role="form"  action="{{url(app()->getLocale().'/admin/login')}}" method="post">
                  {{ csrf_field() }}
            <div class="form-group form-group-default">
              <label>{{__('cp.email')}}</label>
              <div class="controls">
                <input name="email" type="email"  class="form-control" required>

               @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            <div class="form-group form-group-default">
              <label>{{__('cp.password')}}</label>
              <div class="controls">
                <input type="password" class="form-control" required="" name="password" >
                  @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif

              </div>
            </div>

			<button class="btn btnSub"  style="color: white;" type="submit">{{__('cp.Sign_in')}}</button>
          </form>

           <div class="pull-bottom pull-right">
                <p>Powered By <a href="https://linekw.com/" class="text-info">Line</a></p>
          </div>
        </div>
      </div>
    </div>


  </body>
</html>
