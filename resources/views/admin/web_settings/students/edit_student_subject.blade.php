@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
            {{trans('s_admin.edit_student_subject')}}
        </h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{ URL::previous() }}" class="text-muted">
                    @if(request()->segment(2) == 'far_learn')
                        {{trans('s_admin.student_info')}}
                    @elseif(request()->segment(2) == 'mogmaa')
                        {{trans('s_admin.student_info')}}
                    @elseif(request()->segment(2) == 'dorr')
                        {{trans('s_admin.student_info')}}
                    @else
                        {{trans('s_admin.nav_student_shoan_settings')}}
                    @endif
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="javascript:void(0);" class="text-muted">{{trans('s_admin.nav_student_shoan_settings')}}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="javascript:void(0);" class="text-muted">{{trans('s_admin.nav_settings_control_panel')}}</a>
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
                    <h3 class="card-title">{{trans('s_admin.edit_student_subject')}}</h3>
                </div>
                <form class="form" method="post" action="{{route('student.place.subject')}}">
                    @csrf
                    <input type="hidden" required class="form-control" value="{{$data->id}}" name="id">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="exampleSelectl">{{trans('s_admin.level')}}</label>
                            @if($data->epo_type == 'far_learn')
                            {{ Form::select('level_id',App\Models\Level::where('type','far_learn')->where('deleted','0')->pluck('name_ar','id'),$data->level_id
                                    ,["class"=>"form-control form-control-lg","placeholder"=>trans('s_admin.choose_level'), "required" ,"id"=>"cmb_levels" ]) }}
                            @else
                                {{ Form::select('level_id',App\Models\Level::where('type','!=','far_learn')->where('deleted','0')->pluck('name_ar','id'),$data->level_id
                                    ,["class"=>"form-control form-control-lg","placeholder"=>trans('s_admin.choose_level'), "required" ,"id"=>"cmb_levels" ]) }}
                            @endif
                        </div>
                        <div class="form-group row" id="subject_cont">
                            <label for="exampleSelectl">{{trans('s_admin.subject')}}</label>
                            @php $subjects = App\Models\Subject::where('level_id',$data->level_id)->where('deleted','0')->get(); @endphp
                            <select required name="subject_id" class="form-control form-control-lg" id="cmb_subjects">
                                <option value="" selected>{{trans('s_admin.choose_subject')}}</option>
                                @foreach($subjects as $row)
                                    @if($data->subject_id == $row->id)
                                        @if(app()->getLocale() == 'ar')
                                            <option value="{{$row->id}}" selected>{{$row->name_ar}}
                                                &nbsp;&nbsp;&nbsp;{{$row->desc_ar}}</option>
                                        @else
                                            <option value="{{$row->id}}" selected>{{$row->name_en}}
                                                &nbsp;&nbsp;&nbsp;{{$row->desc_en}}</option>
                                        @endif
                                    @else
                                        @if(app()->getLocale() == 'ar')
                                            <option value="{{$row->id}}">{{$row->name_ar}}
                                                &nbsp;&nbsp;&nbsp;{{$row->desc_ar}}</option>
                                        @else
                                            <option value="{{$row->id}}">{{$row->name_en}}
                                                &nbsp;&nbsp;&nbsp;{{$row->desc_en}}</option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row" id="subject_level_cont">
                            <label for="exampleSelectl">{{trans('s_admin.subject_level')}}</label>
                            {{ Form::select('subject_level_id',App\Models\Subject_level::where('subject_id',$data->subject_id)->where('deleted','0')->pluck('name_ar','id'),
                                $data->subject_level_id,["class"=>"form-control form-control-lg", "required" ,"id"=>"cmb_subject_levels" ]) }}
                        </div>
                    </div>
                    <div class="card-footer" style=" text-align: center;">
                        <button type="submit" class="btn btn-primary mr-2">{{trans('s_admin.edit')}}</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/create_episode_ajax.js') }}"></script>
@endsection
