@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.edit')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            @if($data->type == 'mqraa')
                <li class="breadcrumb-item">
                    <a  href="{{route('episode.show.type','mqraa')}}" class="text-muted">{{trans('s_admin.nav_far_epo')}}</a>
                </li>
            @elseif($data->type =='mogmaa')
                <li class="breadcrumb-item">
                    <a  href="{{route('colleges.show',$data->college_id)}}" class="text-muted">{{trans('s_admin.nav_electronic_chanel')}}</a>
                </li>
                <li class="breadcrumb-item">
                    <a  href="{{route('colleges.index')}}" class="text-muted">{{trans('s_admin.colleges')}}</a>
                </li>
            @elseif($data->type =='dorr')
                <li class="breadcrumb-item">
                    <a  href="{{route('colleges.show',$data->college_id)}}" class="text-muted">{{trans('s_admin.nav_electronic_chanel')}}</a>
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
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{trans('s_admin.episode_data')}}</h3>
        </div>
            <form class="form" action="{{route('episode.update')}}" method="post">
                @csrf
            <div class="card-body">
                <input type="hidden" name="id" value="{{$data->id}}" >
                <div class="form-group">
                    <label>{{trans('s_admin.episode_name_ar')}}</label>
                    <input required type="text" value="{{$data->name_ar}}" name="name_ar" class="form-control form-control-lg" >
                </div>
                <div class="form-group">
                    <label>{{trans('s_admin.episode_name_en')}}</label>
                    <input required type="text" value="{{$data->name_en}}" name="name_en" class="form-control form-control-lg" >
                </div>
                @if($data->type == 'mqraa')
                    <div class="form-group">
                        <label for="exampleSelectl">{{trans('s_admin.gender')}}</label>
                        <select required name="gender" class="form-control form-control-lg" id="exampleSelectl">
                            <option value="male" @if($data->gender == 'male') selected @endif >{{trans('admin.male')}}</option>
                            <option value="female" @if($data->gender == 'female') selected @endif >{{trans('admin.female')}}</option>
{{--                            <option value="children" @if($data->gender == 'children') selected @endif >{{trans('admin.children')}}</option>--}}
                        </select>
                    </div>
                @endif
                @if($data->type == 'dorr')
{{--                    <div class="form-group">--}}
{{--                        <label for="exampleSelectl">{{trans('s_admin.dorr_name')}}</label>--}}
{{--                        {{ Form::select('college_id',App\Models\College::where('deleted','0')->where('type','dorr')->pluck('name_ar','id'),$data->college_id--}}
{{--                                ,["class"=>"form-control select2", "required" ,"id"=>"kt_select2_5" ]) }}--}}
{{--                    </div>--}}
                    <input type="hidden" name="college_id" value="{{$data->college_id}}">
                @elseif($data->type == 'mogmaa')
{{--                    <div class="form-group">--}}
{{--                        <label for="exampleSelectl">{{trans('s_admin.college_name')}}</label>--}}
{{--                        {{ Form::select('college_id',App\Models\College::where('deleted','0')->where('type','college')->pluck('name_ar','id'),$data->college_id--}}
{{--                                ,["class"=>"form-control select2", "required" ,"id"=>"kt_select2_5" ]) }}--}}
{{--                    </div>--}}
                    <input type="hidden" name="college_id" value="{{$data->college_id}}">
                @endif
                <div class="form-group">
                    <label for="exampleSelectl">{{trans('s_admin.teacher')}}</label>
                   @php $teachers = App\Models\Teacher::where('status','active')->get(); @endphp
                    <select name="teacher_id" class="form-control select2" id="kt_select2_4">
                        @foreach($teachers as $row)
                            @if($data->teacher_id == $row->id)
                                @if(app()->getLocale() == 'ar')
                                    <option value="{{$row->id}}" selected>{{$row->first_name_ar}} &nbsp;{{$row->mid_name_ar}}&nbsp;{{$row->last_name_ar}}</option>
                                @else
                                    <option value="{{$row->id}}" selected>{{$row->first_name_en}}&nbsp;{{$row->mid_name_en}}&nbsp;{{$row->last_name_en}}</option>
                                @endif
                            @else
                                @if(app()->getLocale() == 'ar')
                                    <option value="{{$row->id}}">{{$row->first_name_ar}} &nbsp;{{$row->mid_name_ar}}&nbsp;{{$row->last_name_ar}}</option>
                                @else
                                    <option value="{{$row->id}}">{{$row->first_name_en}}&nbsp;{{$row->mid_name_en}}&nbsp;{{$row->last_name_en}}</option>
                                @endif
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>{{trans('s_admin.contain_energy')}}</label>
                    <input required type="number" min="1" value="{{$data->student_number}}" name="student_number" class="form-control form-control-lg" >
                </div>
                <div class="form-group">
                    <label for="exampleSelectl">{{trans('s_admin.listen_type')}}</label>
                    <select required name="listen_type" class="form-control form-control-lg" id="exampleSelectl">
                        <option value="single" @if($data->listen_type == 'single') selected @endif >{{trans('s_admin.single')}}</option>
                        <option value="group" @if($data->listen_type == 'group') selected @endif >{{trans('s_admin.group')}}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>{{trans('s_admin.activation')}}</label>
                    <div class="radio-list">
                        <label class="radio">
                            <input type="radio" value="y" @if($data->active == 'y') checked @endif name="active">
                            <span></span>{{trans('s_admin.active')}}</label>
                        <label class="radio radio">
                            <input type="radio" value="n" @if($data->active == 'n') checked @endif name="active">
                            <span></span>{{trans('s_admin.unactive')}}</label>

                    </div>
                </div>
                <div class="form-group">
                    <label>{{trans('s_admin.cost')}}</label>
                    <div class="radio-list">
                        <label class="radio">
                            <input type="radio" value="free" @if($data->cost == 'free') checked @endif name="cost" id="free_rb">
                            <span></span>{{trans('s_admin.free')}}</label>
                        <div class="row">
                            <div class="col-md-2">
                                <label class="radio radio">
                                    <input type="radio" value="not_free" @if($data->cost != 'free') checked @endif name="cost" id="not_free_rb">
                                    <span></span>{{trans('s_admin.not_free')}}</label>
                            </div>
                            <div class="col-md-2" id="cont_not_free" @if($data->cost == 'free') style="display: none;"  @endif >
                                <input type="number" step="any" min="0" @if($data->cost != 'free') value="{{$data->cost}}" @endif name="money" class="form-control form-control-lg" placeholder="{{trans('s_admin.value')}}">
                            </div>
                            <div class="col-md-8"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <label for="exampleSelectl">{{trans('s_admin.episode_time')}}</label>
                    </div>
                    <div class="col-md-5">
                        <label>{{trans('s_admin.from')}}</label>
                        <div class="col-lg-12 col-md-9 col-sm-12">
                            <input required name="time_from" class="form-control" id="kt_timepicker_1" value="{{$data->time_from}}" readonly="readonly" type="text">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label>{{trans('s_admin.to')}}</label>
                        <div class="col-lg-12 col-md-9 col-sm-12">
                            <input required name="time_to" class="form-control" id="kt_timepicker_1" value="{{$data->time_to}}" readonly="readonly" type="text">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                    @php $readings = \App\Models\Reading::all(); @endphp
                    <label class="col-3 col-form-label">{{trans('s_admin.reading_types')}}</label>
                    <div class="col-9 col-form-label">
                        <div class="checkbox-list">
                            @foreach($readings as $row)
                                @php $exist_read = \App\Models\Episode_reading::where('episode_id',$data->id)->where('reading_id',$row->id)->first(); @endphp
                                <label class="checkbox">
                                    <input type="checkbox" @if($exist_read != null) checked @endif name="readings[]" value="{{$row->id}}">
                                    <span></span>
                                    @if(app()->getLocale() =='ar')
                                        {{$row->name_ar}}
                                    @else
                                        {{$row->name_en}}
                                    @endif
                                </label>
                            @endforeach
                        </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                        <label class="col-3 col-form-label">{{trans('s_admin.days')}}</label>
                        <div class="col-9 col-form-label">
                            <div class="checkbox-list">
                                <label class="checkbox">
                                    @php $exist_sat = \App\Models\Episode_day::where('episode_id',$data->id)->where('day_id',1)->first(); @endphp
                                    <input type="checkbox"  @if($exist_sat != null) checked @endif name="days[]" value="1">
                                    <span></span>{{trans('s_admin.sat')}}</label>
                                <label class="checkbox">
                                    @php $exist_sun = \App\Models\Episode_day::where('episode_id',$data->id)->where('day_id',2)->first(); @endphp
                                    <input type="checkbox" @if($exist_sun != null) checked @endif name="days[]" value="2">
                                    <span></span>{{trans('s_admin.sun')}}</label>
                                <label class="checkbox">
                                    @php $exist_mon = \App\Models\Episode_day::where('episode_id',$data->id)->where('day_id',3)->first(); @endphp
                                    <input type="checkbox" @if($exist_mon != null) checked @endif name="days[]" value="3">
                                    <span></span>{{trans('s_admin.mon')}}</label>
                                <label class="checkbox">
                                    @php $exist_tus = \App\Models\Episode_day::where('episode_id',$data->id)->where('day_id',4)->first(); @endphp
                                    <input type="checkbox" @if($exist_tus != null) checked @endif name="days[]" value="4">
                                    <span></span>{{trans('s_admin.tus')}}</label>
                                <label class="checkbox">
                                    @php $exist_wens = \App\Models\Episode_day::where('episode_id',$data->id)->where('day_id',5)->first(); @endphp
                                    <input type="checkbox" @if($exist_wens != null) checked @endif name="days[]" value="5">
                                    <span></span>{{trans('s_admin.wen')}}</label>
                                <label class="checkbox">
                                    @php $exist_thers = \App\Models\Episode_day::where('episode_id',$data->id)->where('day_id',6)->first(); @endphp
                                    <input type="checkbox" @if($exist_thers != null) checked @endif name="days[]" value="6">
                                    <span></span>{{trans('s_admin.ther')}}</label>
                                <label class="checkbox">
                                    @php $exist_fri = \App\Models\Episode_day::where('episode_id',$data->id)->where('day_id',7)->first(); @endphp
                                    <input type="checkbox" @if($exist_fri != null) checked @endif name="days[]" value="7">
                                    <span></span>{{trans('s_admin.fri')}}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-info mr-2">{{trans('s_admin.edit')}}</button>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/create_episode_ajax.js') }}"></script>
@endsection

