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
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                <thead>
                <tr>
                    <th title="Field #1">#</th>
                    <th title="Field #1">{{trans('admin.name')}}</th>
                    <th title="Field #2">{{trans('admin.email')}}</th>
                    <th title="Field #3">{{trans('admin.phone')}}</th>
                    <th title="Field #3">{{trans('admin.message')}}</th>
                    <th title="Field #4">{{trans('s_admin.date')}}</th>
                    <th title="Field #4">{{trans('s_admin.block_user')}}</th>
                    <th title="Field #4">{{trans('s_admin.delete')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($contacts as $key => $blog)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$blog->name}}</td>
                        <td>{{$blog->email}}</td>
                        <td>{{$blog->phone}}</td>
                        <td>{{$blog->message}}</td>
                        <td>{{$blog->created_at->format('Y-m-d')}}</td>
                        <td>
                            <a onclick="return confirm('{{trans('s_admin.are_y_sure_block')}}')" class="btn btn-icon btn-warning btn-circle btn-sm mr-2"
                               href="{{route('block.contact_us',$blog->id)}}">
                                <i class="icon-nm fas fa-ban" aria-hidden='true'></i>
                            </a>
                        </td>
                        <td>
                            <a onclick="return confirm('{{trans('s_admin.are_y_sure_delete')}}')" class="btn btn-icon btn-danger btn-circle btn-sm mr-2"
                               href="{{route('delete.contact_us',$blog->id)}}">
                                <i class="icon-nm fas fa-trash" aria-hidden='true'></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!--end: Datatable-->
        </div>
    </div>
    <!--end::Card-->-
@endsection
