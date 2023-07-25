@extends('layout.adminLayout')
@section('title')
    {{ucwords(__('cp.products'))}}
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
                        <h3>{{__('cp.edit')}} {{@$item->name}}</h3>
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
                    <form method="post" action="{{url(app()->getLocale().'/admin/product/'.$item->id)}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form" id="form">
                        {{ csrf_field() }}
                        {{ method_field('PATCH')}}
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
                                                   {{($locale->lang == 'ar') ? 'dir=rtl' :'' }}
                                                   value="{!! @$item->translate($locale->lang)->title!!}"
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
                                                   {{($locale->lang == 'ar') ? 'dir=rtl' :'' }}
                                                   value="{!! @$item->translate($locale->lang)->description!!}"
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
                                                   name="price" value="{{$item->price}}" required/>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> {{__('cp.category')}}</label>
                                            <select class="form-control select2" id="role5" name="category_id"
                                                    required>
                                                   <option value=''> select</option>
                                                @foreach($categories as $categoryItem)
                                                    <option
                                                        value="{{$categoryItem->id}}"
                                                        {{  ($item->category_id == $categoryItem->id) ? 'selected' : '' }}>
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
                                            <select class="form-control select3" id="role10" name="brand_id"
                                                    required>
                                                    <option value=''> select</option>

                                                @foreach($brands as $brand)
                                                    <option
                                                        value="{{$brand->id}}"
                                                        {{$item->brand_id==$brand->id?'selected':''}}>
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
                                                          {{ (in_array($product->id, old('related_product_id', [])) || $item->relatedProducts->contains($product->id)) ? 'selected' : '' }}
                                                        >
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
                                                <input type="checkbox" id="is_quantity" value="{{$item->has_quantity}}"
                                                    {{$item->has_quantity== 'on' ? "checked" : ""}}  name="is_quantity"/>
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
                                                   name="quantity" value="{{$item->quantity}}" required/>
                                        </div>
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
                                            <input type="checkbox" value="{{$item->is_best_product}}"
                                                   {{$item->is_best_product === 'on' ? "checked" : ""}}  name="is_best_product"/>
                                            <span></span>
                                        </label>
                                        <!-- {{ $item->is_best_product }} -->
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
                                            <input type="checkbox" id="input_type_color" value="{{$item->has_color }}"
                                                   {{$item->has_color == 'on' ? "checked" : ""}}  name="has_color"/>
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
                                            <input type="checkbox" id="input_type_sizes" value=" {{$item->has_size}}"
                                                   {{$item->has_size== 'on' ? "checked" : ""}}  name="has_size"/>
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
                                            <input type="checkbox" id="input_additions" value="{{$item->has_additions}}"
                                                   {{$item->has_additions== 'on' ? "checked" : ""}}  name="has_additions"/>
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
                                            <select class="form-control select2" id="role" name="colors_id[]" multiple
                                            >

                                                @foreach($colors as $one)
                                                    <option
                                                        value="{{$one->id}}"
                                                        {{ (in_array($one->id, old('colors_id', [])) || $item->colors->contains($one->id)) ? 'selected' : '' }}>
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
                                            <select class="form-control select2" id="role2" name="sizes_id[]" multiple
                                            >

                                                @foreach($sizes as $one)
                                                    <option
                                                        value="{{$one->id}}"
                                                        {{ (in_array($one->id, old('sizes_id', [])) || $item->sizes->contains($one->id)) ? 'selected' : '' }}>
                                                        {{$one->size}}
                                                    </option>
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
                                               name="max_addition" value="{{$item->max_addition}}" required/>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('cp.required_addition')}}</label>
                                        <div>
                                    <span class="switch">
                                        <label>
                                            <input type="checkbox"
                                                   {{$item->required_addition == 'on' ? "checked" : ""}}  name="required_addition"/>
                                            <span></span>
                                        </label>
                                    </span>
                                        </div>
                                    </div>
                                </div>
                           </div>
                            <hr>
                                <div class="task-list-item">
                                    @foreach($additions as $one)
                                        <div class="row new-item align-items-center">
                                            <div class="col-md-1"><b> 1- </b></div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>{{__('cp.name_en')}} <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text"
                                                           class="form-control form-control-solid attachment_item "
                                                           name="options[0][name_en]"
                                                           value="{!! @$one->translate('en')->name!!}"/>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>{{__('cp.name_ar')}} <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text"
                                                           class="form-control form-control-solid attachment_item "
                                                           name="options[0][name_ar]"
                                                           value="{!! @$one->translate('ar')->name!!}"/>
                                                </div>
                                            </div>


                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>{{__('cp.price')}} <span class="text-danger">*</span></label>
                                                    <input type="number"
                                                           class="form-control form-control-solid attachment_item "
                                                           name="options[0][price]"
                                                           value="{{$one->price}}"/>
                                                </div>
                                            </div>


                                            <div class="col-md-1">
                                                <a class="btn btn-outline-danger btn-icon btn-clean tooltips delete-new-item"
                                                   data-container="body"
                                                   data-placement="top"
                                                   data-parent-class="new-item" data-id="{{$one->id}}"
                                                   data-original-title="{{__("cp.delete")}}"><i class="fa fa-trash"></i></a>
                                            </div>


                                        </div>
                                    @endforeach
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
                                            <img src="{{asset($item->image)}}" id="editImage" alt="">
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

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('cp.multi_images')}} </label>
                                        <div class="col-lg-9 col-xl-9">
                                            <input
                                                class="form-control form-control-solid form-control-lg"
                                                name="images[]" type="file" multiple id="multi_images"
                                                value="{{ $item->images }}"/>
                                        </div>

                                        <br>
                                        <table class="table table-hover tableWithSearch" id="tableWithSearch">
                                            @foreach($item->productImages as $one)

                                                <tr class="prod_image_tr">
                                                    <td class="v-align-middle wd-25p">
                                                        <img src="{{asset($one->image)}}"
                                                             style="height:70px ; width: 260px ; margin: 1rem">
                                                    </td>
                                                    <td class="v-align-middle wd-25p">
                                                        <button type="button"
                                                                class="deleteProductImageBtn btn btn-danger btn-sm text-white"
                                                                value="{{$one->id}}">Delete
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="gallery align-center p-5"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <button type="submit" id="submitForm" style="display:none"></button>

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

        $(document).ready(function () {

                has_quantity= $('#is_quantity').val();

            if (has_quantity === 'on') {
                $('.quantity').show();
            }else{
                    $('.quantity').hide();
            }

            v = $('#input_type_color').val();
            if (v === 'on') {
                $('.ColorsDiv').show();
            }
            ;

            v = $('#input_type_sizes').val();
            if (v === 'on') {
                $('.SizesDiv').show();
            }

            has_additions = $('#input_additions').val();

            if (has_additions === 'on') {
                $('.AdditionDiv').show();
            }else{
                    $('.AdditionDiv').hide();
            }

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
        })


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
            var id = $(this).data('id');
            $.ajax(
                {
                    method: 'GET',
                    url: "{{url('admin/additions-delete/')}}" + id,
                }
            );
            $(this).parents('.new-item').fadeOut(500, function () {
                $(this).remove();
            });
        });
    </script>

    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/super-build/ckeditor.js"></script>
    <script>
        @include('admin.settings.editor_script')
    </script>
@endsection
@section('script')
    <script>
        $(document).on('change', '#is_quantity', function () {

            if ($('#is_quantity').is(':checked')) {
                $('.quantity').show();
            } else {
                $('.quantity').hide();
            }
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {
            $(document).on('click', '.deleteProductImageBtn', function () {
                var product_image_id = $(this).val();
                var this_click = $(this);
                $.ajax({
                    type: "GET",
                    url: "/admin/" + "product-image/" + product_image_id + "/delete",
                    success: function (response) {
                        alert(response.message);
                        this_click.closest('.prod_image_tr').remove();
                    }
                })
            });
        })
    </script>

    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/super-build/ckeditor.js"></script>
    <script>
        @include('admin.settings.editor_script')
    </script>
@endsection

@section('script')

@endsection
