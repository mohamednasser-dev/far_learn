@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.edit_daily_plan')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('subject_levels_daily_plan.show',$data->sub_level_id)}}" class="text-muted">{{trans('s_admin.daily_plan')}}</a>
            </li>
            <li class="breadcrumb-item">
                @php $subject_level = \App\Models\Subject_level::find($data->sub_level_id); @endphp
                <a href="{{route('subject_levels.show',$subject_level->subject_id)}}" class="text-muted">{{trans('s_admin.subject_levels')}}</a>
            </li>
            <li class="breadcrumb-item">
                @php $subject = \App\Models\Subject::find($subject_level->subject_id); @endphp
                <a href="{{route('subjects.show',$subject->level_id)}}" class="text-muted">{{trans('s_admin.nav_method')}}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('levels.index')}}" class="text-muted">{{trans('s_admin.nav_levels')}}</a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    @php $weeks = \App\Models\Plan\Plan_week::all(); @endphp
    @php $days = \App\Models\Plan\Plan_day::all(); @endphp
    @php $surah = \App\Models\Plan\Plan_surah::where('deleted','0')->get(); @endphp
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{trans('s_admin.edit_daily_plan')}}</h3>
                </div>
                <form class="form" method="post" action="{{route('plan.update')}}">
                @csrf
                <input type="hidden" required name="type" value="{{$type}}">
                <input type="hidden" required name="sub_level_id" value="{{$data->sub_level_id}}">
                <input type="hidden" required name="id" value="{{$data->id}}">
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>{{trans('s_admin.week')}}</label>
                            <h4> @if(app()->getLocale() == 'ar')
                                    {{$data->Week->name_ar}}
                                @else
                                    {{$data->Week->name_en}}
                                @endif
                            </h4>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleSelect1">{{trans('s_admin.day')}}</label>
                            <h4> @if(app()->getLocale() == 'ar')
                                    {{$data->Day->name_ar}}
                                @else
                                    {{$data->Day->name_en}}
                                @endif
                            </h4>
                        </div>
                    </div>
                    <h4>{{trans('s_admin.surah')}}</h4>
                    <div class="form-group">
                        <label for="exampleSelect1">{{trans('s_admin.from')}}
                            <span class="text-danger">*</span>
                        </label>
                        <select name="from_surah_id" required class="form-control select2" id="kt_select2_1">
                            @foreach($surah as $row)
                                @if($row->id == $data->from_surah_id)
                                    <option value="{{$row->id}}" selected>
                                        @if(app()->getLocale() == 'ar')
                                            {{$row->name_ar}}
                                        @else
                                            {{$row->name_en}}
                                        @endif
                                    </option>
                                @else
                                    <option value="{{$row->id}}">
                                        @if(app()->getLocale() == 'ar')
                                            {{$row->name_ar}}
                                        @else
                                            {{$row->name_en}}
                                        @endif
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-1" id="tracomy_from_num_cont">
                        <label for="exampleTextarea">{{trans('s_admin.aya_number')}}
                            <span class="text-danger">*</span></label>
                        <select required name="from_num" class="form-control form-control-lg" id="cmb_tracomy_from_num">
                            @foreach($to_numbers as $row)
                                @if($row == $data->from_num)
                                    <option value="{{$row}}" selected>{{$row}}</option>
                                @else
                                <option value="{{$row}}">{{$row}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelect1">{{trans('s_admin.to')}}
                            <span class="text-danger">*</span></label>
                        <select name="to_surah_id" required required class="form-control select2" id="kt_select2_2">
                            @foreach($surah as $row)
                                @if($row->id == $data->to_surah_id)
                                    <option value="{{$row->id}}" selected>
                                        @if(app()->getLocale() == 'ar')
                                            {{$row->name_ar}}
                                        @else
                                            {{$row->name_en}}
                                        @endif
                                    </option>
                                @else
                                    <option value="{{$row->id}}">
                                        @if(app()->getLocale() == 'ar')
                                            {{$row->name_ar}}
                                        @else
                                            {{$row->name_en}}
                                        @endif
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-1" id="tracomy_to_num_cont">
                        <label for="exampleTextarea">{{trans('s_admin.aya_number')}}
                            <span class="text-danger">*</span></label>
                        <select required name="to_num" class="form-control form-control-lg" id="cmb_tracomy_to_num">
                            @foreach($to_numbers as $row)
                                @if($row == $data->to_num)
                                    <option value="{{$row}}" selected>{{$row}}</option>
                                @else
                                    <option value="{{$row}}">{{$row}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-footer" style=" text-align: center;">
                    <button type="submit" class="btn btn-primary mr-2" id="butsave_tracomy">{{trans('s_admin.edit')}}</button>
                </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/create_subject_plan.js') }}"></script>
@endsection

