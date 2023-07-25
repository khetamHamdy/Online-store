@extends('layout.adminLayout')
@section('title')
    {{ucwords(__('cp.categories'))}}
@endsection
@section('css')

    <style>
        a:link {
            text-decoration: none;
        }
    </style>

@endsection
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <div class="d-flex align-items-baseline mr-5">
                        <h3>{{__('cp.edit')}} <span>{!! @$item->name !!}</span></h3>
                    </div>
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <a href="{{url(getLocal().'/admin/categories')}}"
                       class="btn btn-secondary  mr-2">{{__('cp.cancel')}}</a>
                    <button id="submitButton" class="btn btn-success ">{{__('cp.save')}}</button>
                </div>
                <!--end::Toolbar-->
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card card-custom gutter-b example example-compact">
                    <form method="post" action="{{url(app()->getLocale().'/admin/categories/'.$item->id)}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form" id="form">
                        {{ csrf_field() }}
                        {{ method_field('PATCH')}}
                        <div class="card-header">
                            <h3 class="card-title">{{__('cp.main_info')}}</h3>
                        </div>
                        <div class="row col-sm-12">
                            <div class="card-body">
                                <div class="row">

                                    {{--                                    <div class="col-md-6">--}}
                                    {{--                                        <div class="form-group">--}}
                                    {{--                                            <label> {{__('cp.status')}}</label>--}}
                                    {{--                                            <select class="form-control select2" id="roles" name="status"--}}
                                    {{--                                                    required>--}}
                                    {{--                                                @foreach($status as $key => $val)--}}
                                    {{--                                                    <option--}}
                                    {{--                                                        value="{{$key}}" {{$item->status==$key?'selected':''}}>{{$val}}</option>--}}
                                    {{--                                                @endforeach--}}
                                    {{--                                            </select>--}}
                                    {{--                                            @if ($errors->has('status'))--}}
                                    {{--                                                <span class="help-block">--}}
                                    {{--                                                    <strong>{{ $errors->first('status') }}</strong>--}}
                                    {{--                                                        </span>--}}
                                    {{--                                            @endif--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}

                                    @foreach($locales as $locale)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{__('cp.name')}} <span
                                                        class="text-danger"> {{$locale->name}} <span></label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="name_{{$locale->lang}}"
                                                       {{($locale->lang == 'ar') ? 'dir=rtl' :'' }}
                                                       value="{!! @$item->translate($locale->lang)->name!!}"
                                                       required/>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            {{--                            <div class="card-body col-md-12">--}}

                            {{--                                <div class="card-header">--}}
                            {{--                                    <h3 class="card-title">Attributes</h3>--}}
                            {{--                                </div>--}}
                            {{--                                <div class="task-list-item">--}}
                            {{--                                    @foreach($attributes as $one)--}}

                            {{--                                        <div class="row new-item align-items-center">--}}

                            {{--                                            <div class="col-md-6">--}}
                            {{--                                                <div class="form-group">--}}
                            {{--                                                    <label>Attribute <span--}}
                            {{--                                                            class="text-danger">*</span></label>--}}
                            {{--                                                    <div class="form-group">--}}
                            {{--                                                        <select class="form-control form-control-solid"--}}
                            {{--                                                                name="attributes[{{$one->name}}][attribute_id]"--}}
                            {{--                                                                required>--}}
                            {{--                                                            @foreach($attributes as $key)--}}
                            {{--                                                                <option value="{{$key->id}}"--}}
                            {{--                                                                        @if($one->name==$key->name) selected @endif>{{$key->name}}</option>--}}
                            {{--                                                            @endforeach--}}

                            {{--                                                        </select>--}}
                            {{--                                                    </div>--}}

                            {{--                                                </div>--}}
                            {{--                                            </div>--}}

                            {{--                                            <div class="col-md-4">--}}
                            {{--                                                <div class="form-group row">--}}
                            {{--                                                    <label--}}
                            {{--                                                        class=" col-form-label px-8">Is Required</label>--}}
                            {{--                                                    <span class="switch switch-icon">--}}
                            {{--                                                        <label>--}}
                            {{--                                                                <input type="checkbox"--}}
                            {{--                                                                       name="attributes[{{$one->name}}][{{'validation' ?? 'of'}}]"--}}
                            {{--                                                                            @if($one->CategoryAttributes[0]->is_required  =='on') {{'checked'}} @endif--}}
                            {{--                                                                >--}}
                            {{--                                                            <span></span>--}}

                            {{--                                                            {{ $one->CategoryAttributes[0]->is_required ?? 'default value'}}--}}
                            {{--                                                        </label>--}}
                            {{--                                                    </span>--}}

                            {{--                                                </div>--}}
                            {{--                                            </div>--}}
                            {{--                                            <div class="col-md-1">--}}
                            {{--                                                <a class="btn btn-outline-danger btn-icon btn-clean tooltips delete-new-item"--}}
                            {{--                                                   data-container="body"--}}
                            {{--                                                   data-placement="top"--}}
                            {{--                                                   data-parent-class="new-item"--}}
                            {{--                                                   data-original-title="Delete"><i--}}
                            {{--                                                        class="fa fa-trash"></i></a>--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="row new-item align-items-center">--}}
                            {{--                                        </div>--}}

                            {{--                                    @endforeach--}}
                            {{--                                </div>--}}
                            {{--                                <div class="row my-3">--}}
                            {{--                                    <div class="col-md-offset-3 col-md-9">--}}
                            {{--                                        <button type="button" id="add-option"--}}
                            {{--                                                class="btn btn-primary">Add New Item--}}
                            {{--                                        </button>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="card-body">--}}
                            {{--                                <div class="card-header">--}}
                            {{--                                    <h3 class="card-title">{{__('cp.attributes')}}</h3>--}}
                            {{--                                </div>--}}
                            {{--                                --}}{{-- {{$item->attributes}} --}}
                            {{--                                <div class="row">--}}
                            {{--                                    @foreach($attributes as $one)--}}

                            {{--                                        <div class="col-md-4">--}}
                            {{--                                            <div class="form-group row">--}}

                            {{--                                                <label for="{{$one->type}}"--}}
                            {{--                                                       class="col-6 col-form-label px-8">{{$one->name}}</label>--}}
                            {{--                                                <span class="switch switch-icon">--}}
                            {{--    												<label>--}}
                            {{--    													<input id="{{$one->type}}" type="checkbox"--}}
                            {{--                                                               name="attributes[]"--}}
                            {{--                                                               {{in_array($one->id,old('attributes',$item->attributes->pluck('attribute_id')->toArray())) ? "checked":"" }}--}}
                            {{--                                                               value="{{$one->id}}">--}}
                            {{--    													<span></span>--}}
                            {{--    												</label>--}}
                            {{--    											</span>--}}

                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                    @endforeach--}}
                            {{--                                </div>--}}

                            {{--                            </div>--}}
                            <div class="card-body col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('cp.image')}}</label>
                                            <div class="fileinput-new thumbnail"
                                                 onclick="document.getElementById('edit_image').click()"
                                                 style="cursor:pointer">
                                                <img src="{{asset($item->image)}}" id="editImage"
                                                     alt="">
                                            </div>
                                            <div class="btn red"
                                                 onclick="document.getElementById('edit_image').click()">
                                                <i class="fa fa-pencil"></i>
                                            </div>
                                            <input type="file" class="form-control" name="image"
                                                   id="edit_image" value="{{$item->image}}"
                                                   style="display:none">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" id="submitForm" style="display:none"></button>

                        </div>
                    </form>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>

