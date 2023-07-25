<div class="modal fade" id="modalAdderssUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="closeModal" data-bs-dismiss="modal" aria-label="Close">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="modal-body ms-succ">
                <h5>Edit Address</h5>
                <form class="form-st form-address" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label>Address Name*</label>
                        <input type="text" class="form-control" placeholder="Enter Here"
                        name="address_name"
                               id="address_name"
                               value="">
                        @if ($errors->has('address_name'))
                            <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('address_name') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group selectBt">
                        <label>Country*</label>
                        <select class="form-control" name="country_id" id="country_id">
                            @foreach($countries as $one)
                                <option @if(old('country_id')) selected
                                        @endif value="{{$one->id}}">{{$one->name}}</option>
                            @endforeach
                            @if ($errors->has('country_id'))
                                <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('country_id') }}</strong>
                                    </span>
                            @endif
                        </select>

                    </div>
                    <div class="form-group">
                        <label>City*</label>
                        <select class="form-control" name="city_id" id="city_id">
                            @foreach($citys as $one)
                                <option @if(old('city_id')) selected @endif value="{{$one->id}}">{{$one->name}}</option>

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
                               name="street_descriptions" id="street_descriptions">
                        @if ($errors->has('street_descriptions'))
                            <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('street_descriptions') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Notes(Optional)</label>
                        <textarea class="form-control" placeholder="Enter Here" name="notes" id="notes"></textarea>
                        @if ($errors->has('notes'))
                            <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('notes') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <input type="hidden" id="addr_id">
                    <div class="form-group">
                        <button data-action="edit" type="submit" class="btn-site confirmAll"
                        ><span>update Address</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
