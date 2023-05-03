@extends('layout.exportPdfLayout')
@section('content')
    <tr>
        <th>ID</th>
        <th>@lang('cp.name')</th>
        <th>@lang('cp.email')</th>
        <th>@lang('cp.mobile')</th>
        <th>@lang('cp.status')</th>
        <th>@lang('cp.created')</th>
    </tr>
    @foreach($items as $one)
        <tr>
            <td>{{$one->id}}</td>
            <td>{{$one->user_name}}</td>
            <td>{{$one->email}}</td>
            <td>{{$one->mobile}}</td>
            <td>{{$one->status=='active'?__('cp.active') : __('cp.not_active')}}</td>
            <td>{{$one->created_at->format('Y-m-d')}}</td>

        </tr>
    @endforeach
@endsection