@endsection
@section('js')
    <script>
        $('#edit_image').on('change', function (e) {
            readURL(this, $('#editImage'));
        });
        $(document).on('click', '#submitButton', function () {
            // $('#submitButton').addClass('spinner spinner-white spinner-left');
            $('#submitForm').click();
        });
    </script>

@endsection

{{--@section('script')--}}
{{--    <script>--}}

{{--        var index = 6--}}
{{--        $('#add-option').on('click', function () {--}}
{{--            $rows = `--}}

{{--  <div class="row new-item align-items-center">--}}

{{--            <div class="col-md-6">--}}
{{--                <div class="form-group">--}}
{{--                <label>Attribute <span--}}
{{--                    class="text-danger">*</span></label>--}}
{{--                <div class="form-group">--}}
{{--                    <select class="form-control form-control-solid"--}}
{{--                            name="attributes[${index}][attribute_id]"--}}
{{--                            required>--}}
{{--                   @foreach($attributes as $key)--}}
{{--            <option value="{{$key->id}}">{{$key->name}}</option>--}}
{{--                  @endforeach--}}
{{--            </select>--}}
{{--        </div>--}}

{{--</div>--}}
{{--</div>--}}


{{--<div class="col-md-4">--}}
{{--<div class="form-group row">--}}
{{--    <label class=" col-form-label px-8">Is Required</label>--}}
{{--            <span class="switch switch-icon">--}}
{{--        <label>--}}
{{--            <input type="checkbox"--}}
{{--                   name="attributes[${index}][validation]">--}}
{{--                    <span></span>--}}
{{--                </label>--}}
{{--            </span>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-1">--}}
{{--                <a class="btn btn-outline-danger btn-icon btn-clean tooltips delete-new-item"--}}
{{--                   data-container="body"--}}
{{--                   data-placement="top"--}}
{{--                   data-parent-class="new-item"--}}
{{--                   data-original-title="Delete"><i--}}
{{--                        class="fa fa-trash"></i></a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}


{{--            `;--}}
{{--            $('.task-list-item').append($rows);--}}
{{--            ++index;--}}
{{--        });--}}


{{--        $(document).on('click', '.delete-new-item', function () {--}}
{{--            // $(this).parents('.row_item').fadeOut(1000, () => $(this).remove()).remove();--}}
{{--            $(this).parents('.new-item').fadeOut(500, function () {--}}
{{--                $(this).remove();--}}
{{--            });--}}
{{--        });--}}

{{--    </script>--}}
{{--@endsection--}}
