@extends('layout.siteLayout')

@section('css')
    <style>
        .hide {
            display: none
        }
    </style>
@endsection

@section('title', $setting->title)

@section('content')

    @if (count($errors) > 0)
        <div class="container pt30">
            <div class="alert alert-custom alert-white alert-shadow gutter-b" role="alert">
                <div class="alert-text" style="color:red">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }} </p>
                    @endforeach
                </div>

            </div>
        </div>
    @endif

    @if (session('status'))
        <div class="container pt30">
            <div class="alert alert-custom alert-white alert-shadow gutter-b" style="border-color:green" role="alert">
                <div class="alert-text" style="color:green">
                    <p>{{  session('status')  }} </p>
                </div>
            </div>
        </div>
    @endif
    <section class="section_inner_page">
        <div class="container">
            <div class="sec_head">
                <h2>{{ __('web.Add your card details') }}</h2>
                <a href="/" class="logo-payment">
                    <img src="{{ url('uploads/stripe.png') }}" alt="Porto Logo" height="30">
                </a>
                <div class="sec_body sec--det">
                    <p>{{ __('cp.sub_total') }} : <span class="text-success">{{ $item->ProductsTotal }} KWD </span></p>
                    <p>{{ __('cp.discount') }} :<span class="text-success">{{ $item->discount_price }} KWD </span></p>
                    <p>{{ __('cp.total') }} :<span class="text-success">{{ $item->total }}KWD </span></p>
                </div>

            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="cont-get">
                        <div class="box_owner_services">
                            @if (Session::has('success'))
                                <div class="alert alert-primary text-center">
                                    <p>{{ Session::get('success') }}</p>
                                </div>
                            @endif

                            <form role="form" action="{{ route('postPayment', $token) }}" method="post"
                                  class="stripe-payment" data-cc-on-file="false"
                                  data-stripe-publishable-key="{{env('STRIPE_PUBLISHABLE_KEY')}}" id="stripe-payment">
                                @csrf

                                <div class='form-row row'>
                                    <div class='col-xs-12 form-group required'>
                                        <label class='control-label'>{{ __('cp.Name on Card') }}</label> <input
                                            class='form-control' size='4' type='text'>
                                    </div>
                                </div>

                                <div class='form-row row'>
                                    <div class='col-xs-12 form-group required'>
                                        <label class='control-label'>{{ __('cp.Card Number') }}</label> <input
                                            autocomplete='off' value="4242424242424242" class='form-control card-num'
                                            size='20' type='text'>
                                    </div>
                                </div>

                                <div class='form-row row'>
                                    <div class='col-xs-12 col-md-4 form-group cvc required'>
                                        <label class='control-label'>{{ __('CVC') }}</label>
                                        <input autocomplete='off' class='form-control card-cvc' placeholder='e.g 595'
                                               size='4' type='text'>
                                    </div>
                                    <div class='col-xs-12 col-md-4 form-group expiration required'>
                                        <label class='control-label'>{{ __('Expiration Month') }}</label> <input
                                            class='form-control card-expiry-month' placeholder='MM' size='2'
                                            type='text'>
                                    </div>
                                    <div class='col-xs-12 col-md-4 form-group expiration required'>
                                        <label class='control-label'>{{ __('Expiration Year') }}</label> <input
                                            class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                            type='text'>
                                    </div>
                                </div>

                                <div class='form-row row'>
                                    <div class='col-md-12 hide error form-group'>
                                        <div class='alert-danger alert'>{{ __('web.Fix the errors before you begin.') }}
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" value="{{ $item->id }}" name="ref_id">

<br>
                                <div class="row">
                                    <div class='col-md-12 form-group'>
                                        <button class="btn btn-success btn-site btn-block"
                                                type="submit"><span>{{ __('cp.pay') }}</span></button>
                                    </div>
                                </div>
                                <br>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script type="text/javascript">
        $(function () {
            var $form = $(".stripe-payment");
            $('form.stripe-payment').bind('submit', function (e) {
                var $form = $(".stripe-payment"),
                    inputVal = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'
                    ].join(', '),
                    $inputs = $form.find('.required').find(inputVal),
                    $errorStatus = $form.find('div.error'),
                    valid = true;
                $errorStatus.addClass('hide');

                $('.has-error').removeClass('has-error');
                $inputs.each(function (i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorStatus.removeClass('hide');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-num').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeRes);
                }

            });

            function stripeRes(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    var token = response['id'];
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

        });

    </script>

@endsection
