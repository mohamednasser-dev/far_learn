@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.nav_add_new_study_paln')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('subject_levels_daily_plan.show',$sub_level_id)}}"
                   class="text-muted">{{trans('s_admin.daily_plan')}}</a>
            </li>
            <li class="breadcrumb-item">
                @php $subject_level = \App\Models\Subject_level::find($sub_level_id); @endphp
                <a href="{{route('subject_levels.show',$subject_level->subject_id)}}"
                   class="text-muted">{{trans('s_admin.subject_levels')}} @if(app()->getLocale() == 'ar') ( {{$subject_level->name_ar}} ) @else ( {{$subject_level->name_en}} ) @endif</a>
            </li>
            <li class="breadcrumb-item">
                @php $subject = \App\Models\Subject::find($subject_level->subject_id); @endphp
                <a href="{{route('subjects.show',$subject->level_id)}}"
                   class="text-muted">{{trans('s_admin.nav_method')}} @if(app()->getLocale() == 'ar') ( {{$subject_level->Subject->name_ar}} )@else( {{$subject_level->Subject->name_en}} ) @endif</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('levels.index')}}" class="text-muted">{{trans('s_admin.nav_levels')}} @if(app()->getLocale() == 'ar')( {{$subject_level->Subject->Level->name_ar}} )@else( {{$subject_level->Subject->Level->name_en}} ) @endif </a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    @php $subject_level = \App\Models\Subject_level::where('id',$sub_level_id)->first(); @endphp
{{--    <div class="alert alert-custom alert-white alert-shadow fade show gutter-b" role="alert">--}}
{{--        <div class="alert-icon">--}}
{{--            <span class="svg-icon svg-icon-primary svg-icon-xl">--}}
{{--                <!--begin::Svg Icon | path:assets/media/svg/icons/Tools/Compass.svg-->--}}
{{--                <svg xmlns="http://www.w3.org/2000/svg"--}}
{{--                     xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"--}}
{{--                     viewBox="0 0 24 24" version="1.1">--}}
{{--                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--                        <rect x="0" y="0" width="24" height="24"></rect>--}}
{{--                        <path--}}
{{--                            d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z"--}}
{{--                            fill="#000000" opacity="0.3">--}}
{{--                        </path>--}}
{{--                        <path--}}
{{--                            d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z"--}}
{{--                            fill="#000000" fill-rule="nonzero">--}}
{{--                        </path>--}}
{{--                    </g>--}}
{{--                </svg>--}}
{{--                <!--end::Svg Icon-->--}}
{{--            </span>--}}
{{--        </div>--}}
{{--        <div class="alert-text">--}}
{{--            @if(app()->getLocale() =='ar')--}}
{{--                <a href="{{route('levels.index')}}"--}}
{{--                   class="card-title font-weight-bold text-muted text-hover-primary font-size-h5">--}}
{{--                    {{$subject_level->Subject->Level->name_ar}}--}}
{{--                </a>--}}
{{--            @else--}}
{{--                <a href="{{route('levels.index')}}"--}}
{{--                   class="card-title font-weight-bold text-muted text-hover-primary font-size-h5">--}}
{{--                    {{$subject_level->Subject->Level->name_en}}--}}
{{--                </a>--}}
{{--            @endif--}}

{{--            =>--}}
{{--            @if(app()->getLocale() =='ar')--}}
{{--                <a href="{{route('subjects.index')}}"--}}
{{--                   class="card-title font-weight-bold text-muted text-hover-primary font-size-h5">--}}
{{--                    {{$subject_level->Subject->name_ar}}--}}
{{--                </a>--}}
{{--            @else--}}
{{--                <a href="{{route('subjects.index')}}"--}}
{{--                   class="card-title font-weight-bold text-muted text-hover-primary font-size-h5">--}}
{{--                    {{$subject_level->Subject->name_en}}--}}
{{--                </a>--}}
{{--            @endif--}}

{{--            =>--}}

{{--            @if(app()->getLocale() =='ar')--}}
{{--                <a href="{{route('subject_levels.index')}}"--}}
{{--                   class="card-title font-weight-bold text-muted text-hover-primary font-size-h5">--}}
{{--                    {{$subject_level->name_ar}}--}}
{{--                </a>--}}
{{--            @else--}}
{{--                <a href="{{route('subject_levels.index')}}"--}}
{{--                   class="card-title font-weight-bold text-muted text-hover-primary font-size-h5">--}}
{{--                    {{$subject_level->name_en}}--}}
{{--                </a>--}}
{{--            @endif--}}
{{--        </div>--}}
{{--    </div>--}}
    @php
        $weeks = \App\Models\Plan\Plan_week::all();
        $days = \App\Models\Plan\Plan_day::all();
        $surah = \App\Models\Plan\Plan_surah::where('deleted','0')->get();
    @endphp
    <div class="row">
        <div class="col-md-4">
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{trans('s_admin.the_new')}}</h3>
                </div>
                {{ Form::open( ['id'=>'plan_new_form'] ) }}
                <input type="hidden" required name="_token" id="csrf" value="{{Session::token()}}">
                <div class="card-body">
                    <input type="hidden" required name="sub_level_id" id="sub_level_id" value="{{$sub_level_id}}">
                    <div class="form-group">
                        <label>{{trans('s_admin.week')}}
                            <span class="text-danger">*</span></label>
                        <div class="row">
                            <div class="col-md-10">
                                <select name="week_id" required id="week_id" class="form-control">
                                    @foreach($weeks as $row)
                                        <option value="{{$row->id}}">
                                            @if(app()->getLocale() == 'ar')
                                                {{$row->name_ar}}
                                            @else
                                                {{$row->name_en}}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <a data-dismiss="modal" data-toggle="modal" data-target="#add_new_week" data-toggle="tooltip" data-theme="dark" title="{{trans('s_admin.add_new_week')}}" class="btn btn-success" data-t>+</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelect1">{{trans('s_admin.day')}}
                            <span class="text-danger">*</span></label>
                        <select name="day_id" required id="day_id" class="form-control">
                            @foreach($days as $row)
                                <option value="{{$row->id}}">
                                    @if(app()->getLocale() == 'ar')
                                        {{$row->name_ar}}
                                    @else
                                        {{$row->name_en}}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <h4>{{trans('s_admin.surah')}}</h4>
                    <div class="form-group">
                        <label for="exampleSelect1">{{trans('s_admin.from')}}
                            <span class="text-danger">*</span>
                        </label>
                        <select name="from_surah" required class="form-control select2" id="kt_select2_4">
                            <option selected>{{trans('s_admin.choose_surah')}}</option>
                            @foreach($surah as $row)
                                <option value="{{$row->id}}">
                                    @if(app()->getLocale() == 'ar')
                                        {{$row->name_ar}}
                                    @else
                                        {{$row->name_en}}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-1" id="new_from_num_cont" style="display: none;">
                        <label for="exampleTextarea">{{trans('s_admin.aya_number')}}
                            <span class="text-danger">*</span></label>
                        <select required name="from_num" class="form-control form-control-lg" id="cmb_new_from_num">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelect1">{{trans('s_admin.to')}}
                            <span class="text-danger">*</span></label>
                        <select name="to_surah" required class="form-control select2" id="kt_select2_5">
                            <option selected>{{trans('s_admin.choose_surah')}}</option>
                            @foreach($surah as $row)
                                <option value="{{$row->id}}">
                                    @if(app()->getLocale() == 'ar')
                                        {{$row->name_ar}}
                                    @else
                                        {{$row->name_en}}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-1" id="new_to_num_cont" style="display: none;">
                        <label for="exampleTextarea">{{trans('s_admin.aya_number')}}
                            <span class="text-danger">*</span></label>
                        <select required name="to_num" class="form-control form-control-lg" id="cmb_new_to_num">
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary mr-2"
                            id="butsave_new">{{trans('s_admin.add')}}</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{trans('s_admin.the_tracomy')}}</h3>
                </div>
                {{ Form::open( ['id'=>'plan_tracomy_form'] ) }}
                <input type="hidden" required name="_token" id="csrf2" value="{{Session::token()}}">
                <div class="card-body">
                    <input type="hidden" required name="sub_level_id" id="sub_level_id2" value="{{$sub_level_id}}">
                    <div class="form-group">
                        <label>{{trans('s_admin.week')}}
                            <span class="text-danger">*</span></label>
                        <div class="row">
                            <div class="col-md-10">
                            <select name="week_id" required id="week_id2" class="form-control">
                                @foreach($weeks as $row)
                                    <option value="{{$row->id}}">
                                        @if(app()->getLocale() == 'ar')
                                            {{$row->name_ar}}
                                        @else
                                            {{$row->name_en}}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            </div>
                            <div class="col-md-2">
                                <a data-dismiss="modal" data-toggle="modal" data-target="#add_new_week" data-toggle="tooltip" data-theme="dark" title="{{trans('s_admin.add_new_week')}}" class="btn btn-success" data-t>+</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelect1">{{trans('s_admin.day')}}
                            <span class="text-danger">*</span></label>
                        <select name="day_id" required id="day_id2" class="form-control">
                            @foreach($days as $row)
                                <option value="{{$row->id}}">
                                    @if(app()->getLocale() == 'ar')
                                        {{$row->name_ar}}
                                    @else
                                        {{$row->name_en}}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <h4>{{trans('s_admin.surah')}}</h4>
                    <div class="form-group">
                        <label for="exampleSelect1">{{trans('s_admin.from')}}
                            <span class="text-danger">*</span>
                        </label>
                        <select name="from_surah" required class="form-control select2" id="kt_select2_1">
                            <option selected>{{trans('s_admin.choose_surah')}}</option>
                            @foreach($surah as $row)
                                <option value="{{$row->id}}">
                                    @if(app()->getLocale() == 'ar')
                                        {{$row->name_ar}}
                                    @else
                                        {{$row->name_en}}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-1" id="tracomy_from_num_cont" style="display: none;">
                        <label for="exampleTextarea">{{trans('s_admin.aya_number')}}
                            <span class="text-danger">*</span></label>
                        <select required name="from_num" class="form-control form-control-lg"
                                id="cmb_tracomy_from_num"></select>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelect1">{{trans('s_admin.to')}}
                            <span class="text-danger">*</span></label>
                        <select name="to_surah" required required class="form-control select2" id="kt_select2_2">
                            <option selected>{{trans('s_admin.choose_surah')}}</option>
                            @foreach($surah as $row)
                                <option value="{{$row->id}}">
                                    @if(app()->getLocale() == 'ar')
                                        {{$row->name_ar}}
                                    @else
                                        {{$row->name_en}}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-1" id="tracomy_to_num_cont" style="display: none;">
                        <label for="exampleTextarea">{{trans('s_admin.aya_number')}}
                            <span class="text-danger">*</span></label>
                        <select required name="to_num" class="form-control form-control-lg"
                                id="cmb_tracomy_to_num"></select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary mr-2"
                            id="butsave_tracomy">{{trans('s_admin.add')}}</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{trans('s_admin.revision')}}</h3>
                </div>
                {{ Form::open( ['id'=>'plan_revision_form'] ) }}
                <input type="hidden" required name="_token" id="csrf3" value="{{Session::token()}}">
                <div class="card-body">
                    <input type="hidden" required name="sub_level_id" id="sub_level_id3" value="{{$sub_level_id}}">
                    <div class="form-group">
                        <label>{{trans('s_admin.week')}}
                            <span class="text-danger">*</span></label>
                        <div class="row">
                            <div class="col-md-10">
                                <select name="week_id" required id="week_id3" class="form-control">
                                    @foreach($weeks as $row)
                                        <option value="{{$row->id}}">
                                            @if(app()->getLocale() == 'ar')
                                                {{$row->name_ar}}
                                            @else
                                                {{$row->name_en}}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <a data-dismiss="modal" data-toggle="modal" data-target="#add_new_week" data-toggle="tooltip" data-theme="dark" title="{{trans('s_admin.add_new_week')}}" class="btn btn-success" data-t>+</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelect1">{{trans('s_admin.day')}}
                            <span class="text-danger">*</span></label>
                        <select name="day_id" required id="day_id3" class="form-control">
                            @foreach($days as $row)
                                <option value="{{$row->id}}">
                                    @if(app()->getLocale() == 'ar')
                                        {{$row->name_ar}}
                                    @else
                                        {{$row->name_en}}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <h4>{{trans('s_admin.surah')}}</h4>
                    <div class="form-group">
                        <label for="exampleSelect1">{{trans('s_admin.from')}}
                            <span class="text-danger">*</span>
                        </label>
                        <select name="from_surah" required class="form-control select2" id="kt_select2_3">
                            <option selected>{{trans('s_admin.choose_surah')}}</option>
                            @foreach($surah as $row)
                                <option value="{{$row->id}}">
                                    @if(app()->getLocale() == 'ar')
                                        {{$row->name_ar}}
                                    @else
                                        {{$row->name_en}}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-1" id="revision_from_num_cont" style="display: none;">
                        <label for="exampleTextarea">{{trans('s_admin.aya_number')}}
                            <span class="text-danger">*</span></label>
                        <select required name="from_num" class="form-control form-control-lg"
                                id="cmb_revision_from_num"></select>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelect1">{{trans('s_admin.to')}}
                            <span class="text-danger">*</span></label>
                        <select name="to_surah" required required class="form-control select2" id="kt_select2_66">
                            <option selected>{{trans('s_admin.choose_surah')}}</option>
                            @foreach($surah as $row)
                                <option value="{{$row->id}}">
                                    @if(app()->getLocale() == 'ar')
                                        {{$row->name_ar}}
                                    @else
                                        {{$row->name_en}}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-1" id="revision_to_num_cont" style="display: none;">
                        <label for="exampleTextarea">{{trans('s_admin.aya_number')}}
                            <span class="text-danger">*</span></label>
                        <select required name="to_num" class="form-control form-control-lg"
                                id="cmb_revision_to_num"></select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary mr-2"
                            id="butsave_revision">{{trans('s_admin.add')}}</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

{{--    add new week--}}
    <div class="modal fade" id="add_new_week" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.add_new_week')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <form class="form" action="{{route('week.store')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>{{trans('s_admin.name_ar')}}<span class="text-danger">*</span></label>
                            <input class="form-control" name="name_ar" type="text">
                        </div>
                        <div class="form-group">
                            <label>{{trans('s_admin.name_en')}}<span class="text-danger">*</span></label>
                            <input class="form-control" name="name_en" type="text">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary mr-2" >{{trans('s_admin.save')}}</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('s_admin.cancel')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/create_subject_plan.js') }}"></script>
    <script>
        toastr.options = {
            "closeButton": false,
            "debug": true,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-full-width",
            "preventDuplicates": false,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    </script>
    <script>
        $(document).ready(function () {
            $('#butsave_new').on('click', function () {
                var week_id = $('#week_id').val();
                var day_id = $('#day_id').val();
                var from_surah_id = $('#kt_select2_4').val();
                var from_num = $('#cmb_new_from_num').val();
                var to_surah_id = $('#kt_select2_5').val();
                var to_num = $('#cmb_new_to_num').val();
                var sub_level_id = $('#sub_level_id').val();
                $.ajax({
                    url: "/plan/new/store",
                    type: "POST",
                    data: {
                        _token: $("#csrf").val(),
                        week_id: week_id,
                        day_id: day_id,
                        from_surah_id: from_surah_id,
                        from_num: from_num,
                        to_surah_id: to_surah_id,
                        to_num: to_num,
                        sub_level_id: sub_level_id
                    },
                    cache: false,
                    success: function (data_result) {
                        if (data_result.status == true) {
                            toastr.success(data_result.msg);
                        } else if (data_result.status == false) {
                            toastr.error(data_result.msg);
                        }
                    }
                });
            });
            $('#butsave_tracomy').on('click', function () {
                var week_id2 = $('#week_id2').val();
                var day_id2 = $('#day_id2').val();
                var from_surah_id2 = $('#kt_select2_1').val();
                var from_num2 = $('#cmb_tracomy_from_num').val();
                var to_surah_id2 = $('#kt_select2_2').val();
                var to_num2 = $('#cmb_tracomy_to_num').val();
                var sub_level_id2 = $('#sub_level_id2').val();
                $.ajax({
                    url: "/plan/tracomy/store",
                    type: "POST",
                    data: {
                        _token: $("#csrf2").val(),
                        week_id: week_id2,
                        day_id: day_id2,
                        from_surah_id: from_surah_id2,
                        from_num: from_num2,
                        to_surah_id: to_surah_id2,
                        to_num: to_num2,
                        sub_level_id: sub_level_id2
                    },
                    cache: false,
                    success: function (data_result) {
                        if (data_result.status == true) {
                            toastr.success(data_result.msg);
                        } else if (data_result.status == false) {
                            toastr.error(data_result.msg);
                        }
                    }
                });
            });
            $('#butsave_revision').on('click', function () {
                var week_id3 = $('#week_id3').val();
                var day_id3 = $('#day_id3').val();
                var from_surah_id3 = $('#kt_select2_3').val();
                var from_num3 = $('#cmb_revision_from_num').val();
                var to_surah_id3 = $('#kt_select2_66').val();
                var to_num3 = $('#cmb_revision_to_num').val();
                var sub_level_id3 = $('#sub_level_id3').val();
                $.ajax({
                    url: "/plan/revision/store",
                    type: "POST",
                    data: {
                        _token: $("#csrf3").val(),
                        week_id: week_id3,
                        day_id: day_id3,
                        from_surah_id: from_surah_id3,
                        from_num: from_num3,
                        to_surah_id: to_surah_id3,
                        to_num: to_num3,
                        sub_level_id: sub_level_id3
                    },
                    cache: false,
                    success: function (data_result) {
                        if (data_result.status == true) {
                            toastr.success(data_result.msg);
                        } else if (data_result.status == false) {
                            toastr.error(data_result.msg);
                        }
                    }
                });
            });
        });
    </script>
@endsection

