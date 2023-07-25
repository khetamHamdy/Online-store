@extends('layout.siteLayout')

@section('content')
    <section class="edit_account_page stage_padding">
        <div class="container">
            <div class="row">
                @include('website.components.aside-profile')
                <div class="col-lg-8">
                    <div class="head-acco wow fadeInUp">
                        <h4>{{__('cp.MyAddress')}}</h4>
                        <a class="btn-site btnSt" data-bs-toggle="modal" data-bs-target="#modalAdderss"><span>{{__('cp.NewAddress')}}</span></a>
                    </div>

                    <div class="cont-address wow fadeInUp">

                        <div class="row">
                            @foreach($items as $one)
                                <div class="  col-lg-6 mr-3" id="item-{{$one->id}}">
                                    <div class="item-addres wow fadeInUp">
                                        <input type="hidden" data-id="{{$one->id}}" class="item-address-id">
                                        <h6>{{$one->add_name}}</h6>
                                        <p>{{@$one->country->name}}</p>
                                        <p>{{@$one->city->name}}</p>
                                        <p>{{$one->street_descriptions}}</p>
                                        <p>{{$one->notes}}r</p>
                                        <ul>
                                            <li><a class="btnSt modalDelete delete_address" data-id="{{$one->id}}"
                                                   data-bs-toggle="modal" data-bs-target="#modalDelete"><i
                                                        class="fa-solid fa-trash-can"></i></a></li>
                                            <li><a class="btnSt edit_address" data-bs-toggle="modal"
                                                   data-id="{{$one->id}}"
                                                   data-bs-target="#modalAdderssUpdate"><i
                                                        class="fa-solid fa-pen"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--edit_account_page-->

@endsection

@section('model')
    @include('website.profile.Models.add')
    @include('website.profile.Models.delete')
    @include('website.profile.Models.update' )
@endsection

@section('js')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script>
        $(document).on('click', '.delete_address', function () {
            var ID = $(this).data('id');
            $.ajax({
                dataType: "json",
                url: "/address/" + ID + "/delete",
                data: {id: ID},
                success: function (data) {
                    $('#addr_id').val(data.result.id);
                },
                fail: function (e) {
                    alert(e);
                }
            });
        });

        //show data in form edit
        $(document).on('click', '.edit_address', function () {
            var ID = $(this).data('id');
            $.ajax({
                dataType: "json",
                url: "/address/" + ID + "/edit",
                data: {id: ID},
                success: function (data) {
                    $('#address_name').val(data.result.add_name);
                    $('#country_id').val(data.result.country_id);
                    $('#city_id').val(data.result.city_id);
                    $('#street_descriptions').val(data.result.street_descriptions);
                    $('#notes').val(data.result.notes);
                    $('#addr_id').val(data.result.id);
                    $('#modalAdderssUpdate').model('show');

                },
                fail: function (e) {
                    alert(e);
                }
            });
        });

        $('.confirmAll').on('click', function (e) {
            e.preventDefault();
            var action = $(this).data('action');

            var url = "{{ url('changeStatusAddress') }}";
            var csrf_token = '{{csrf_token()}}';

            ID = $('#addr_id').val();

            var address_name = $('#address_name').val();
            var country_id = $('#country_id').val();
            var city_id = $('#city_id').val();
            var street_descriptions = $('#street_descriptions').val();
            var notes = $('#notes').val();

            $.ajax({
                type: 'POST',
                headers: {'X-CSRF-TOKEN': csrf_token},
                url: url,
                data: {
                    action: action, ID: ID, _token: csrf_token,
                    address_name: address_name, country_id: country_id,
                    city_id: city_id, street_descriptions: street_descriptions,
                    notes: notes
                },
                success: function (response) {
                    if (response === 'delete') {
                        alert("delete Successfully")
                        $('#item-' + ID).hide(1000);
                        $('#modalDelete').modal('hide');
                    }
                    if (response === 'edit') {
                        alert("Edit Successfully")
                        $('#modalAdderssUpdate').modal('hide');
                        swal.fire("Done!", "Edit Successfully", "success");
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    }
                    IDArray = [];
                },
                fail: function (e) {
                    alert(e);
                }
            });

        });
    </script>

    <script>

        $(document).on('click', '#close_delete_modal', function () {
            $('#modalDelete').modal('hide');
        });
    </script>
@endsection
