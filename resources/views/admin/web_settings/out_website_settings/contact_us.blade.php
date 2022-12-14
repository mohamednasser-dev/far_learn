@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.nav_contact_us')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    </div>
@endsection
@section('content')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-body">
            <!--begin: Datatable-->
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-checkable" id="kt_datatable_button2">
                    <thead>
                    <tr>
                        <th class="text-center" title="Field #1">{{trans('admin.name')}}</th>
                        <th class="text-center" title="Field #2">{{trans('admin.email')}}</th>
                        <th class="text-center" title="Field #3">{{trans('admin.phone')}}</th>
                        <th class="text-center" title="Field #3">{{trans('admin.message')}}</th>
                        <th class="text-center" title="Field #4">{{trans('s_admin.date')}}</th>
                        <th class="text-center" title="Field #4">{{trans('s_admin.block_user')}}</th>
                        <th class="text-center" title="Field #4">{{trans('s_admin.delete')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contacts as $key => $row)
                        <tr>
                            <td class="text-center">{{$row->name}}</td>
                            <td class="text-center">{{$row->email}}</td>
                            <td class="text-center">{{$row->phone}}</td>
                            <td class="text-center">{{$row->message}}</td>
                            <td class="text-center">{{$row->created_at->format('Y-m-d')}}</td>
                            <td class="text-center">
                                @php $exists_block =  \App\Models\BlockList::where('client_ip',$row->client_ip )->first(); @endphp
                                @if($exists_block)
                                    <lable>{{trans('s_admin.blocked')}}</lable>
                                    <a onclick="return confirm('{{trans('s_admin.are_y_sure_block')}}')"
                                       class="btn btn-primary "
                                       href="{{route('un_block.contact_us',$row->id)}}">
                                        <i class="icon-nm fas fa-ban" aria-hidden='true'></i>{{trans('s_admin.unblocked')}}
                                    </a>
                                @else
                                    <a onclick="return confirm('{{trans('s_admin.are_y_sure_block')}}')"
                                       class="btn btn-icon btn-warning btn-circle btn-sm mr-2" title=""
                                       href="{{route('block.contact_us',$row->id)}}">
                                        <i class="icon-nm fas fa-ban" aria-hidden='true'></i>
                                    </a>
                                @endif
                            </td>
                            <td>
                                <a onclick="return confirm('{{trans('s_admin.are_y_sure_delete')}}')"
                                   class="btn btn-icon btn-danger btn-circle btn-sm mr-2"
                                   href="{{route('delete.contact_us',$row->id)}}">
                                    <i class="icon-nm fas fa-trash" aria-hidden='true'></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            {{$contacts->links()}}
            <!--end: Datatable-->
            </div>
        </div>
    </div>
    <!--end::Card-->-
@endsection
