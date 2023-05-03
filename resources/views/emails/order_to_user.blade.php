<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" dir="{{(app()->getLocale() == 'ar') ? 'rtl' : 'ltr'}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>Email</title>
    <link rel="icon" href="{{url('web/emails/img/logo.svg')}}">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap');
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
            max-width: 800px;
            margin: 0 auto;
            border-spacing: 0;
            font-family: 'Cairo', sans-serif;
        }
        .table-product td:nth-child(1) {
            width: 10%;
        }
        .table-product td:nth-child(2) {
            width: 60%;
        }
        .table-product td:nth-child(3) {
            width: 30%;
        }
        .table-product tbody td {
            padding: 15px 0;
            line-height: 1.4;
            vertical-align: top;
        }
        .table-product th {
            color: #ED2E6F
        }
        .d--p h6, .d--p p {
            display: inline-block;
        }
        .d--p h6 {
            font-size: 15px;
            color: #000;
        }
        .d--p p {
            font-size: 14px;
            margin: 0 5px;
        }
        .to--pro {
            margin-bottom: 15px;
        }
        .to--pro:last-child {
            margin-bottom: 0;
        }
        .to--proU p {
            color: #2A2B2C;
            font-weight: 600
        }
        .to--pro p, .to--pro strong {
            display: inline-block;
            width: 50%;
            font-weight: 600;
        }
        .to--pro strong {
            font-weight: 700;
        }
        .to--pro p:last-child, .to--pro strong:last-child {
            text-align: end
        }

    </style>

</head>

<body>
<center class="wrapper">
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
            <td style="text-align: center;">
                <table width="100%">
                    <tr>
                        <td style="text-align: center">
                            <p style="font-size: 16px;margin-bottom: 0px;margin-top: 40px;color:#000;font-weight: 600;">@lang('api.hello1') {{$order->customer_name}}</p>
                            <strong style="color: #482366;font-size: 27px;margin-bottom: 10px;display: block;font-weight: 500">@lang('api.order_placed')</strong>
                            <span style="color:#F0483E;border: 1px solid #F0483E; padding: 0 15px;font-weight: 600;font-size: 17px;margin-bottom: 30px;display: inline-block;">{{@$order->provider->name}}</span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!--author-->

        <tr>
            <td style="">
                <table width="100%">
                    <tr>
                        <td style="background:rgb(156 117 181 / 4%);;padding:15px 40px">
                            <h5>@lang('api.products_details')</h5>
                            <table width="100%" class="table-product" style="text-align: left;border-collapse: collapse;margin-bottom: 20px">
                                <tbody>
                                @foreach($order->meals as $one)
                                    <tr>
                                        <td style="color: #744091;">{{@$one->quantity}}x</td>

                                        <td>
                                            {{@$one->meal->title}}
                                            @if($one->extras)
                                                @foreach($one->extras as $extra)
                                                    <p style="color: #744091;font-size: 14px">{{@$extra->quantity}}x {{@$extra->extra->name}} <span style="color:#F0483E"> {{@$extra->price}} @lang('api.$')</span></p>
                                                @endforeach
                                            @endif

                                            @if($one->options)
                                                @foreach($one->options as $option)
                                                    <p style="color: #744091;font-size: 14px">{{@$option->option->name}} <span style="color:#F0483E"> {{@$option->price}} @lang('api.$')</span></p>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td style="text-align: end">{{@$one->price}} @lang('api.$')</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <table width="60%" style="margin-inline-start: auto;">
                                <tr>
                                    <td>
                                        <div class="to--pro"><strong style="color: #F0483E">@lang('api.grand_total')</strong><strong style="color: #F0483E">{{$order->total}} @lang('api.$')</strong></div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!--ph-->

        <tr>
            <td style="padding-bottom: 50px;">
                <table width="100%">
                    <tr style="vertical-align: top;">
                        <td style="width: 50%;">
                            <table class="colom" style="width: 100%;border-radius: 15px;height: 200px;">
                                <tr width="100%" style="vertical-align: top">
                                    <td width="100%">
                                        <h4 style="font-weight: 700; color: #2A2B2C; margin-bottom: 15px">@lang('api.payment_details')</h4>
                                        <p style="color:#2A2B2C;font-size: 14px">@lang('api.payment_method') : {{$order->payment_method=='1' ? __('api.online'): __('api.cash_on_pickup')}}</p>
                                        <p style="color:#2A2B2C;font-size: 14px">@lang('api.payment_status') : {{@$order->payment_status==1 ?__('cp.payed') : __('cp.not_payed')}}</p>
                                        <p style="color:#2A2B2C;font-size: 14px">@lang('api.invoice_reference') : {{@$order->payment_id}}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td style="width: 50%;">
                            <table class="colom" style="width: 100%;">
                                <tr width="100%">
                                    <td width="100%" style="text-align: right;">
                                        <h4 style="font-weight: 700; color: #2A2B2C; margin-bottom: 15px">@lang('api.order_details')</h4>
                                        <p style="color:#2A2B2C;font-size: 14px">@lang('api.order_id') : #{{$order->id}}</p>
                                        <p style="color:#2A2B2C;font-size: 14px">@lang('api.order_date') : {{$order->created_at->format('d/m/Y')}}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!--ph invoice-->

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





