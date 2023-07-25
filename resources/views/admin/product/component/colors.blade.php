<div class="flex-row-fluid ml-lg-8">
    <div class="card card-custom gutter-b example example-compact">

        <div class="card-header">
            <h3 class="card-title">{{__('cp.colors')}}</h3>

        </div>
        <div class="table-responsive">
            <table class="table table-hover tableWithSearch" id="tableWithSearch">
                <thead>
                <tr>
                    <th class="wd-1p no-sort">
                    </th>
                    <th class="wd-5p"> {{ucwords(__('name'))}}</th>
                    <th class="wd-5p"> {{ucwords(__('code'))}}</th>
                    <th class="wd-10p"> {{ucwords(__('created'))}}</th>
                    <th class="wd-10p"> {{ucwords(__('updated'))}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($item->colors as $one)
                    <tr class="odd gradeX" id="tr-{{$one->id}}">
                        <td class="v-align-middle wd-25p">{{$loop->iteration}}</td>
                        <td class="v-align-middle wd-25p">
                            {{$one->name}}
                        </td>
                        <td class="v-align-middle wd-25p">{{$one->code}}</td>
                        <td class="v-align-middle wd-10p">{{$one->created_at->format('Y-m-d') ?? ''}}</td>
                        <td class="v-align-middle wd-10p">{{$one->updated_at->format('Y-m-d') ?? ''}}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

