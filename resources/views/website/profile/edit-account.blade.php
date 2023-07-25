@extends('layout.siteLayout')

@section('content')
    <section class="edit_account_page stage_padding">
        <div class="container">
            <div class="row">
                @include('website.components.aside-profile')
                <div class="col-lg-8">
                    <div class="head-acco wow fadeInUp">
                        <h4>{{__('cp.EditAccount')}}</h4>
                    </div>
                    <form class="form-edit form-st wow fadeInUp" action="{{route('edit-profile')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>{{__('cp.FullName')}}*</label>
                            <input type="text" class="form-control" value="{{Auth('web')->user()->user_name}}"
                                   name="user_name">
                        </div>
                        <div class="form-group">
                            <label>{{__('cp.email')}}*</label>
                            <input type="email" class="form-email form-control" value="{{Auth('web')->user()->email}}"
                                   name="email">
                        </div>
                        <div class="form-group">
                            <label>{{__('cp.currency')}}*</label>
                                   <select class="form-control" name="currency">
                                    @foreach ($currencies->getIterator() as $currency) {
                                    <option value="{{ $currency->getCode() }}"
                                     @if (Auth('web')->user()->currency === $currency->getCode())
                                        selected
                                    @endif>
                                        {{ $currency->getCode() }}
                                    
                                    </option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="form-group">
                            <label>{{__('cp.mobile')}}*</label>
                            <div class="d-flex ds-mobail">
                                <input type="number" class="form-control" value="{{Auth('web')->user()->mobile}}"
                                       name="mobile">
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn-site"><span>{{__('cp.edit')}}</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--edit_account_page-->
@endsection
