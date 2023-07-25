<!DOCTYPE html>
<html>
<head>
    <title>Larave Generate Invoice PDF - Nicesnippest.com</title>
</head>
<style type="text/css">
    body {
        font-family: 'Roboto Condensed', sans-serif;
    }

    .m-0 {
        margin: 0px;
    }

    .p-0 {
        padding: 0px;
    }

    .pt-5 {
        padding-top: 5px;
    }

    .mt-10 {
        margin-top: 10px;
    }

    .text-center {
        text-align: center !important;
    }

    .w-100 {
        width: 100%;
    }

    .w-50 {
        width: 50%;
    }

    .w-85 {
        width: 85%;
    }

    .w-15 {
        width: 15%;
    }

    .logo img {
        width: 45px;
        height: 45px;
        padding-top: 30px;
    }

    .logo span {
        margin-left: 8px;
        top: 19px;
        position: absolute;
        font-weight: bold;
        font-size: 25px;
    }

    .gray-color {
        color: #5D5D5D;
    }

    .text-bold {
        font-weight: bold;
    }

    .border {
        border: 1px solid black;
    }

    table tr, th, td {
        border: 1px solid #d2d2d2;
        border-collapse: collapse;
        padding: 7px 8px;
    }

    table tr th {
        background: #F4F4F4;
        font-size: 15px;
    }

    table tr td {
        font-size: 13px;
    }

    table {
        border-collapse: collapse;
    }

    .box-text p {
        line-height: 10px;
    }

    .float-left {
        float: left;
    }

    .total-part {
        font-size: 16px;
        line-height: 12px;
    }

    .total-right p {
        padding-right: 20px;
    }
</style>
<body>
<div class="head-title">
    <h1 class="text-center m-0 p-0">Invoice</h1>
</div>
<div class="add-detail mt-10">
    <div class="w-50 float-left mt-10">
        <p class="m-0 pt-5 text-bold w-100">Invoice Id - <span class="gray-color">#6</span></p>
        <p class="m-0 pt-5 text-bold w-100">Order Id - <span class="gray-color">{{$order->id}}</span></p>
        <p class="m-0 pt-5 text-bold w-100">Order Date - <span class="gray-color">{{$order->order_date}}</span></p>
    </div>
    <div class="w-50 float-left logo mt-10">
        {{--        <img src="{{$settings->app_logo}}"> <span>{{$settings->title}}</span>--}}
    </div>
    <div style="clear: both;"></div>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">From</th>
        </tr>
        <tr>
            <td>
                <div class="box-text">
                    Shipping Street : <p>{{$order->shipping_street}}</p>
                    Shipping Block : <p>{{$order->shipping_block}}</p>
                    Shipping Delivery Mobile Number<p>{{$order->shipping_deliveryMobileNumber}}</p>
                    Shipping House Number<p>{{$order->shipping_houseNumber}}</p>
                    Shipping Extra Description<p>{{$order->shipping_extraDescreption}}</p>

                </div>
            </td>
        </tr>
    </table>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">Payment Method</th>
            <th class="w-50">{{@$order->payment_method == 1  ? 'online' : 'cache on pickup'}}</th>
        </tr>
        {{--        @if(@$order->payment_method == 2)--}}
        {{--            <tr>--}}
        {{--                <td>Cash On Delivery</td>--}}
        {{--                <td>{{@$order->address->city->price  }}</td>--}}
        {{--            </tr>--}}
        {{--        @endif--}}
    </table>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">SKU</th>
            <th class="w-50">Product Name</th>
            <th class="w-50">Price</th>
            <th class="w-50">Qty</th>
            <th class="w-50">category</th>

        </tr>
        @foreach($order->products as $one)
            <tr align="center">
                <td>{{@$one->SKU}}</td>
                <td>{{@$one->title}}</td>
                <td>{{@$one->price}}</td>
                <td>{{@$one->quantity}}</td>
                <td>{{@$one->category->name}}</td>

            </tr>
        @endforeach

        <tr>
            <td colspan="7">
                <div class="total-part">
                    <div class="total-left w-85 float-left" align="right">
                        <p>Sub Total /<span>{{$order->ProductsTotal}}</span></p>
                        <p>discount price / <span>{{$order->discount_price}}</span></p>
                        <p> DeliveryCharges / <span>{{$order->DeliveryCharges}}</span></p>
                        <p>Total Payable /<span>{{$order->total}}</span></p>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </td>
        </tr>
    </table>
</div>
</html>
