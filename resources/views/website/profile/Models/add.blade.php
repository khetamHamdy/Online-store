<div class="modal fade" id="modalAdderss" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="closeModal" data-bs-dismiss="modal" aria-label="Close">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="modal-body ms-succ">
                <h5>{{__('cp.AddAddress')}} </h5>
                <form class="form-st form-address" method="post" action="{{route('create_my_address')}}">
                    @csrf
                    <div class="form-group">
                        <label>{{__('cp.AddressName')}}* </label>
                        <input type="text" class="form-control" placeholder="Enter Here" name="address_name">
                    </div>
                    <div class="form-group selectBt">
                        <label>{{__('cp.Country')}}*</label>
                        <select class="form-control" name="country_id">
                            @foreach($countries as $one)
                                <option value="{{$one->id}}">{{$one->name}}</option>
                            @endforeach
                            @if ($errors->has('country_id'))
                                <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('country_id') }}</strong>
                                    </span>
                            @endif
                        </select>

                    </div>
                    <div class="form-group">
                        <label>{{__('cp.City')}}*</label>
                        <select class="form-control" name="city_id">
                            @foreach($citys as $one)
                                <option value="{{$one->id}}">{{$one->name}}</option>

                                @if ($errors->has('city_id'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('city_id') }}</strong>
                                    </span>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Block,Street, Building*</label>
                        <input type="text" class="form-control" placeholder="Enter Here"
                               name="street_descriptions">
                        @if ($errors->has('street_descriptions'))
                            <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('street_descriptions') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Notes(Optional)</label>
                        <textarea class="form-control" placeholder="Enter Here" name="notes"></textarea>
                        @if ($errors->has('notes'))
                            <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('notes') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button class="btn-site"><span>Add Address</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
