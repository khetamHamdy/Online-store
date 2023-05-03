<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>Email</title>
    <link rel="icon" href="{{url('web/emails/img/logo.svg')}}">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600&display=swap');
        body {
            margin: 0;
            padding: 0;
            font-family: 'Cairo', sans-serif;
            background: #eee;
        }
        p {
            margin: 0;
            padding: 0;
        }
        .wrapper {
            background: #fff;
            padding: 15px;
            width: 600px;
            margin: auto;
        }
        .main-table {
            background: #fff;
            color: #231F20;
            border-radius: 10px;
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            border-spacing: 0;
        }
    </style>

</head>

<body>
<center class="wrapper" style="padding: 5px">
    <table class="main-table" width="100%">
        <tr>
            <td style="text-align: center;padding: 10px;background: #482366;margin-bottom: 30px;">
                <table width="100%">
                    <tr>
                        <td style="border-radius: 15px;text-align: center;padding: 20px;">
                            <a href=""><img src="{{url('web/emails/img/logo.svg')}}" alt="" title="Logo" width="80px" /></a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!--Logo-->

        <tr>
            <td style="text-align: center">
                <table width="100%">
                    <tr>
                        <td style="text-align: center">
                            <p style="font-size: 16px;font-weight: 700; margin-bottom: 0px;margin-top: 40px;color: #000">@lang('api.hello')</p>
                            <strong style="color: #482366;font-size: 30px;margin-bottom: 30px;display: block;">@lang('api.forgot_your_password')</strong>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!--author-->

        <tr>
            <td style="text-align: center">
                <table width="100%">
                    <tr>
                        <td style="text-align: center;">
                            <p style="font-size: 15px;margin-bottom: 15px;">@lang('api.setup_new_password')</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!--ph-->

        <tr>
            <td style="text-align: center;padding-bottom: 50px;">
                <table width="100%">
                    <tr>
                        <td style="text-align: center;">
                            <p style="font-size: 15px;margin-bottom: 45px;">@lang('api.pleas_click_in_below_button')</p>
                            <a href="{{$url}}" target="_blank" style="background:#F0483E;color:#fff;width:200px;height:40px;border-radius:15px;text-decoration:none;display: inline-block;line-height: 40px;font-weight: 700;font-size: 17px;text-transform: uppercase;">@lang('api.reset_password')</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!--ph-->

        <tr>
            <td style="text-align: center; border: 1px solid rgb(72 35 102 / 40%); padding-top: 15px">
                <table width="100%">
                    <tr>
                        <td style="text-align: center;">
                            <p style="font-size: 14px;font-weight: 600;color: #2C2C2C">{{$setting->info_email}}</p>
                            <p style="font-size: 14px;font-weight: 600;margin: 0">Copyright © 2022 yammk. All Rights Reserved.</p>
                            <span style="font-size: 14px; color: #AAAAAA;font-weight: 600;text-decoration: underline">Unsubscribe</span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!--footer-->

    </table>
</center>
</body>
</html>
