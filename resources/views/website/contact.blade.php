@extends('layout.siteLayout')
@section('content')
    <div class="banner-item" style="background: url({{asset($item->image)}});">
        <div class="container">
            <div class="txt-banner wow fadeInUp">
                <h3>{{$item->title}}</h3>
            </div>
        </div>
    </div>

    <section class="section_page_site">
        <div class="container">
            <div class="sec_head wow fadeInUp">
                <h2> {{__('cp.contact_us')}}</h2>
                <p>Booking request {{$setting->mobile}} or fill out the order form</p>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="thumb-reservation wow fadeInUp">
                        <img src="{{asset($item->image)}}" alt="Image"/>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="lst-contact">
                        <div class="item-contact wow fadeInUp">
                            <figure><i class="fa-solid fa-phone"></i></figure>
                            <div class="txt-contact">
                                <h5>{{__('cp.phone')}}</h5>
                                <p>{{$setting->mobile}} </p>
                            </div>
                        </div>
                        <div class="item-contact wow fadeInUp">
                            <figure><i class="fa-solid fa-envelope"></i></figure>
                            <div class="txt-contact">
                                <h5>{{__('cp.email')}}</h5>
                                <p>{{$setting->info_email}} </p>
                            </div>
                        </div>
                    </div>
                    <form class="wow fadeInUp" method="post"
                        action="#" >
                        @csrf

                        <div class="form-group">
                            <label>{{__('cp.name')}}</label>
                            <input type="text" class="form-control" placeholder="Write Here" name="name" id="name_id"/>
                            <span class="text-danger" id="name_error"></span>
                        </div>
                        <div class="form-group">
                            <label>{{__('cp.phone')}} </label>
                            <input type="text" class="form-control" placeholder="Write Here" name="phone"
                                   id="phone_id"/>
                            <span class="text-danger" id="phone_error"></span>

                        </div>

                         <div class="form-group">
                            <label>{{__('cp.email')}} </label>
                            <input type="email" class="form-control" placeholder="Write Here" name="email"
                                   id="email_id"/>
                            <span class="text-danger" id="email_error"></span>

                        </div>

                        <div class="form-group">
                            <label>{{__('cp.message')}} </label>
                            <textarea class="form-control" placeholder="Write Here" id="message_id"
                                      name="message"></textarea>
                            <span class="text-danger" id="message_error"></span>

                        </div>
                        <div class="form-group">
                            <button class="btn-site send_btn"><span>{{__('cp.send')}}</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--section_home-->

@endsection


@section('js')

    <script>

        $(document).on('click', '.send_btn', function (e) {

            e.preventDefault();
            let name = $('#name_id').val();
            let email = $('#email_id').val();
            let phone = $('#phone_id').val();
            let message = $('#message_id').val();

            $.ajax({
                url: {{route('contact.store')}},
                method: 'post',
                headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                data: {
                    name: name,
                    email: email,
                    phone: phone,
                    message: message,
                },
                success: function (response) {
                    alert('done');
                    $('form').trigger("reset");
                    swal.fire(response.message, 'Message', "success");
                },
                error: function (error) {
                    $('#name_error').text(error.responseJSON.errors.name);
                    $('#phone_error').text(error.responseJSON.errors.phone);
                    $('#email_error').text(error.responseJSON.errors.email);
                    $('#message_error').text(error.responseJSON.errors.message);
                }
            });

        });
    </script>
@endsection
