@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
            @if(Route::current()->getName() == 'colleges.index')
                {{trans('s_admin.colleges')}}
            @else
                {{trans('s_admin.dorrs')}}
            @endif
        </h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    </div>
@endsection
@section('content')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-toolbar">
                @if(auth()->user()->role_id == 2 || auth()->user()->role_id == 6 ||auth()->user()->role_id == 7 ||auth()->user()->role_id == 8 )
                    <a data-toggle="modal" data-target="#exampleModalLong" class="btn btn-success px-6 font-weight-bold">
                        <i class="flaticon2-plus"></i>
                        @if(Route::current()->getName() == 'colleges.index')
                            {{trans('s_admin.add_new_collage')}}
                        @else
                            {{trans('s_admin.add_new_dorr')}}
                        @endif
                    </a>
                @endif
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                <thead>
                <tr>
                    <th title="Field #1">#</th>
                    <th title="Field #1">{{trans('s_admin.name_ar')}}</th>
                    <th title="Field #1">{{trans('s_admin.name_en')}}</th>
                    <th title="Field #1">{{trans('s_admin.creation_date')}}</th>
                    <th title="Field #7">{{trans('s_admin.episodes_number')}}</th>
                    <th title="Field #7">{{trans('s_admin.episodes')}}</th>
                    <th title="Field #7">{{trans('s_admin.chooses')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $key => $row)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$row->name_ar}}</td>
                        <td>{{$row->name_en}}</td>
                        <td>{{$row->created_at->format('Y-m-d')}}</td>
                        <td>{{count($row->Mogmaat)}}</td>
                        @if(Route::current()->getName() == 'colleges.index')
                            <td>
                                <a href="{{route('colleges.show',$row->id)}}"
                                   class="btn btn-dark mr-2">{{trans('s_admin.episodes')}}</a>
                            </td>

                        @else
                            <td>
                                <a href="{{route('dorr.show',$row->id)}}"
                                   class="btn btn-dark mr-2">{{trans('s_admin.episodes')}}</a>
                            </td>
                        @endif
                        <td class="text-center">
                            <a  href="{{url('colleges/'.$row->id.'/edit')}}"
                               class="btn btn-icon btn-primary btn-circle btn-sm mr-2">
                                <i class="icon-nm fas fa-pencil-alt" aria-hidden='true'></i>
                            </a>
                            <a onclick="return confirm('{{trans('s_admin.are_y_sure_delete')}}')"
                               href="{{route('destroy.college',$row->id)}}"
                               class="btn btn-icon btn-danger btn-circle btn-sm mr-2">
                                <i class="icon-nm fa fa-trash" aria-hidden='true'></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!--end: Datatable-->
        </div>
    </div>
    <div class="modal fade" id="exampleModalLong" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="t*ue">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    @if(Route::current()->getName() == 'colleges.index')
                        <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.add_new_collage')}}</h5>
                    @else
                        <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.add_new_dorr')}}</h5>
                    @endif
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    {{ Form::open( ['route' => ['colleges.store'],'method'=>'post', 'files'=>'true'] ) }}
                    @csrf
                    @php  $levels = \App\Models\Level::where('deleted','0')->where('type','mogmaa_dorr')->get(); @endphp
                    @if(Route::current()->getName() == 'colleges.index')
                        @php
                            $teachers = App\Models\Teacher::where('gender','male')->where('status','active')
                                                          ->where('is_new','accepted')->where('is_verified','1')->get();
                        @endphp
                        <input type="hidden" required value="college" name="type">
                    @else
                        @php
                            $teachers = App\Models\Teacher::where('gender','female')->where('status','active')
                                                          ->where('is_new','accepted')->where('is_verified','1')->get();
                        @endphp
                        <input type="hidden" required value="dorr" name="type">
                    @endif
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.name_ar')}}</label>
                            <div class="col-lg-8">
                                <input type="text" required class="form-control" name="name_ar">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.name_en')}}</label>
                            <div class="col-lg-8">
                                <input type="text" required class="form-control" name="name_en">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.mosque_name')}}</label>
                            <div class="col-lg-8">
                                <input type="text" required class="form-control" name="mosque_name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-lg-4 col-form-label text-lg-right">
                                @if(Route::current()->getName() == 'colleges.index')
                                    {{trans('s_admin.manager_name')}}
                                @else
                                    {{trans('s_admin.manager_name_her')}}
                                @endif
                            </label>
                            <div class="col-lg-8">
                                <select name="teacher_id" class="form-control select2" style="width: 100%" id="kt_select2_4">
                                    @foreach($teachers as $row)
                                        @if(app()->getLocale() == 'ar')
                                            <option value="{{$row->id}}">{{$row->first_name_ar}}
                                                &nbsp;{{$row->mid_name_ar}}&nbsp;{{$row->last_name_ar}}</option>
                                        @else
                                            <option value="{{$row->id}}">{{$row->first_name_en}}
                                                &nbsp;{{$row->mid_name_en}}&nbsp;{{$row->last_name_en}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.time')}}</label>
                            <div class="col-lg-8">
                                <select class="form-control select2" id="kt_select2_10" style="width: 100%" name="mogmaa_time"  data-select2-id="kt_select2_10" tabindex="-1" aria-hidden="true">
                                    <option value="fajr" selected >{{trans('s_admin.fajr')}}</option>
                                    <option value="morning">{{trans('s_admin.morning')}}</option>
                                    <option value="dhuhr">{{trans('s_admin.dhuhr')}}</option>
                                    <option value="asr">{{trans('s_admin.asr')}}</option>
                                    <option value="maghrib">{{trans('s_admin.maghrib')}}</option>
                                    <option value="ishaa">{{trans('s_admin.ishaa')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.type')}}</label>
                            <div class="col-lg-8">
                                <div class="col-9 col-form-label">
                                    <div class="radio-list" style="width: 244px;">
                                        @foreach($levels as $row)
                                                <label class="radio">
                                                    <input type="radio" value="{{$row->id}}" name="mogmaa_type">
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
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.study_days')}}</label>
                            <div class="col-lg-8">
                                <div class="col-9 col-form-label">
                                    <div class="checkbox-list">
                                        <label class="checkbox">
                                            <input type="checkbox" checked="checked" name="study_days[]" value="1">
                                            <span></span>{{trans('s_admin.sat')}}</label>
                                        <label class="checkbox">
                                            <input type="checkbox" name="study_days[]" value="2">
                                            <span></span>{{trans('s_admin.sun')}}</label>
                                        <label class="checkbox">
                                            <input type="checkbox" name="study_days[]" value="3">
                                            <span></span>{{trans('s_admin.mon')}}</label>
                                        <label class="checkbox">
                                            <input type="checkbox" name="study_days[]" value="4">
                                            <span></span>{{trans('s_admin.tus')}}</label>
                                        <label class="checkbox">
                                            <input type="checkbox" name="study_days[]" value="5">
                                            <span></span>{{trans('s_admin.wen')}}</label>
                                        <label class="checkbox">
                                            <input type="checkbox" name="study_days[]" value="6">
                                            <span></span>{{trans('s_admin.ther')}}</label>
                                        <label class="checkbox">
                                            <input type="checkbox" name="study_days[]" value="7">
                                            <span></span>{{trans('s_admin.fri')}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.study_period')}}</label>
                            <div class="col-lg-8">
                                <div class="col-9 col-form-label">
                                    <div class="checkbox-list">
                                        <label class="checkbox">
                                            <input type="checkbox" checked="checked" name="study_period[]" value="study_classes">
                                            <span></span>{{trans('s_admin.within_study_classes')}}</label>
                                        <label class="checkbox">
                                            <input type="checkbox" name="study_period[]" value="along_year">
                                            <span></span>{{trans('s_admin.along_year')}}</label>
                                        <label class="checkbox">
                                            <input type="checkbox" name="study_period[]" value="once">
                                            <span></span>{{trans('s_admin.once')}}</label>
                                        <label class="checkbox">
                                            <input type="checkbox" name="study_period[]" value="specified_period">
                                            <span></span>{{trans('s_admin.specified_period')}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.episode_form')}}</label>
                            <div class="col-lg-8">
                                <div class="custom-file">
                                    <input type="file" name="episode_form" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light-primary font-weight-bold"
                                data-dismiss="modal">{{trans('s_admin.cancel')}}</button>
                        <button type="submit" class="btn btn-primary font-weight-bold">{{trans('s_admin.add')}}</button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit_model" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="t*ue">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.edit')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open( ['route' =>'college.update','method'=>'post', 'files'=>'true'] ) }}
                    {{ csrf_field() }}
                    <input type="hidden" required class="form-control" id="txt_id" name="id">
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.name_ar')}}</label>
                            <div class="col-lg-8">
                                <input type="text" required class="form-control" id="txt_name_ar" name="name_ar">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.name_en')}}</label>
                            <div class="col-lg-8">
                                <input type="text" required class="form-control" id="txt_name_en" name="name_en">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-lg-4 col-form-label text-lg-right">
                            @if(Route::current()->getName() == 'colleges.index')
                                {{trans('s_admin.manager_name')}}
                            @else
                                {{trans('s_admin.manager_name_her')}}
                            @endif</label>
                        <div class="col-lg-8">
                            <select name="teacher_id" class="form-control select2" id="kt_select2_4">
                                @foreach($teachers as $row)
                                    @if(app()->getLocale() == 'ar')
                                        <option value="{{$row->id}}">{{$row->first_name_ar}}
                                            &nbsp;{{$row->mid_name_ar}}&nbsp;{{$row->last_name_ar}}</option>
                                    @else
                                        <option value="{{$row->id}}">{{$row->first_name_en}}
                                            &nbsp;{{$row->mid_name_en}}&nbsp;{{$row->last_name_en}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.time')}}</label>
                        <div class="col-lg-8">
                            <select class="form-control select2" id="kt_select2_10" name="mogmaa_time"  data-select2-id="kt_select2_10" tabindex="-1" aria-hidden="true">
                                <option value="fajr" selected >{{trans('s_admin.fajr')}}</option>
                                <option value="morning">{{trans('s_admin.morning')}}</option>
                                <option value="dhuhr">{{trans('s_admin.dhuhr')}}</option>
                                <option value="asr">{{trans('s_admin.asr')}}</option>
                                <option value="maghrib">{{trans('s_admin.maghrib')}}</option>
                                <option value="ishaa">{{trans('s_admin.ishaa')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label
                            class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.type')}}</label>
                        <div class="col-lg-8">
                            <div class="col-9 col-form-label">
                                <div class="radio-list">
                                    @foreach($levels as $row)
                                        <label class="radio">
                                            <input type="radio" value="{{$row->id}}" name="mogmaa_type">
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
                    </div>
                    <div class="form-group row">
                        <label
                            class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.study_days')}}</label>
                        <div class="col-lg-8">
                            <div class="col-9 col-form-label">
                                <div class="checkbox-list">
                                    <label class="checkbox">
                                        <input type="checkbox" checked="checked" name="study_days[]" value="1">
                                        <span></span>{{trans('s_admin.sat')}}</label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="study_days[]" value="2">
                                        <span></span>{{trans('s_admin.sun')}}</label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="study_days[]" value="3">
                                        <span></span>{{trans('s_admin.mon')}}</label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="study_days[]" value="4">
                                        <span></span>{{trans('s_admin.tus')}}</label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="study_days[]" value="5">
                                        <span></span>{{trans('s_admin.wen')}}</label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="study_days[]" value="6">
                                        <span></span>{{trans('s_admin.ther')}}</label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="study_days[]" value="7">
                                        <span></span>{{trans('s_admin.fri')}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label
                            class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.study_period')}}</label>
                        <div class="col-lg-8">
                            <div class="col-9 col-form-label">
                                <div class="checkbox-list">
                                    <label class="checkbox">
                                        <input type="checkbox" checked="checked" name="study_period[]" value="study_classes">
                                        <span></span>{{trans('s_admin.within_study_classes')}}</label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="study_period[]" value="along_year">
                                        <span></span>{{trans('s_admin.along_year')}}</label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="study_period[]" value="once">
                                        <span></span>{{trans('s_admin.once')}}</label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="study_period[]" value="specified_period">
                                        <span></span>{{trans('s_admin.specified_period')}}</label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                    <div class="modal-footer">
                        <button type="submit"
                                class="btn btn-primary font-weight-bold">{{trans('s_admin.edit')}}</button>
                    </div>
                    {{ Form::close() }}
                </div>

            </div>
        </div>

@endsection
@section('scripts')
    <script>
        var id;
        $(document).on('click', '#edit', function () {
            id = $(this).data('editid');
            name_ar = $(this).data('name_ar');
            name_en = $(this).data('name_en');
            $('#txt_id').val(id);
            $('#txt_name_ar').val(name_ar);
            $('#txt_name_en').val(name_en);
        });
    </script>
@endsection
