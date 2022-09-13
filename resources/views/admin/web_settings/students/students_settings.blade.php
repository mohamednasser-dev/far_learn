@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
            @if(request()->segment(2) == 'far_learn')
                {{trans('s_admin.far_learn_students')}}
            @elseif(request()->segment(2) == 'mogmaa')
                {{trans('s_admin.mogmaa_students')}}
            @elseif(request()->segment(2) == 'dorr')
                {{trans('s_admin.dorr_students')}}
            @else
                {{trans('s_admin.new_students')}}
            @endif
        </h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="javascript:void(0);" class="text-muted">{{trans('s_admin.manage_students')}}</a>
            </li>
        </ul>
    </div>
@endsection
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css"/>
    <link href="{{url('/')}}/hijri/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
@endsection
@section('content')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                {{--                @can("add")--}}

                @if( request()->segment(2) != 'new_join' && Route::current()->getName() != 'students.new')
                    <a data-toggle="modal" data-target="#add_new_student"
                       class="btn btn-success px-6 font-weight-bold">{{trans('s_admin.add_new_student')}}</a>
                @endif
                {{--                    @endcan--}}
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                <thead>
                <tr>
                    <th title="Field #1">#</th>
                    <th title="Field #1" style="width: 5%">{{trans('s_admin.image')}}</th>
                    <th title="Field #2" style="width: 10%">{{trans('s_admin.name')}}</th>
                    <th title="Field #3" style="width: 10%">{{trans('s_admin.phone')}}</th>
                    <th title="Field #3" style="width: 10%">{{trans('s_admin.type')}}</th>
                    <th title="Field #4">{{trans('s_admin.my_requests')}}</th>
                    <th title="Field #5">{{trans('s_admin.activation')}}</th>
                    <th title="Field #6">{{trans('s_admin.date')}}</th>
                    <th title="Field #8">{{trans('s_admin.chooses')}}</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @foreach($data as $key => $row)
                    <tr>
                        <td>{{$key + 1}}</td>
                        @if($row->image != null)
                            <td class="text-center" style="width: 5%">
                                <span style="width: 250px;">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40 symbol-sm flex-shrink-0">
                                            <img class="" src="{{$row->image}}"
                                                 alt="photo">
                                        </div>
                                    </div>
                                </span>
                            </td>
                        @else
                            <td class="text-center" style="width: 5%">
                                <span style="width: 250px;">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40 symbol-light-danger flex-shrink-0">
                                            <span class="symbol-label font-size-h4 font-weight-bold">
                                                @if(app()->getLocale() == 'ar')
                                                    {{$row->first_name_en[0]}}
                                                @else
                                                    {{$row->first_name_en[0]}}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </span>
                            </td>
                        @endif
                        <td class="text-center" style="width: 10%">
                            @if(app()->getLocale() == 'ar')
                                {{$row->first_name_ar}} {{$row->mid_name_ar}}
                            @else
                                {{$row->first_name_en}} {{$row->mid_name_en}}
                            @endif
                        </td>
                        <td class="text-center" style="width: 10%">{{$row->user_phone}}</td>
                        <td class="text-center" style="width: 10%">
                            @if($row->epo_type == 'far_learn')
                                {{trans('s_admin.far_learn_student')}}
                            @elseif($row->epo_type == 'dorr')
                                {{trans('s_admin.dorr_student')}}
                            @elseif($row->epo_type == 'mogmaa')
                                {{trans('s_admin.mogmaa_student')}}
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                @if($row->is_verified == '0')
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        {{trans('s_admin.account_not_verified')}}
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                           href="{{route('students.re_verify.mail',['id'=>$row->id , 'type' => 'sms'])}}">{{trans('s_admin.verify_with_sms')}}</a>
                                        <a class="dropdown-item"
                                           href="{{route('students.re_verify.mail',['id'=>$row->id , 'type' => 'mail'])}}">{{trans('s_admin.verify_with_email')}}</a>
                                    </div>
                                @elseif($row->complete_data == '1')
                                    @if($row->is_new == 'y')
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                                data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                            {{trans('s_admin.new')}}
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                               href="{{route('student.accept',$row->id)}}">{{trans('s_admin.accept')}}</a>
                                            <a class="dropdown-item"
                                               href="{{route('student.reject',$row->id)}}">{{trans('s_admin.reject')}}</a>
                                        </div>
                                    @elseif($row->is_new == 'accepted')
                                        <button type="button" class="btn btn-success dropdown-toggle"
                                                data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                            {{trans('s_admin.accepted')}}
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                               href="{{route('student.reject',$row->id)}}">{{trans('s_admin.reject')}}</a>
                                        </div>
                                    @elseif($row->is_new == 'rejected')
                                        <button type="button" class="btn btn-danger dropdown-toggle"
                                                data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                            {{trans('s_admin.rejected')}}
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                               href="{{route('student.accept',$row->id)}}">{{trans('s_admin.accept')}}</a>
                                        </div>
                                    @endif
                                @else
                                    {{trans('s_admin.data_not_complet_yet')}}
                                @endif
                            </div>
                        </td>
                        <td class="text-center">
                            <span class="switch switch-icon">
                                <label>
                                    <input onchange="update_active(this)" value="{{ $row->id }}"
                                           type="checkbox" <?php if ($row->status == 'active') echo "checked";?>>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        {{--                        @if(request()->segment(2) != 'far_learn')--}}
                        {{--                            <td class="text-center">--}}
                        {{--                                @if($row->interview == 'n')--}}
                        {{--                                    <a data-student-id="{{$row->id}}" id="make_interview" alt="default" data-toggle="modal" data-target="#make_interview_model"  class="btn btn-light-info font-weight-bold mr-2">{{trans('s_admin.make_interview')}}</a>--}}
                        {{--                                @elseif($row->interview == 'y')--}}
                        {{--                                    <a href="{{route('edit.student_settings',['type' => request()->segment(2) , 'id' => $row->id])}}" class="btn btn-light-warning font-weight-bold mr-2">{{trans('s_admin.edit_subject')}}</a>--}}
                        {{--                                @endif--}}
                        {{--                            </td>--}}
                        {{--                        @endif--}}
                        <td class="text-center">
                            <div
                                class="font-weight-bolder text-primary mb-0">{{$row->created_at->format('Y-m-d')}}</div>
                        </td>
                        <td class="text-center">
                            <a href="{{route('student.details',['type' => request()->segment(2) , 'id' => $row->id])}}"
                               class="btn btn-icon btn-warning btn-circle btn-sm mr-2">
                                <i class="icon-nm fas fa-eye" aria-hidden='true'></i>
                            </a>
                            <a href="{{route('edit.student_settings',$row->id)}}"
                               class="btn btn-icon btn-primary btn-circle btn-sm mr-2">
                                <i class="icon-nm fas fa-pencil-alt" aria-hidden='true'></i>
                            </a>
                            <a onclick="return confirm('{{trans('s_admin.are_y_sure_delete')}}')"
                               href="{{route('student_settings.destroy',$row->id)}}"
                               class='btn btn-icon btn-danger btn-circle btn-sm mr-2'><i class="icon-nm fas fa-trash"
                                                                                         aria-hidden='true'></i></a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                @endforeach
                </tbody>
            </table>
            <!--end: Datatable-->
        </div>
    </div>
    {{--    student create model --}}

    <div class="modal fade" id="add_new_student" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalSizeSm" aria-hidden="t*ue">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.add_new_student')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open( ['route'  => ['store_new_student'],'method'=>'post'] ) }}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
{{--                                <div class="form-group row">--}}
{{--                                    <label--}}
{{--                                        class="col-lg-4 col-form-label text-lg-right">{{trans('admin.user_name')}}</label>--}}
{{--                                    <div class="col-lg-8">--}}
{{--                                        <input type="text" required onkeyup="this.value=removeSpaces(this.value);"--}}
{{--                                               class="form-control" name="unique_name">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="form-group row">
                                    <label
                                        class="col-lg-4 col-form-label text-lg-right">{{trans('admin.first_name')}}</label>
                                    <div class="col-lg-8">
                                        <input type="text" value="{{old('first_name_ar')}}" required class="form-control" name="first_name_ar">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-lg-4 col-form-label text-lg-right">{{trans('admin.mid_name')}}</label>
                                    <div class="col-lg-8">
                                        <input type="text" value="{{old('mid_name_ar')}}" required class="form-control" name="mid_name_ar">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-lg-4 col-form-label text-lg-right">{{trans('admin.last_name')}}</label>
                                    <div class="col-lg-8">
                                        <input type="text" value="{{old('last_name_ar')}}" required class="form-control" name="last_name_ar">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-lg-4 col-form-label text-lg-right">{{trans('admin.email')}}</label>
                                    <div class="col-lg-8">
                                        <input type="email" value="{{old('email')}}" required class="form-control" name="email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-lg-4 col-form-label text-lg-right">{{trans('admin.phone')}}</label>
                                    <div class="col-lg-6">
                                        {{--                                        onkeyup="this.value=phonelimit(this.value);"--}}
                                        <input type="number" value="{{old('phone')}}" onkeyup="this.value=phonelimit(this.value);" required class="form-control" name="phone">
                                    </div>
                                    <div class="col-lg-2">
                                        <input id="txt_country_code"
                                               class="form-control" value="{{old('country_code')}}"
                                               type="text" name="country_code"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-lg-4 col-form-label text-lg-right">{{trans('admin.password')}}</label>
                                    <div class="col-lg-8">
                                        <input type="password" required class="form-control" minlength="8" name="password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-lg-4 col-form-label text-lg-right">{{trans('admin.password_confirmation')}}</label>
                                    <div class="col-lg-8">
                                        <input type="password" required class="form-control" minlength="8"
                                               name="password_confirmation">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-lg-4 col-form-label text-lg-right">{{trans('admin.gender')}}</label>
                                    <div class="col-lg-8">
                                        <select required name="gender" class="form-control form-control-lg"
                                                id="exampleSelectl">
                                            <option value="male" @if(request()->segment(2) == 'dorr') disabled
                                                    @elseif(request()->segment(2) == 'mogmaa' || old('gender') == 'male') selected @endif >{{trans('admin.male')}}</option>
                                            <option value="female" @if(request()->segment(2) == 'dorr' || old('gender') == 'female') selected
                                                    @elseif(request()->segment(2) == 'mogmaa') disabled @endif >{{trans('admin.female')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.country_now')}}</label>
                                    <div class="col-lg-8">
                                        @php $countries_now = App\Models\Country::where('deleted','0')->get(); @endphp
                                        <select required name="country" id="cmb_country"
                                                class="form-control form-control-lg">
                                            <option value="" selected>{{trans('s_admin.choose_country_now')}}</option>
                                            @foreach($countries_now as $row)
                                                <option value="{{$row->id}}" @if(old('country') == $row->id) selected @endif>{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if(request()->segment(2) != 'far_learn')
                                    <div class="form-group row" style="display:none;" id="zones_cont">
                                        <label
                                            class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.zones')}}</label>
                                        <div class="col-lg-8">
                                            @php $zones = App\Models\Zone::where('deleted','0')->get(); @endphp
                                            <select required name="zone_id" id="cmb_zones"
                                                    class="form-control form-control-lg">
                                                <option value="">{{trans('s_admin.choose_zone')}}</option>
                                                @foreach($zones as $row)
                                                    <option value="{{$row->id}}" @if(old('zone_id') == $row->id) selected @endif>{{$row->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row" style="display:none;" id="city_cont">
                                        <label
                                            class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.city')}}</label>
                                        <div class="col-lg-8">
                                            @php $cities = App\Models\City::where('deleted','0')->get(); @endphp
                                            <select required name="city_id" id="cmb_cities"
                                                    class="form-control form-control-lg">
                                                <option value="">{{trans('s_admin.choose_city')}}</option>
                                                @foreach($cities as $row)
                                                    <option value="{{$row->id}}" @if(old('city_id') == $row->id) selected @endif>{{$row->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row" style="display:none;" id="districts_cont">
                                        <label
                                            class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.district_S')}}</label>
                                        <div class="col-lg-8">
                                            @php $district = App\Models\District::where('deleted','0')->get(); @endphp
                                            <select required name="district_id" id="cmb_districts"
                                                    class="form-control form-control-lg">
                                                <option value="" >{{trans('s_admin.choose_district')}}</option>
                                                @foreach($district as $row)
                                                    <option value="{{$row->id}}" @if(old('district_id') == $row->id) selected @endif>{{$row->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label
                                        class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.save_quran_num')}}</label>
                                    <div class="col-lg-6">
                                        <input type="number" value="{{old('save_quran_num')}}" step="any" min="0" max="30" required class="form-control"
                                               name="save_quran_num">
                                    </div>
                                    <label class="col-xl-2 col-lg-2 col-form-label">{{trans('s_admin.gzaa')}}</label>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.what_limit_save')}}</label>
                                    <div class="col-lg-8">
                                        <select required name="save_quran_limit" class="form-control form-control-lg">
                                            @php $save_limits = App\Models\Save_limit::where('deleted','0')->get(); @endphp
                                            <option value="">{{trans('s_admin.choose_limit')}}</option>
                                            @foreach($save_limits as $row)
                                                <option value="{{$row->id}}" @if(old('save_quran_limit') == $row->id) selected @endif>{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.ident_num')}}</label>
                                    <div class="col-lg-8">
                                        <input type="number" value="{{old('ident_num')}}" required class="form-control" name="ident_num">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-lg-4 col-form-label text-lg-right">{{trans('admin.date_of_birth')}}</label>
                                    <div class="col-lg-8">
                                        <input id="txt_date" value="{{old('date_of_birth')}}" type="text" required name="date_of_birth"
                                               class="form-control hijri-date-input">
                                    </div>
                                </div>
                                {{--                                <div class="form-group row">--}}
                                {{--                                    <label class="col-lg-4 col-form-label text-lg-right">{{trans('admin.country')}}</label>--}}
                                {{--                                    <div class="col-lg-8">--}}
                                {{--                                        @php $countries = \App\Models\Country::where('deleted','0')->get(); @endphp--}}
                                {{--                                        <select id="txt_country" required class="form-control custom-select"--}}
                                {{--                                                name="country">--}}
                                {{--                                            @foreach($countries as $row)--}}
                                {{--                                                <option value="{{$row->id}}">--}}
                                {{--                                                    @if(app()->getLocale() == 'ar')--}}
                                {{--                                                        {{$row->name_ar}}--}}
                                {{--                                                    @else--}}
                                {{--                                                        {{$row->name_en}}--}}
                                {{--                                                    @endif--}}
                                {{--                                                </option>--}}
                                {{--                                            @endforeach--}}
                                {{--                                        </select>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                <div class="form-group row">
                                    <label
                                        class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.qualification')}}</label>
                                    <div class="col-lg-8">
                                        @php $qualifications = \App\Models\Qualification::where('deleted','0')->get(); @endphp
                                        <select id="txt_qualification" name="qualification" required
                                                class="form-control custom-select">
                                            @foreach($qualifications as $row)
                                                <option value="{{$row->id}}" @if(old('qualification') == $row->id) selected @endif>
                                                    @if(app()->getLocale() == 'ar')
                                                        {{$row->name_ar}}
                                                    @else
                                                        {{$row->name_en}}
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.nationality')}}</label>
                                    <div class="col-lg-8">
                                        @php $nationalities = \App\Models\Nationality::where('deleted','0')->get(); @endphp
                                        <select id="txt_nationality" name="nationality" required
                                                class="form-control custom-select">
                                            @foreach($nationalities as $row)
                                                <option value="{{$row->id}}" @if(old('nationality') == $row->id) selected @endif>
                                                    @if(app()->getLocale() == 'ar')
                                                        {{$row->name_ar}}
                                                    @else
                                                        {{$row->name_en}}
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-lg-4 col-form-label text-lg-right">{{trans('admin.main_lang')}}</label>
                                    <div class="col-lg-8">
                                        <select id="txt_lang" class="form-control custom-select" required
                                                name="main_lang">
                                            <option>{{trans('s_admin.choose_language')}}</option>
                                            <option value="en" @if(old('main_lang') == 'en') selected @endif >English</option>
                                            <option selected value="ar" @if(old('main_lang') == 'ar') selected @endif >العربية</option>
                                        </select>
                                    </div>
                                </div>
                                @if(request()->segment(2) != 'far_learn')
                                    <input required type="hidden" name="epo_type" value="mogmaa_dorr">
                                    <div class="form-group row">
                                        <label
                                            class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.level')}}</label>
                                        <div class="col-lg-8">
                                            {{ Form::select('level_id',App\Models\Level::where('type','mogmaa_dorr')->where('deleted','0')->pluck('name_ar','id'),null
                                                ,["class"=>"form-control form-control-lg","placeholder"=>trans('s_admin.choose_level'), "required" ,"id"=>"cmb_levels" ]) }}
                                        </div>
                                    </div>
                                    <div class="form-group row" id="subject_cont" style="display:none;">
                                        <label
                                            class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.subject')}}</label>
                                        <div class="col-lg-8">
                                            {{ Form::select('subject_id',App\Models\Subject::where('deleted','0')->pluck('name_ar','id'),null
                                                ,["class"=>"form-control form-control-lg", "required" ,"id"=>"cmb_subjects" ]) }}
                                        </div>
                                    </div>
                                    <div class="form-group row" id="subject_level_cont" style="display:none;">
                                        <label
                                            class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.subject_level')}}</label>
                                        <div class="col-lg-8">
                                            {{ Form::select('subject_level_id',App\Models\Subject_level::where('deleted','0')->pluck('name_ar','id'),null
                                                ,["class"=>"form-control form-control-lg", "required" ,"id"=>"cmb_subject_levels" ]) }}
                                        </div>
                                    </div>
                                @else
                                    <input required type="hidden" name="epo_type" value="far_learn">
                                    <div class="form-group row">
                                        <label
                                            class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.level')}}</label>
                                        <div class="col-lg-8">
                                            {{ Form::select('level_id',App\Models\Level::where('type','far_learn')->where('deleted','0')->pluck('name_ar','id'),null
                                                ,["class"=>"form-control form-control-lg","placeholder"=>trans('s_admin.choose_level'), "required" ,"id"=>"cmb_levels" ]) }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light-primary font-weight-bold"
                                data-dismiss="modal">{{trans('s_admin.cancel')}}</button>
                        <button type="submit"
                                class="btn btn-primary font-weight-bold">{{trans('s_admin.save')}}</button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="make_interview_model" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="t*ue">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.place_student_to_subject')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open( ['route' =>'student.place.subject','method'=>'post', 'files'=>'true'] ) }}
                    <input type="hidden" required class="form-control" id="txt_student_id" name="id">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="exampleSelectl">{{trans('s_admin.level')}}</label>
                            {{ Form::select('level_id',App\Models\Level::where('type','!=','far_learn')->where('deleted','0')->pluck('name_ar','id'),null
                                    ,["class"=>"form-control form-control-lg","placeholder"=>trans('s_admin.choose_level'), "required" ,"id"=>"cmb_levels" ]) }}
                        </div>
                        <div class="form-group row" style="display:none;" id="subject_cont">
                            <label for="exampleSelectl">{{trans('s_admin.subject')}}</label>
                            @php $subjects = App\Models\Subject::where('deleted','0')->get(); @endphp
                            <select required name="subject_id" class="form-control form-control-lg" id="cmb_subjects">
                                <option value="" selected>{{trans('s_admin.choose_subject')}}</option>
                                @foreach($subjects as $row)
                                    @if(app()->getLocale() == 'ar')
                                        <option value="{{$row->id}}">{{$row->name_ar}}
                                            &nbsp;&nbsp;&nbsp;{{$row->desc_ar}}</option>
                                    @else
                                        <option value="{{$row->id}}">{{$row->name_en}}
                                            &nbsp;&nbsp;&nbsp;{{$row->desc_en}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row" id="subject_level_cont" style="display:none;">
                            <label for="exampleSelectl">{{trans('s_admin.subject_level')}}</label>
                            {{ Form::select('subject_level_id',App\Models\Subject_level::where('deleted','0')->pluck('name_ar','id'),null
                                                            ,["class"=>"form-control form-control-lg", "required" ,"id"=>"cmb_subject_levels" ]) }}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit"
                                class="btn btn-primary font-weight-bold">{{trans('s_admin.save')}}</button>
                    </div>
                    {{ Form::close() }}
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#cmb_country').change(function () {
            var level = $(this).val();
            $.ajax({
                url: "/get_zones/" + level,
                dataType: 'html',
                type: 'get',
                success: function (data) {
                    $('#zones_cont').show();
                    $('#lbl_zones_cont').show();
                    $('#cmb_zones').html(data);
                }
            });
        });


        $('#cmb_zones').change(function () {
            var subject = $(this).val();
            $.ajax({
                url: "/get_cities/" + subject,
                dataType: 'html',
                type: 'get',
                success: function (data) {
                    $('#city_cont').show(data);
                    $('#cmb_cities').html(data);
                }
            });
        });

        $('#cmb_cities').change(function () {
            var level = $(this).val();
            $.ajax({
                url: "/get_districts/" + level,
                dataType: 'html',
                type: 'get',
                success: function (data) {
                    $('#districts_cont').show();
                    $('#cmb_districts').html(data);
                }
            });
        });
    </script>
    <script src="{{ asset('js/create_episode_ajax.js') }}"></script>

    <script>
        var id;
        $(document).on('click', '#make_interview', function () {
            id = $(this).data('student-id');
            $('#txt_student_id').val(id);
        });
    </script>
    <script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>var KTAppSettings = {
            "breakpoints": {"sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400},
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#3699FF",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#E4E6EF",
                        "dark": "#181C32"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#E1F0FF",
                        "secondary": "#EBEDF3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#3F4254",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#EBEDF3",
                    "gray-300": "#E4E6EF",
                    "gray-400": "#D1D3E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#7E8299",
                    "gray-700": "#5E6278",
                    "gray-800": "#3F4254",
                    "gray-900": "#181C32"
                }
            },
            "font-family": "Poppins"
        };</script>
    <!--end::Global Config-->
    <!--begin::Page Scripts(used by this page)-->
    {{--    <script src="{{ asset('metronic/assets/js/pages/crud/ktdatatable/base/html-table.js') }}"></script>--}}
    <!--end::Page Scripts-->
    <script src="{{url('/')}}/hijri/js/bootstrap.js"></script>
    <script src="{{url('/')}}/hijri/js/momentjs.js"></script>
    <script src="{{url('/')}}/hijri/js/moment-with-locales.js"></script>
    <script src="{{url('/')}}/hijri/js/moment-hijri.js"></script>
    <script src="{{url('/')}}/hijri/js/bootstrap-hijri-datetimepicker.js"></script>
    <script type="text/javascript">
        $(function () {
            initHijrDatePicker();
            $('.disable-date').hijriDatePicker({

                minDate: "2020-01-01",
                maxDate: "2021-01-01",
                viewMode: "years",
                hijri: true,
                debug: true
            });
        });

        function initHijrDatePicker() {
            $(".hijri-date-input").hijriDatePicker({
                locale: "ar-sa",
                format: "DD-MM-YYYY",
                hijriFormat: "iYYYY-iMM-iDD",
                dayViewHeaderFormat: "MMMM YYYY",
                hijriDayViewHeaderFormat: "iMMMM iYYYY",
                showSwitcher: true,
                allowInputToggle: true,
                showTodayButton: false,
                useCurrent: true,
                isRTL: false,
                viewMode: 'months',
                keepOpen: false,
                hijri: false,
                debug: true,
                showClear: true,
                showTodayButton: true,
                showClose: true
            });
        }

        function initHijrDatePickerDefault() {
            $(".hijri-date-input").hijriDatePicker();
        }
    </script>
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
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>
    <script type="text/javascript">
        $(function () {
            var code = "+966"; // Assigning value from model.
            $('#txt_country_code').val(code);
            $('#txt_country_code').intlTelInput({
                autoHideDialCode: true,
                autoPlaceholder: "ON",
                dropdownContainer: document.body,
                formatOnDisplay: true,
                hiddenInput: "full_number",
                initialCountry: "auto",
                nationalMode: true,
                placeholderNumberType: "MOBILE",
                preferredCountries: ['US'],
                separateDialCode: false
            });
            console.log(code)
        });
    </script>

    <script type="text/javascript">
        function update_active(el) {
            if (el.checked) {
                var status = 'active';
            } else {
                var status = 'unactive';
            }
            $.post('{{ route('student_settings.actived') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function (data) {
                if (data == 1) {
                    toastr.success("{{trans('s_admin.statuschanged')}}");
                } else {
                    toastr.error("{{trans('s_admin.statuschanged')}}");
                }
            });
        }

        function phonelimit(string) {
            var first_string = string.substring(0);
            var int_string = parseInt(first_string);
            if(int_string == 0){
                $("#phone").val('');
                return false;
            }

            if (string.length < 11) {
                return string;
            } else {
                alert('عفوا رقم الجوال 10 اراقم فقط');
            }
        }






        function removeSpaces(string) {
            return string.split(' ').join('');
        }
    </script>

@endsection
