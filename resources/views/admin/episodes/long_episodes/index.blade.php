@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.nav_long_episode')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    </div>
@endsection
@section('content')
    <div class="card card-custom">
        <!--begin::Header-->
        <div class="card-header card-header-tabs-line">
            <ul class="nav nav-dark nav-bold nav-tabs nav-tabs-line" data-remember-tab="tab_id" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab"
                       href="#kt_builder_themes">{{trans('s_admin.current_requests')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#kt_builder_page">{{trans('s_admin.rejected_requests')}}</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content pt-3">
                <!--begin::Tab Pane-->
                <div class="tab-pane active" id="kt_builder_themes">
                    <!--begin: Datatable-->
                    <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                        <thead>
                        <tr>
                            <th title="Field #1">#</th>
                            <th title="Field #1">{{trans('s_admin.orders')}}</th>
                            <th title="Field #1">{{trans('s_admin.agree')}}</th>
                            <th title="Field #1">{{trans('s_admin.date')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $key => $row)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td> {{$row->message}} </td>
                                <td>
                                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{trans('s_admin.new_order')}}
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{route('episode.change_status_long_episodes',['id'=>$row->id,'status'=>'accepted'])}}">{{trans('s_admin.accept')}}</a>
                                        <a class="dropdown-item" href="{{route('episode.change_status_long_episodes',['id'=>$row->id,'status'=>'rejected'])}}">{{trans('s_admin.reject')}}</a>
                                    </div>
                                </td>
                                <td>{{$row->created_at->format('y-m-d g:i a')}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!--end: Datatable-->
                </div>
                <!--end::Tab Pane-->
                <!--begin::Tab Pane-->
                <div class="tab-pane" id="kt_builder_page">
                    <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                        <thead>
                        <tr>
                            <th title="Field #1">#</th>
                            <th title="Field #1">{{trans('s_admin.orders')}}</th>
                            <th title="Field #1">{{trans('s_admin.agree')}}</th>
                            <th title="Field #1">{{trans('s_admin.date')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rejected_data as $key => $row)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>
                                    {{$row->message}}
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{trans('s_admin.rejected')}}
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{route('episode.change_status_long_episodes',['id'=>$row->id,'status'=>'accepted'])}}">{{trans('s_admin.accept')}}</a>
                                    </div>
                                </td>
                                <td>{{$row->created_at->format('y-m-d g:i a')}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('metronic/assets/js/pages/custom/inbox/inbox.js')}}></script>
@endsection
