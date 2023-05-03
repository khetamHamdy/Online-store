@extends('layout.adminLayout')
@section('title') {{ucwords(__('cp.roles'))}}
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
                            <h3>{{__('cp.edit')}}</h3>
                        </div>
                    </div>
                    <!--end::Info-->
                    <!--begin::Toolbar-->
                    <div class="d-flex align-items-center">
                        <a  href="{{url(getLocal().'/admin/roles')}}"  class="btn btn-secondary  mr-2">{{__('cp.cancel')}}</a>
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
                        <form class="form" method="post" action="{{url(app()->getLocale().'/admin/roles/'.$item->id)}}" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            {{ method_field('PATCH')}}
                            <div class="card-header">
                                <h3 class="card-title">Main Data</h3>
                            </div>
                             <div class="card-body">
                                <div class="row ">
                                    @foreach($locales as $locale)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('cp.name_'.$locale->lang)}}</label>
                                            <input type="text" class="form-control form-control-solid" {{($locale->lang == 'ar') ? 'dir=rtl' :'' }}   name="name_{{$locale->lang}}" value="{{ @$item->translate($locale->lang)->name}}" required />
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                                 <div class="card-body">
                                <div class="card-header">
                                <h3 class="card-title">{{__('cp.permissions')}}</h3>
                                </div>
                                <div class="row">
                                   @foreach($permissions as $permission)
                                        <div class="col-md-3">
                                            <div class="form-group row">
                                                <label for="{{$permission->slug}}" class="col-6 col-form-label px-8">{{$permission->name}}</label>
                                                <span class="switch switch-icon">
    												<label>
    													<input id="{{$permission->slug}}" type="checkbox" name="permissions[]"{{in_array($permission->id,old('permissions',$item->permissions->pluck('permission_id')->toArray())) ? "checked":"" }}
                                                          value="{{$permission->id}}"
                                                        >
    													<span></span>
    												</label>
    											</span>

                                            </div>
                                        </div>
                                @endforeach
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
        $('#edit_image').on('change', function (e) {
            readURL(this, $('#editImage'));
        });
        $(document).on('click', '#submitButton', function(){
           // $('#submitButton').addClass('spinner spinner-white spinner-left');
        $('#submitForm').click();
    });
</script>
@endsection

@section('script')

@endsection
