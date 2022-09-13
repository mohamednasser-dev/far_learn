@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.conect_epo_with_daily_plan')}}</h5>
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
                    <th title="Field #1">{{trans('s_admin.episode_name')}}</th>
                    <th title="Field #1">{{trans('s_admin.type')}}</th>
                    <th title="Field #2">{{trans('s_admin.level')}}</th>
                    <th title="Field #3">{{trans('s_admin.subject')}}</th>
                    <th title="Field #3">{{trans('s_admin.subject_level')}}</th>
                    <th title="Field #7">{{trans('s_admin.creation_date')}}</th>
                    <th title="Field #7">{{trans('s_admin.connect_epo')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $row)
                    <tr>
                        <td>
                            @if(app()->getLocale() == 'ar')
                                {{$row->name_ar}}
                            @else
                                {{$row->name_en}}
                            @endif
                        </td>
                        <td>
                            @if($row->type == 'mqraa')
                                {{trans('s_admin.mqraa')}}
                            @elseif($row->type == 'mogmaa')
                                {{trans('s_admin.mogmaa')}}
                            @elseif($row->type == 'dorr')
                                {{trans('s_admin.dorr')}}
                            @endif
                        </td>
                        <td>
                            @if(app()->getLocale() == 'ar')
                                {{$row->Level->name_ar}}
                            @else
                                {{$row->Level->name_en}}
                            @endif
                        </td>
                        <td>
                            @if(app()->getLocale() == 'ar')
                                {{$row->Subject->name_ar}}
                            @else
                                {{$row->Subject->name_en}}
                            @endif
                        </td>
                        <td>
                            @if(app()->getLocale() == 'ar')
                                {{$row->Subject_level->name_ar}}
                            @else
                                {{$row->Subject_level->name_en}}
                            @endif
                        </td>
                        <td>{{$row->created_at->format('Y-m-d')}}</td>
                        <td class="text-right">
                            <a href="{{route('conect_subject_plan.show_plan',$row->id)}}" class="btn btn-success btn-circle">
                                {{trans('s_admin.daily_plan')}}
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
    <!-- Modal-->
    <div class="modal fade" id="exampleModalLong" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="t*ue">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.add_slider')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open( ['url' => ['sliders'],'method'=>'post', 'files'=>'true'] ) }}
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.title_ar')}}</label>
                            <div class="col-lg-8">
                                <input type="text" required class="form-control" placeholder="Enter full name" name="title_ar">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.title_en')}}</label>
                            <div class="col-lg-8">
                                <input type="text" required class="form-control" placeholder="Enter full name" name="title_en">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.desc_ar')}}</label>
                            <div class="col-lg-8">
                                <textarea name="desc_ar" required class="form-control" id="exampleTextarea" rows="3" placeholder="Please enter your message"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.desc_ar')}}</label>
                            <div class="col-lg-8">
                                <textarea name="desc_en" required class="form-control" id="exampleTextarea" rows="3" placeholder="Please enter your message"></textarea>
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.image')}} &nbsp;715*1920 </label>
                            <div class="col-lg-8">
                                <div class="uppy" id="kt_uppy_5">
                                    <div class="uppy-wrapper"><div class="uppy-Root uppy-FileInput-container"><input class="uppy-FileInput-input uppy-input-control" style="" type="file" name="image" multiple="" id="kt_uppy_5_input_control"><label class="uppy-input-label btn btn-light-primary btn-sm btn-bold" for="kt_uppy_5_input_control">{{trans('s_admin.choose_file')}}</label></div></div>
                                    <div class="uppy-list"></div>
                                    <div class="uppy-status"><div class="uppy-Root uppy-StatusBar is-waiting" aria-hidden="true"><div class="uppy-StatusBar-progress
                           " style="width: 0%;" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"></div><div class="uppy-StatusBar-actions"></div></div></div>
                                    <div class="uppy-informer uppy-informer-min"><div class="uppy uppy-Informer" aria-hidden="true"><p role="alert"> </p></div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{trans('s_admin.cancel')}}
                        </button>
                        <button type="submit" class="btn btn-primary font-weight-bold">{{trans('s_admin.save')}}</button>
                    </div>
                    {{ Form::close() }}
                </div>

            </div>
        </div>
    </div>
@endsection
