@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.zoom_settings')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('episode.index')}}" class="text-muted">{{trans('s_admin.nav_electronic_chanel')}}</a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{trans('s_admin.zoom_settings')}}</h3>
                </div>
                <form action="{{route('create.web.meeting',$data->id)}}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{trans('s_admin.topic')}}</label>
                            <input required type="text" value="{{$data->name}}" name="topic" class="form-control form-control-lg" >
                        </div>
                        <div class="form-group">
                            <label>{{trans('s_admin.teacher_name')}}</label>
                            <input required type="text" name="agenda" value="{{$data->Teacher->user_name}}" class="form-control form-control-lg" >
                        </div>
                            <input required type="hidden" value="{{\Carbon\Carbon::now()}}" name="start_time" class="form-control form-control-lg" >
                    </div>
                    <div class="card-footer">
                        @if($data->join_url != null)
                            <button type="submit" class="btn btn-warning mr-2"  >{{trans('s_admin.edit_zoom')}}</button>
                        @else
                            <button type="submit" class="btn btn-primary mr-2"  >{{trans('s_admin.create_zoom')}}</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
        </div>
    </div>
    @if($data->join_url != null)
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <div class="card card-custom gutter-b example example-compact">
                    <div class="card-header">
                        <h3 class="card-title">{{trans('s_admin.details')}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{trans('s_admin.zoom_link')}}</label>
                            <br>
                            <span style="color: blue;">{{$data->join_url}}</span>
                        </div>
                        <div class="form-group">
                            <label>{{trans('s_admin.passcode')}}</label>
                            <span class="label label-info label-inline mr-2">{{$data->passcode}}</span>
                        </div>
                        <div class="form-group">
                            <label>{{trans('s_admin.meeting_id')}}</label>
                            <span class="label label-info label-inline mr-2">{{$data->meeting_id}}</span>
                        </div>
                        <div class="form-group">
                            <label>{{trans('s_admin.start_time')}}</label>
                            <span class="label label-info label-inline mr-2">{{$data->start_time}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
            </div>
        </div>
    @endif
@endsection
