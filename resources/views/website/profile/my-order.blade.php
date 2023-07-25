@extends('layout.siteLayout')

@section('content')
    <section class="edit_account_page stage_padding">
        <div class="container">
            <div class="row">
                @include('website.components.aside-profile')
                <div class="col-lg-8">
                    <div class="head-acco wow fadeInUp">
                        <h4>My Orders</h4>
                    </div>
                    <div class="table-responsive-lg table-order wow fadeInUp">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Order ID</th>
                                <th>Items</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($items as $one)
                                <tr>
                                    <td>{{$one->created_at->format('d/m/Y')}}</td>
                                    <td>#{{$one->id}}</td>
                                    <td class="text-center">{{$one->items->count()}}</td>
                                    <td>{{$one->total}}</td>
                                    <td>
                                        <div class="status-order">
                                            <p>{{$one->payment_method==2 ? 'cache on pickup' :'online' }}</p>
                                            <a href="{{route('order_details',$one->id)}}"
                                               class="btn-site"><span>View</span></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--edit_account_page-->
@endsection

@section('js')
    <script>
        $(document).on('click', '#deleteAddress', function () {
            var id = $(this).data('id');
            alert(id)
            $.ajax(
                {
                    method: 'GET',
                    url: "{{url('address-delete/')}}" + id,
                }
            );
            $(this).parents('#item' + id).fadeOut(500, function () {
                $(this).remove();
            });
        });
    </script>
@endsection
