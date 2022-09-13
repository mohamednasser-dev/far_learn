@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.evaluation_info')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('subjects.show',$subject_data->level_id)}}"
                   class="text-muted">{{trans('s_admin.nav_subjects')}} @if(app()->getLocale() == 'ar') ( {{$subject_data->name_ar}} ) @else( {{$subject_data->name_en}} ) @endif</a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    <div class="row">
        <a href="{{route('subjects.show',$subject_data->level_id)}}" class="btn btn-success">{{trans('s_admin.back')}}</a>
    </div>
    <br>
    <div class="row">
        <div class="col-md-4">
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{trans('s_admin.evaluate_daily')}}</h3>
                </div>
                <form class="form" method="post" action="{{route('subject_evaluation.store')}}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{trans('s_admin.subject')}}</label>
                            @if(app()->getLocale() == 'ar')
                                <h4>{{$subject_data->name_ar}}</h4>
                            @else
                                <h4>{{$subject_data->name_en}}</h4>
                            @endif
                            <input required type="hidden" name="subject_id" value="{{$subject_data->id}}">
                            <input required type="hidden" name="type" value="daily">
                        </div>
                        <div class="form-group">
                            <label>{{trans('s_admin.highest_wrong_num')}}</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <input required type="number"
                                           @if($data_daily != null) value="{{$data_daily->highest_rate}}"
                                           @endif  name="highest_rate" min="0" class="form-control form-control-lg">
                                </div>
                                <div class="col-md-2">
                                    <label>({{trans('s_admin.one_error')}})</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <h4>{{trans('s_admin.the_evaluation')}}</h4>
                        <div class="form-group">
                            <label>{{trans('s_admin.excellent')}}</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <input required type="number" name="excellent"
                                           @if($data_daily != null) value="{{$data_daily->excellent}}"
                                           @endif  min="0" class="form-control form-control-lg">
                                </div>
                                <div class="col-md-2">
                                    <label>({{trans('s_admin.one_error')}})</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{trans('s_admin.very_good')}}</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <input required type="number" name="very_good"
                                           @if($data_daily != null) value="{{$data_daily->very_good}}"
                                           @endif  min="0" class="form-control form-control-lg">
                                </div>
                                <div class="col-md-2">
                                    <label>({{trans('s_admin.one_error')}})</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{trans('s_admin.good')}}</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <input required type="number" name="good"
                                           @if($data_daily != null) value="{{$data_daily->good}}" @endif  min="0"
                                           class="form-control form-control-lg">
                                </div>
                                <div class="col-md-2">
                                    <label>({{trans('s_admin.one_error')}})</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{trans('s_admin.not_pathing')}}</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <input required type="number" name="not_pathing"
                                           @if($data_daily != null) value="{{$data_daily->not_pathing}}"
                                           @endif  min="0" class="form-control form-control-lg">
                                </div>
                                <div class="col-md-2">
                                    <label>({{trans('s_admin.one_error')}})</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
{{--                        @can("add")--}}
                        <button type="submit" class="btn btn-success mr-2">{{trans('s_admin.save')}}</button>
{{--                            @endcan--}}
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{trans('s_admin.evaluate_tracomy')}}</h3>
                </div>
                <form class="form" method="post" action="{{route('subject_evaluation.store')}}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{trans('s_admin.subject')}}</label>
                            @if(app()->getLocale() == 'ar')
                                <h4>{{$subject_data->name_ar}}</h4>
                            @else
                                <h4>{{$subject_data->name_en}}</h4>
                            @endif
                            <input required type="hidden" name="subject_id" value="{{$subject_data->id}}">
                            <input required type="hidden" name="type" value="tracomy">
                        </div>

                        <div class="form-group">
                            <label>{{trans('s_admin.amount_tracomy')}}</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <input required type="number"
                                           @if($data_tracomy != null) value="{{$data_tracomy->amount_tracomy}}"
                                           @endif name="amount_tracomy" min="0" class="form-control form-control-lg">
                                </div>
                                <div class="col-md-2">
                                    <label>({{trans('s_admin.face')}})</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{trans('s_admin.highest_wrong_num')}}</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <input required type="number"
                                           @if($data_tracomy != null) value="{{$data_tracomy->highest_rate}}"
                                           @endif name="highest_rate" min="0" class="form-control form-control-lg">
                                </div>
                                <div class="col-md-2">
                                    <label>({{trans('s_admin.one_error')}})</label>
                                </div>
                            </div>
                        </div>
                        <h4>{{trans('s_admin.the_evaluation')}}</h4>
                        <div class="form-group">
                            <label>{{trans('s_admin.excellent')}}</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <input required type="number" name="excellent"
                                           @if($data_tracomy != null) value="{{$data_tracomy->excellent}}"
                                           @endif  min="0" class="form-control form-control-lg">
                                </div>
                                <div class="col-md-2">
                                    <label>({{trans('s_admin.one_error')}})</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{trans('s_admin.very_good')}}</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <input required type="number" name="very_good"
                                           @if($data_tracomy != null) value="{{$data_tracomy->very_good}}"
                                           @endif  min="0" class="form-control form-control-lg">
                                </div>
                                <div class="col-md-2">
                                    <label>({{trans('s_admin.one_error')}})</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{trans('s_admin.good')}}</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <input required type="number" name="good"
                                           @if($data_tracomy != null) value="{{$data_tracomy->good}}" @endif  min="0"
                                           class="form-control form-control-lg">
                                </div>
                                <div class="col-md-2">
                                    <label>({{trans('s_admin.one_error')}})</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{trans('s_admin.not_pathing')}}</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <input required type="number" name="not_pathing"
                                           @if($data_tracomy != null) value="{{$data_tracomy->not_pathing}}"
                                           @endif  min="0" class="form-control form-control-lg">
                                </div>
                                <div class="col-md-2">
                                    <label>({{trans('s_admin.one_error')}})</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
{{--                        @can("add")--}}
                        <button type="submit" class="btn btn-success mr-2">{{trans('s_admin.save')}}</button>
{{--                            @endcan--}}
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{trans('s_admin.evaluate_revision')}}</h3>
                </div>
                <form class="form" method="post" action="{{route('subject_evaluation.store')}}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{trans('s_admin.subject')}}</label>
                            @if(app()->getLocale() == 'ar')
                                <h4>{{$subject_data->name_ar}}</h4>
                            @else
                                <h4>{{$subject_data->name_en}}</h4>
                            @endif
                            <input required type="hidden" name="subject_id" value="{{$subject_data->id}}">
                            <input required type="hidden" name="type" value="revision">
                        </div>

                        <div class="form-group">
                            <label>{{trans('s_admin.amount_tracomy')}}</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <input required type="number"
                                           @if($data_revision != null) value="{{$data_revision->amount_tracomy}}"
                                           @endif name="amount_tracomy" min="0" class="form-control form-control-lg">
                                </div>
                                <div class="col-md-2">
                                    <label>({{trans('s_admin.face')}})</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{trans('s_admin.highest_wrong_num')}}</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <input required type="number"
                                           @if($data_revision != null) value="{{$data_revision->highest_rate}}"
                                           @endif name="highest_rate" min="0" class="form-control form-control-lg">
                                </div>
                                <div class="col-md-2">
                                    <label>({{trans('s_admin.one_error')}})</label>
                                </div>
                            </div>
                        </div>
                        <h4>{{trans('s_admin.the_evaluation')}}</h4>
                        <div class="form-group">
                            <label>{{trans('s_admin.excellent')}}</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <input required type="number" name="excellent"
                                           @if($data_revision != null) value="{{$data_revision->excellent}}"
                                           @endif  min="0" class="form-control form-control-lg">
                                </div>
                                <div class="col-md-2">
                                    <label>({{trans('s_admin.one_error')}})</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{trans('s_admin.very_good')}}</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <input required type="number" name="very_good"
                                           @if($data_revision != null) value="{{$data_revision->very_good}}"
                                           @endif  min="0" class="form-control form-control-lg">
                                </div>
                                <div class="col-md-2">
                                    <label>({{trans('s_admin.one_error')}})</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{trans('s_admin.good')}}</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <input required type="number" name="good"
                                           @if($data_revision != null) value="{{$data_revision->good}}" @endif  min="0"
                                           class="form-control form-control-lg">
                                </div>
                                <div class="col-md-2">
                                    <label>({{trans('s_admin.one_error')}})</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{trans('s_admin.not_pathing')}}</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <input required type="number" name="not_pathing"
                                           @if($data_revision != null) value="{{$data_revision->not_pathing}}"
                                           @endif  min="0" class="form-control form-control-lg">
                                </div>
                                <div class="col-md-2">
                                    <label>({{trans('s_admin.one_error')}})</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
{{--                        @can("add")--}}
                            <button type="submit" class="btn btn-success mr-2">{{trans('s_admin.save')}}</button>
{{--                        @endcan--}}
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


