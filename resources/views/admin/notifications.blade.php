@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.see_all_notifications')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    </div>
@endsection
@section('content')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-body">
            <!--begin: Datatable-->
            <div class="table-responsive">

                <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{trans('s_admin.notify_title')}}</th>
                        <th>{{trans('s_admin.msg')}}</th>
                        <th>{{trans('s_admin.chooses')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $key => $row)
                        <tr>
                            <td>
                                {{$key + 1}}
                            </td>
                            <td>
                                @if(app()->getLocale() == 'ar')
                                    {{$row->title_ar}}
                                @else
                                    {{$row->title_en}}
                                @endif
                            </td>
                            <td>
                                @if(app()->getLocale() == 'ar')
                                    {{$row->message_ar}}
                                @else
                                    {{$row->message_en}}
                                @endif
                            </td>
                            <td>
                                @if($row->readed == '1')
                                    <a href="{{route('notification.change_readed',$row->id)}}" data-toggle="tooltip" data-theme="dark"  title="{{trans('s_admin.readed')}}"
                                       class="btn btn-icon btn-secondary btn-circle btn-sm mr-2">
                                        <i class="flaticon2-bell-4 text-success" aria-hidden='true'></i>
                                    </a>
                                @else
                                <a href="{{route('notification.change_readed',$row->id)}}" data-toggle="tooltip" data-theme="dark" title="{{trans('s_admin.un_readed')}}"
                                   class="btn btn-icon btn-secondary btn-circle btn-sm mr-2">
                                    <i class="flaticon2-bell-4 text-danger" aria-hidden='true'></i>
                                </a>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!--end: Datatable-->
        </div>
    </div>

@endsection
@section('scripts')

@endsection
