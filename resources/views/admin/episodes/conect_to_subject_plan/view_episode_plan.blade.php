@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.daily_plan')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('episode.conect_subject_plan')}}" class="text-muted">{{trans('s_admin.conect_epo_with_daily_plan')}}</a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">{{trans('s_admin.the_new')}}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th title="Field #1">{{trans('s_admin.week')}}</th>
                            <th title="Field #2">{{trans('s_admin.day')}}</th>
                            <th title="Field #4">{{trans('s_admin.surah')}}</th>
                            <th title="Field #5">{{trans('s_admin.from')}}</th>
                            <th title="Field #6">{{trans('s_admin.surah')}}</th>
                            <th title="Field #7">{{trans('s_admin.to')}}</th>
                            <th title="Field #7">{{trans('s_admin.section_date')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($new as $row)
                            <tr>
                                <td>{{$row->Week->name_ar}}</td>
                                <td>{{$row->Day->name_ar}}</td>
                                <td>{{$row->From_Surah->name_ar}}</td>
                                <td>{{$row->from_num}}</td>
                                <td>{{$row->To_Surah->name_ar}}</td>
                                <td>{{$row->to_num}}</td>
                                @php $new_epo_data = \App\Models\Plan_episode_day::where('episode_id',$epo->id)->where('plan_id',$row->id)->where('plan_type','new')->first(); @endphp
                                <td>
                                    @if($new_epo_data != null)
                                        <a href="javascript:void(0);" class="btn font-weight-bold btn-light-primary" data-day-id="{{$new_epo_data->id}}" data-date-section="{{$new_epo_data->section_date}}"
                                           data-plan-type="new" id="update_new_btn"  data-toggle="modal" data-target="#update_new_modal">
                                            <i class="icon-xl-1x fas fa-pencil-alt"></i>
                                            {{$new_epo_data->section_date}}
                                        </a>
                                    @else
                                        <a href="javascript:void(0);" class="btn font-weight-bold btn-light-primary" data-plan-id="{{$row->id}}"
                                           data-plan-type="new" id="add_new_btn"  data-toggle="modal" data-target="#add_new_modal">
                                            {{trans('s_admin.choose_date')}}
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$new->links()}}
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">{{trans('s_admin.the_tracomy')}}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th title="Field #1">{{trans('s_admin.week')}}</th>
                            <th title="Field #2">{{trans('s_admin.day')}}</th>
                            <th title="Field #4">{{trans('s_admin.surah')}}</th>
                            <th title="Field #5">{{trans('s_admin.from')}}</th>
                            <th title="Field #6">{{trans('s_admin.surah')}}</th>
                            <th title="Field #7">{{trans('s_admin.to')}}</th>
                            <th title="Field #7">{{trans('s_admin.section_date')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tracomy as $row)
                            <tr>
                                <td>{{$row->Week->name_ar}}</td>
                                <td>{{$row->Day->name_ar}}</td>
                                <td>{{$row->From_Surah->name_ar}}</td>
                                <td>{{$row->from_num}}</td>
                                <td>{{$row->To_Surah->name_ar}}</td>
                                <td>{{$row->to_num}}</td>
                                @php $tracomy_epo_data = \App\Models\Plan_episode_day::where('episode_id',$epo->id)->where('plan_id',$row->id)->where('plan_type','tracomy')->first(); @endphp
                                <td>
                                    @if($tracomy_epo_data != null)
                                        <a href="javascript:void(0);" class="btn font-weight-bold btn-light-primary" data-day-id="{{$tracomy_epo_data->id}}" data-date-section="{{$tracomy_epo_data->section_date}}"
                                            id="update_new_btn"  data-toggle="modal" data-target="#update_new_modal">
                                            <i class="icon-xl-1x fas fa-pencil-alt"></i>
                                            {{$tracomy_epo_data->section_date}}
                                        </a>
                                    @else
                                        <a href="javascript:void(0);" class="btn font-weight-bold btn-light-primary" data-plan-id="{{$row->id}}"
                                           data-plan-type="tracomy" id="add_new_btn"  data-toggle="modal" data-target="#add_new_modal">
                                            {{trans('s_admin.choose_date')}}
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$tracomy->links()}}
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">{{trans('s_admin.revision')}}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th title="Field #1">{{trans('s_admin.week')}}</th>
                            <th title="Field #2">{{trans('s_admin.day')}}</th>
                            <th title="Field #4">{{trans('s_admin.surah')}}</th>
                            <th title="Field #5">{{trans('s_admin.from')}}</th>
                            <th title="Field #6">{{trans('s_admin.surah')}}</th>
                            <th title="Field #7">{{trans('s_admin.to')}}</th>
                            <th title="Field #7">{{trans('s_admin.section_date')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($revision as $row)
                            <tr>
                                <td>{{$row->Week->name_ar}}</td>
                                <td>{{$row->Day->name_ar}}</td>
                                <td>{{$row->From_Surah->name_ar}}</td>
                                <td>{{$row->from_num}}</td>
                                <td>{{$row->To_Surah->name_ar}}</td>
                                <td>{{$row->to_num}}</td>
                                @php $revision_epo_data = \App\Models\Plan_episode_day::where('episode_id',$epo->id)->where('plan_id',$row->id)->where('plan_type','revision')->first(); @endphp
                                <td>
                                    @if($revision_epo_data != null)
                                        <a href="javascript:void(0);" class="btn font-weight-bold btn-light-primary" data-day-id="{{$revision_epo_data->id}}" data-date-section="{{$revision_epo_data->section_date}}"
                                           id="update_new_btn"  data-toggle="modal" data-target="#update_new_modal">
                                            <i class="icon-xl-1x fas fa-pencil-alt"></i>
                                            {{$revision_epo_data->section_date}}
                                        </a>
                                    @else
                                        <a href="javascript:void(0);" class="btn font-weight-bold btn-light-primary" data-plan-id="{{$row->id}}"
                                           data-plan-type="revision" id="add_new_btn"  data-toggle="modal" data-target="#add_new_modal">
                                            {{trans('s_admin.choose_date')}}
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$revision->links()}}
                </div>
            </div>
        </div>
    </div>
    <!--begin:: Plan new add Modal-->
    <div class="modal fade" id="add_new_modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.choose_date_to_branch_epo')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <form class="form" action="{{route('conect_subject_plan.store')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="episode_id" value="{{$epo->id}}">
                        <input type="hidden" name="plan_id" id="txt_plan_id">
                        <input type="hidden" name="plan_type" id="txt_plan_type">
                        <div class="form-group row">
                            <label class="col-form-label text-right col-lg-3 col-sm-12">{{trans('s_admin.date')}}</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <div class="input-group date">
                                    <input type="text" required name="section_date"  class="form-control" id="kt_datepicker_3_modal" />
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-calendar"></i>
                                        </span>
                                    </div>
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
                <form class="form" action="{{route('conect_subject_plan.update')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="txt_day_id">
                        <div class="form-group row">
                            <label class="col-form-label text-right col-lg-3 col-sm-12">{{trans('s_admin.date')}}</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <div class="input-group date">
                                    <input type="text" required name="section_date" class="form-control" readonly="readonly" placeholder="Select date" id="kt_datepicker_2_modal" />
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-calendar-check-o"></i>
                                        </span>
                                    </div>
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
                $("#kt_datepicker_2_modal").val(selected_date);
            });
        });
    </script>
@endsection


