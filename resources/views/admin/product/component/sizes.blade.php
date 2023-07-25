<div class="flex-row-fluid ml-lg-8">
    <div class="card card-custom gutter-b example example-compact">

        <div class="card-header">
            <h3 class="card-title">{{__('cp.sizes')}}</h3>

        </div>
        <div class="table-responsive">
            <table class="table table-hover tableWithSearch" id="tableWithSearch">
                <thead>
                <tr>
                    <th class="wd-1p no-sort">

                    </th>
                    <th class="wd-5p"> {{ucwords(__('size'))}}</th>
                    <th class="wd-5p"> {{ucwords(__('status'))}}</th>
                    <th class="wd-10p"> {{ucwords(__('created'))}}</th>
                    <th class="wd-10p"> {{ucwords(__('updated'))}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($item->sizes as $one)
                    <tr class="odd gradeX" id="tr-{{$one->id}}">
                        <td class="v-align-middle wd-25p">{{$loop->iteration}}</td>
                        <td class="v-align-middle wd-25p">{{$one->size}}</td>
                        <td class="v-align-middle wd-10p">
                            <span id="label-{{$one->id}}" class="badge badge-pill badge-{{($one->status == "active")
                                            ? "info" : "danger"}}" id="label-{{$one->id}}">
                                            {{__('cp.'.$one->status)}}</span>
                        </td>
                        <td class="v-align-middle wd-10p">{{$one->created_at->format('Y-m-d') ?? ''}}</td>
                        <td class="v-align-middle wd-10p">{{$one->updated_at->format('Y-m-d') ?? ''}}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

