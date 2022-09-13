@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.episode_dayes')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('episode.details',$epo->id)}}" class="text-muted">{{trans('s_admin.details')}}</a>
            </li>
            @if($epo->type == 'mqraa')
                <li class="breadcrumb-item">
                    <a  href="{{route('episode.show.type','mqraa')}}" class="text-muted">{{trans('s_admin.nav_far_epo')}}</a>
                </li>
            @elseif($epo->type =='mogmaa')
                <li class="breadcrumb-item">
                    <a  href="{{route('colleges.show',$epo->college_id)}}" class="text-muted">{{trans('s_admin.nav_electronic_chanel')}}</a>
                </li>
                <li class="breadcrumb-item">
                    <a  href="{{route('colleges.index')}}" class="text-muted">{{trans('s_admin.colleges')}}</a>
                </li>
            @elseif($epo->type =='dorr')
                <li class="breadcrumb-item">
                    <a  href="{{route('colleges.show',$epo->college_id)}}" class="text-muted">{{trans('s_admin.nav_electronic_chanel')}}</a>
                </li>
                <li class="breadcrumb-item">
                    <a  href="{{route('dorr.index')}}" class="text-muted">{{trans('s_admin.dorrs')}}</a>
                </li>

            @else
                <li class="breadcrumb-item">
                    <a  href="{{route('episode.show.type','mqraa')}}" class="text-muted">{{trans('s_admin.nav_electronic_chanel')}}</a>
                </li>
            @endif
        </ul>
    </div>
@endsection
@section('content')
    @php
        $weeks = \App\Models\Plan\Plan_week::all();
        $days = \App\Models\Plan\Plan_day::all();
        $surah = \App\Models\Plan\Plan_surah::where('deleted','0')->get();
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <a data-toggle="modal" data-target="#add_new_date"
                           class="btn btn-light-primary px-6 font-weight-bold">{{trans('s_admin.add_new_date')}}</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th title="Field #1">{{trans('s_admin.week')}}</th>
                            <th title="Field #2">{{trans('s_admin.day')}}</th>
                            <th title="Field #7">{{trans('s_admin.section_date')}}</th>
                            <th title="Field #7">{{trans('s_admin.delete')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $row)
                            <tr>
                                <td>{{$row->week_id}}</td>
                                <td>
                                    @if($row->day_id == 1)
                                        {{trans('s_admin.first')}}
                                    @elseif($row->day_id == 2)
                                        {{trans('s_admin.second')}}
                                    @elseif($row->day_id == 3)
                                        {{trans('s_admin.third')}}
                                    @elseif($row->day_id == 4)
                                        {{trans('s_admin.fourth')}}
                                    @elseif($row->day_id == 5)
                                        {{trans('s_admin.fifth')}}
                                    @elseif($row->day_id == 6)
                                        {{trans('s_admin.sixth')}}
                                    @elseif($row->day_id == 7)
                                        {{trans('s_admin.seventh')}}
                                    @endif
                                </td>
                                <td>
                                    <a href="javascript:void(0);" class="btn font-weight-bold btn-light-primary" data-day-id="{{$row->id}}" data-date-section="{{$row->date}}"
                                       data-plan-type="new" id="update_new_btn"  data-toggle="modal" data-target="#update_new_modal">
                                        <i class="icon-xl-1x fas fa-pencil-alt"></i>
                                        {{$row->date}}
                                    </a>
                                </td>
                                <td>
                                    <a onclick="return confirm('{{trans('s_admin.are_y_sure_delete')}}')" href="{{route('course_date.delete',$row->id)}}" class="btn btn-light-danger font-weight-bold mr-2">
                                        <i class="icon-md fas fa-trash" aria-hidden='true'></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$data->links()}}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add_new_date" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.choose_date_to_branch_epo')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <form class="form" action="{{route('course_date.store')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="episode_id" value="{{$epo->id}}">
                        <div class="form-group">
                            <label>{{trans('s_admin.week')}}<span class="text-danger">*</span></label>
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
                        <div class="form-group">
                            <label for="exampleSelect1">{{trans('s_admin.date')}}
                                <span class="text-danger">*</span></label>
                            <div class="input-group date">
                                <input type="text" required name="date"  class="form-control" id="kt_datepicker_3_modal" />
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-calendar"></i>
                                    </span>
                                </div>
                            </div>
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
    <!--begin:: Plan new edit Modal-->
    <div class="modal fade" id="update_new_modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.update_date_to_branch_epo')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <form class="form" action="{{route('course_date.update')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="txt_day_id">
                        <div class="form-group row">
                            <label class="col-form-label text-right col-lg-3 col-sm-12">{{trans('s_admin.date')}}</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <div class="input-group date">
                                    <input class="form-control" type="date" required name="section_date" id="example-date-input">
                                </div>
                            </div>
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
    <!--end::Modal-->
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $(document).on('click', '#add_new_btn', function() {
                plan_id = $(this).data('plan-id');
                plan_type = $(this).data('plan-type');
                $("#txt_plan_id").val(plan_id);
                $("#txt_plan_type").val(plan_type);
            });
            $(document).on('click', '#update_new_btn', function() {
                day_id = $(this).data('day-id');
                selected_date = $(this).data('date-section');
                $("#txt_day_id").val(day_id);
                $("#example-date-input").val(selected_date);
            });
        });
    </script>
@endsection


