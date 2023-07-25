@extends('layout.adminLayout')
@section('title')
    {{ucwords(__('cp.categories'))}}
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
                        <h3>{{ucwords(__('cp.category'))}} / {{$item->name}}</h3>
                    </div>
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
                <div>

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
                <div class="gutter-b example example-compact">

                    <div class="contentTabel">

                        <div class="card-header d-flex flex-column flex-sm-row align-items-sm-start justify-content-sm-between">
                            <div>

                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover tableWithSearch" id="tableWithSearch">
                                <thead>
                                <tr>
                                    <th class="wd-1p no-sort">
                                        <div class="checkbox-inline">
                                            <label class="checkbox">
                                                <input type="checkbox" name="checkAll"/>
                                                <span></span></label>
                                        </div>
                                    </th>
                                    <th class="wd-5p"> ID</th>
                                    <th class="wd-25p"> {{ucwords(__('cp.image'))}}</th>
                                    <th class="wd-25p"> {{ucwords(__('cp.name'))}}</th>
                                    <th class="wd-25p"> {{ucwords(__('cp.category'))}}</th>
                                    <th class="wd-25p"> {{ucwords(__('cp.price'))}}</th>
                                    <th class="wd-10p"> {{ucwords(__('cp.status'))}}</th>
                                    <th class="wd-10p"> {{ucwords(__('cp.created'))}}</th>
                                    <th class="wd-15p"> {{ucwords(__('cp.action'))}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($items as $one)
                                    <tr class="odd gradeX" id="tr-{{$one->id}}">
                                        <td class="v-align-middle wd-5p">
                                            <div class="checkbox-inline">
                                                <label class="checkbox">
                                                    <input type="checkbox" value="{{$one->id}}" class="checkboxes"
                                                           name="chkBox"/>
                                                    <span></span></label>
                                            </div>
                                        </td>

                                        <td class="v-align-middle wd-25p">{{@$one->id}}</td>
                                        <td class="v-align-middle wd-5p"><img
                                                src="{{asset($one->image)}}" width="50px"
                                                height="50px"></td>
                                        <td class="v-align-middle wd-25p">{{$one->title}}</td>
                                        <td class="v-align-middle wd-25p">{{@$one->category->name}}</td>
                                        <td class="v-align-middle wd-25p">{{@$one->price}}</td>
                                        <td class="v-align-middle wd-10p"> <span id="label-{{$one->id}}" class="badge badge-pill badge-{{($one->status == "active")
                                            ? "info" : "danger"}}" id="label-{{$one->id}}">
                                            {{__('cp.'.$one->status)}}
                                      </span>
                                        </td>
                                        <td class="v-align-middle wd-10p">{{$one->created_at->format('Y-m-d')}}</td>

                                         <td class="v-align-middle wd-15p optionAddHours">
                                       
                                            <a href="{{ route('admin.product.show' ,$one->id) }}"
                                               class="btn btn-sm btn-clean btn-icon" title="{{__('cp.show')}}">
                                                <i class="la la-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty

                                @endforelse
                                </tbody>
                            </table>
                            {{$items->appends($_GET)->links("pagination::bootstrap-4") }}
                        </div>
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>

@endsection
@section('js')

@endsection

@section('script')

@endsection
