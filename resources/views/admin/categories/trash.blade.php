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
                        <h3>{{ucwords(__('cp.categories'))}}</h3>
                    </div>
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
                <div>
                    <div class="btn-group mb-2 m-md-3 mt-md-0 ml-2 ">

                    </div>
                    <a href="{{url(getLocal().'/admin/categories')}}" class="btn btn-secondary  mr-2 btn-info">
                                            <i class="icon-xl la la-arrow-left"></i>
                                            <span>{{__('cp.cancel')}}</span>
                                        </a>
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
                                        <td class="v-align-middle wd-25p">{!! $one->name !!}</td>
                                        <td class="v-align-middle wd-10p"> <span id="label-{{$one->id}}" class="badge badge-pill badge-{{($one->status == "active")
                                            ? "info" : "danger"}}" id="label-{{$one->id}}">
                                            {{__('cp.'.$one->status)}}
                                      </span>
                                        </td>
                                        <td class="v-align-middle wd-10p">{{$one->created_at->format('Y-m-d')}}</td>
                                        <td class="v-align-middle wd-15p optionAddHours">
                                            <a href="{{url(getLocal().'/admin/categories-restore/'.$one->id)}}"
                                               class="btn btn-sm btn-clean btn-icon" title="{{__('cp.restore')}}">
                                                <i class="la la-refresh"></i>
                                            </a>

                                            <a href="{{url(getLocal().'/admin/categories-forceDelete/'.$one->id)}}"
                                               class="btn btn-sm btn-clean btn-icon" title="{{__('cp.delete')}}">
                                                <i class="flaticon-delete"></i>
                                            </a>


                                        </td>
                                    </tr>

                                    <div id="myModal{{$one->id}}" class="modal fade" tabindex="-1" role="dialog"
                                         aria-labelledby="myModalLabel1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true"></button>
                                                    <h4 class="modal-title">{{__('cp.description')}}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        {!! $one->description !!}
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn default" data-dismiss="modal"
                                                            aria-hidden="true">{{__('cp.cancel')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
