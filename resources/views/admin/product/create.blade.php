@extends('layout.adminLayout')
@section('title')
    {{ucwords(__('cp.products'))}}
@endsection
@section('css')
@endsection
@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <div class="d-flex align-items-baseline mr-5">
                        <h3>{{__('cp.add')}}</h3>
                    </div>
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <a href="{{url(getLocal().'/admin/product')}}"
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
                    <form method="post" action="{{url(app()->getLocale().'/admin/product')}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form" id="form">
                        {{ csrf_field() }}

                        <div class="card-header">
                            <h3 class="card-title">{{__('cp.main_info')}}</h3>
                        </div>

                        <div class="row col-sm-12">

                           <div class="card-body">

                            <div class="row">

                                    @foreach($locales as $locale)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{__('cp.name')}} <span
                                                        class="text-danger"> {{$locale->name}} <span></label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="title_{{$locale->lang}}"
                                                       {{($locale->lang == 'ar') ? 'dir=rtl' :'' }} value="{!! old('title_'.$locale->lang)!!}"
                                                       required/>
                                            </div>
                                        </div>
                                    @endforeach

                                    @foreach($locales as $locale)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{__('cp.description')}} <span
                                                        class="text-danger"> {{$locale->name}} <span></label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="description_{{$locale->lang}}"
                                                       {{($locale->lang == 'ar') ? 'dir=rtl' :'' }} value="{!! old('description_'.$locale->lang)!!}"
                                                       required/>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>

                            </div>

                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('cp.price')}}</label>
                                            <input type="number" class="form-control form-control-solid"
                                                   name="price" value="{{old('price')}}" required/>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> {{__('cp.category')}}</label>
                                            <select class="form-control select2" id="role5" name="category_id"
                                                    required>

                                                @foreach($categories as $categoryItem)
                                                    <option
                                                        value="{{$categoryItem->id}}"
                                                        {{old('category_id')==$categoryItem->id?'selected':''}}>
                                                        {{$categoryItem->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('category_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('category_id') }}</strong>
                                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> {{__('cp.brand')}}</label>
                                            <select class="form-control select3" id="role6" name="brand_id"
                                                    required>
                                             <option value=''></option>
                                                @foreach($brands as $brand)
                                                    <option
                                                        value="{{$brand->id}}"
                                                        {{old('brand_id')==$brand->id?'selected':''}}>
                                                        {{$brand->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('brand_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('brand_id') }}</strong>
                                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                            <label> {{__('cp.related_products')}}</label>
                                            <div class="form-group">
                                            <select class="form-control select9" id="role7" name="related_product_id[]" multiple>
                                                     <option value=''></option>
                                                @foreach($products as $product)
                                                    <option
                                                        value="{{$product->id}}"
                                                        {{old('related_product_id.'.$loop->index)==$product->id?'selected':''}}>
                                                        {{$product->title}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('related_product_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('related_product_id') }}</strong>
                                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label" >{{__('cp.is_quantity')}}</label>
                                                <div>
                                        <span class="switch">
                                            <label>
                                                <input type="checkbox" id="is_quantity"
                                                    {{old('is_quantity')== 'on' ? "checked" : ""}}  name="is_quantity"/>
                                                <span></span>
                                            </label>
                                        </span>
                                                </div>
                                            </div>
                                    </div>

                                        <div class="col-md-6 quantity" style="display:none">
                                        <div class="form-group">
                                            <label>{{__('cp.quantity')}}</label>
                                            <input type="number" class="form-control form-control-solid"
                                                   name="quantity" value="{{old('quantity')}}" required/>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-body col-md-12">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('cp.is_best_product')}}</label>
                                            <div>
                                    <span class="switch">
                                        <label>
                                            <input type="checkbox"
                                                   {{old('is_best_product')== 'on' ? "checked" : ""}}  name="is_best_product"/>
                                            <span></span>
                                        </label>
                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('cp.has_color')}}</label>
                                            <div>
                                    <span class="switch">
                                        <label>
                                            <input type="checkbox" id="input_type_color"
                                                   {{old('has_color') == 'on' ? "checked" : ""}}  name="has_color"/>
                                            <span></span>
                                        </label>
                                    </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('cp.has_size')}}</label>
                                            <div>
                                    <span class="switch">
                                        <label>
                                            <input type="checkbox" id="input_type_sizes"
                                                   {{old('has_size')== 'on' ? "checked" : ""}}  name="has_size"/>
                                            <span></span>
                                        </label>
                                    </span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('cp.has_additions')}}</label>
                                            <div>
                                    <span class="switch">
                                        <label>
                                            <input type="checkbox" id="input_additions"
                                                   {{old('has_additions')== 'on' ? "checked" : ""}}  name="has_additions"/>
                                            <span></span>
                                        </label>
                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="ColorsDiv" style="display:none">
                                    <div class="card-header ">
                                        <h3 class="card-title">{{__('cp.colors')}}</h3>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <select class="form-control select2" id="role" name="colors_id[]"
                                                        multiple>

                                                    @foreach($colors as $one)
                                                        <option
                                                            value="{{$one->id}}"
                                                            {{old('colors_id.'.$loop->index)==$one->id?'selected':''}}>
                                                            {{$one->name}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('colors_id'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('colors_id') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="SizesDiv" style="display:none">
                                    <div class="card-header ">
                                        <h3 class="card-title">{{__('cp.sizes')}}</h3>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <select class="form-control select2" id="role2" name="sizes_id[]"
                                                        multiple
                                                >

                                                    @foreach($sizes as $one)
                                                        <option
                                                            value="{{$one->id}}"
                                                            {{old('sizes_id.'.$loop->index)==$one->id?'selected':''}}>
                                                            {{$one->size}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('sizes_id'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('sizes_id') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="card-header AdditionDiv" style="display:none">
                                    <h3 class="card-title">{{__('cp.addition')}}</h3>
                                </div>

                                <div class="card-body AdditionDiv" style="display:none">
                                    <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('cp.max_addition')}}</label>
                                            <input type="number" class="form-control form-control-solid"
                                                   name="max_addition" value="{{old('max_addition')}}" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('cp.required_addition')}}</label>
                                            <div>
                                    <span class="switch">
                                        <label>
                                            <input type="checkbox"
                                                   {{old('required_addition') == 'on' ? "checked" : ""}}  name="required_addition"/>
                                            <span></span>
                                        </label>
                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                    <div class="task-list-item">
                                        <div class="row new-item align-items-center">
                                            <div class="col-md-1"><b> 1- </b></div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>{{__('cp.name_en')}} <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text"
                                                           class="form-control form-control-solid attachment_item "
                                                           name="options[0][name_en]"
                                                           value="{{old('options[0][name_en]')}}"/>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>{{__('cp.name_ar')}} <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text"
                                                           class="form-control form-control-solid attachment_item "
                                                           name="options[0][name_ar]"
                                                           value="{{old('options[0][name_ar]')}}"/>
                                                </div>
                                            </div>


                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>{{__('cp.price')}} <span class="text-danger">*</span></label>
                                                    <input type="number"
                                                           class="form-control form-control-solid attachment_item "
                                                           name="options[0][price]"
                                                           value="{{old('options[0][price]')}}"/>
                                                </div>
                                            </div>


                                            <div class="col-md-1">
                                                <a class="btn btn-outline-danger btn-icon btn-clean tooltips delete-new-item"
                                                   data-container="body"
                                                   data-placement="top"
                                                   data-parent-class="new-item"
                                                   data-original-title="{{__("cp.delete")}}"><i class="fa fa-trash"></i></a>
                                            </div>


                                        </div>

                                    </div>
                                    <div class="row my-3">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="button" id="add-option"
                                                    class="btn btn-primary">{{__('cp.add_new_item')}}</button>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('cp.image')}}</label>
                                            <div class="fileinput-new thumbnail"
                                                 onclick="document.getElementById('edit_image').click()"
                                                 style="cursor:pointer">
                                                <img src="{{choose()}}" id="editImage" alt="">
                                            </div>
                                            <div class="btn red"
                                                 onclick="document.getElementById('edit_image').click()">
                                                <i class="fa fa-pencil"></i>
                                            </div>
                                            <input type="file" class="form-control" name="image"
                                                   id="edit_image"
                                                   style="display:none">
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('cp.multi_images')}}</label>
                                            <input
                                                class="form-control form-control-solid form-control-lg"
                                                name="images[]" type="file" multiple id="multi_images"
                                                value="{{ old("images") }}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="gallery align-center p-5"></div>
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

        $(document).on('change', '#is_quantity', function () {

            if ($('#is_quantity').is(':checked')) {
                $('.quantity').show();
            } else {
                $('.quantity').hide();
            }
        });

        $(document).ready(function () {
            var index = 1

        });

        $(function () {
            // Multiple images preview in browser
            var imagesPreview = function (input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function (event) {
                            $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };

            $('#multi_images').on('change', function () {
                imagesPreview(this, 'div.gallery');
            });
        });
        $('#edit_image').on('change', function (e) {
            readURL(this, $('#editImage'));
        });

        $(document).on('click', '#submitButton', function () {
            // $('#submitButton').addClass('spinner spinner-white spinner-left');
            $('#submitForm').click();
        });

        $(document).on('change', '#input_type_color', function () {

            if ($('#input_type_color').is(':checked')) {
                $('.ColorsDiv').show();
            } else {
                $('.ColorsDiv').hide();
            }
            // if ($('#input_type_color').val() === 'on') {
            //     $('.ColorsDiv').show();
            // } else {
            //     $('.ColorsDiv').hide();
            // }
        });

        $(document).on('change', '#input_type_sizes', function () {

            if ($('#input_type_sizes').is(':checked')) {
                $('.SizesDiv').show();
            } else {
                $('.SizesDiv').hide();
            }
        });

        $(document).on('change', '#input_additions', function () {

            if ($('#input_additions').is(':checked')) {
                $('.AdditionDiv').show();
            } else {
                $('.AdditionDiv').hide();
            }
        });

        var index = 1
        $('#add-option').on('click', function () {
            $rows = `
             <div class="row new-item align-items-center">
                <div class="col-md-1"><b> ${index + 1}-  </b></div>
                <div class="col-md-3">
                   <div class="form-group">
                    <label>{{__('cp.name_en')}} <span class="text-danger">*</span></label>
                    <input type="text"
                           class="form-control form-control-solid attachment_item "
                           name="options[${index}][name_en]"
                           value=""/>
                     </div>
                </div>
                <div class="col-md-3">
                   <div class="form-group">
                    <label>{{__('cp.name_ar')}} <span class="text-danger">*</span></label>
                    <input type="text"
                           class="form-control form-control-solid attachment_item "
                           name="options[${index}][name_ar]"
                           value=""/>
                     </div>
                </div>

                             <div class="form-group">
                                    <label>{{__('cp.price')}} <span class="text-danger">*</span></label>
                                    <input type="number"
                                           class="form-control form-control-solid attachment_item "
                                           name="options[${index}][price]"
                                           value=""/>
                                </div>



                <div class="col-md-1">
                    <a class="btn btn-outline-danger btn-icon btn-clean tooltips delete-new-item" data-container="body"
                       data-placement="top"
                       data-parent-class="new-item"
                       data-original-title="{{__("cp.delete")}}" ><i class="fa fa-trash"></i></a>
                </div>
            </div>`;
            $('.task-list-item').append($rows);
            ++index;
        });


        $(document).on('click', '.delete-new-item', function () {
            // $(this).parents('.row_item').fadeOut(1000, () => $(this).remove()).remove();
            $(this).parents('.new-item').fadeOut(500, function () {
                $(this).remove();
            });
        });

    </script>

    </script>

    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/super-build/ckeditor.js"></script>
    <script>
        @include('admin.settings.editor_script')
    </script>
@endsection

@section('script')

@endsection
