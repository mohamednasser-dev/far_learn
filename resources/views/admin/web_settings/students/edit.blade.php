@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.edit')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                @if($data->is_new == 'y')
                    <a href="{{route('students.new')}}" class="text-muted">
                        {{trans('s_admin.new_students')}}
                    </a>
                @elseif($data->epo_type == 'far_learn')
                    <a href="{{url('/student_settings/far_learn')}}" class="text-muted">
                        {{trans('s_admin.far_learn_students')}}
                    </a>
                @elseif($data->epo_type == 'mogmaa')
                    <a href="{{url('/student_settings/mogmaa')}}" class="text-muted">
                        {{trans('s_admin.mogmaa_students')}}
                    </a>
                @elseif($data->epo_type == 'dorr')
                    <a href="{{url('/student_settings/dorr')}}" class="text-muted">
                        {{trans('s_admin.dorr_students')}}
                    </a>
                @else
                    <a href="{{url('/student_settings')}}" class="text-muted">
                        {{trans('s_admin.nav_student_shoan_settings')}}
                    </a>
                @endif
            </li>
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
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{trans('s_admin.edit_student_info')}}</h3>
        </div>
        <form class="form" action="{{route('update.student_settings',$data->id )}}" method="post">
            @csrf
            <div class="card-body">
                {{--                <div class="form-group row">--}}
                {{--                    <label class="col-form-label text-right col-lg-3 col-sm-12">{{trans('admin.first_name')}}</label>--}}
                {{--                    <div class="col-lg-4 col-md-9 col-sm-12">--}}
                {{--                        <input type="text" value="{{$data->first_name_ar}}" required class="form-control" name="first_name_ar">--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--                <div class="form-group row">--}}
                {{--                    <label class="col-form-label text-right col-lg-3 col-sm-12">{{trans('admin.mid_name')}}</label>--}}
                {{--                    <div class="col-lg-4 col-md-9 col-sm-12">--}}
                {{--                        <input type="text" value="{{$data->mid_name_ar}}" required class="form-control" name="mid_name_ar">--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--                <div class="form-group row">--}}
                {{--                    <label class="col-form-label text-right col-lg-3 col-sm-12">{{trans('admin.last_name')}}</label>--}}
                {{--                    <div class="col-lg-4 col-md-9 col-sm-12">--}}
                {{--                        <input type="text" value="{{$data->last_name_ar}}" required class="form-control" name="last_name_ar">--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--                <div class="form-group row">--}}
                {{--                    <label class="col-form-label text-right col-lg-3 col-sm-12">{{trans('admin.email')}}</label>--}}
                {{--                    <div class="col-lg-4 col-md-9 col-sm-12">--}}
                {{--                        <input type="email" value="{{$data->email}}" required class="form-control" name="email">--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--                <div class="form-group row">--}}
                {{--                    <label class="col-form-label text-right col-lg-3 col-sm-12">{{trans('admin.password')}}</label>--}}
                {{--                    <div class="col-lg-4 col-md-9 col-sm-12">--}}
                {{--                        <input type="password" class="form-control" name="password">--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--                <div class="form-group row">--}}
                {{--                    <label--}}
                {{--                        class="col-form-label text-right col-lg-3 col-sm-12">{{trans('admin.password_confirmation')}}</label>--}}
                {{--                    <div class="col-lg-4 col-md-9 col-sm-12">--}}
                {{--                        <input type="password" class="form-control" name="password_confirmation">--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--                <div class="form-group row">--}}
                {{--                    <label class="col-form-label text-right col-lg-3 col-sm-12">{{trans('admin.phone')}}</label>--}}
                {{--                    <div class="col-lg-4 col-md-9 col-sm-12">--}}
                {{--                        <input type="tel" class="form-control" name="phone" value="{{$data->phone}}" >--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--                <div class="form-group row">--}}
                {{--                    <label class="col-form-label text-right col-lg-3 col-sm-12">{{trans('s_admin.ident_num')}}</label>--}}
                {{--                    <div class="col-lg-4 col-md-9 col-sm-12">--}}
                {{--                        <input type="tel" required class="form-control" name="ident_num" value="{{$data->ident_num}}">--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--                <div class="form-group row">--}}
                {{--                    <label class="col-form-label text-right col-lg-3 col-sm-12">{{trans('admin.lang')}}</label>--}}
                {{--                    <div class="col-lg-4 col-md-9 col-sm-12">--}}
                {{--                        <select name="main_lang" class="form-control form-control-lg form-control-solid" >--}}
                {{--                            <option>{{trans('s_admin.choose_language')}}</option>--}}
                {{--                            <option value="en" @if($data->main_lang == 'en') selected @endif >English</option>--}}
                {{--                            <option value="ar" @if($data->main_lang == 'ar') selected @endif >العربية</option>--}}
                {{--                        </select>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--                <div class="form-group row">--}}
                {{--                    <label class="col-form-label text-right col-lg-3 col-sm-12">{{trans('admin.date_of_birth')}}</label>--}}
                {{--                    <div class="col-lg-4 col-md-9 col-sm-12">--}}
                {{--                        <input id="txt_date" type="text" value="{{$data->date_of_birth}}" required  name="date_of_birth" class="form-control hijri-date-input">--}}

                {{--                    </div>--}}
                {{--                </div>--}}
                {{--                <div class="form-group row">--}}
                {{--                    <label class="col-form-label text-right col-lg-3 col-sm-12">{{trans('admin.gender')}}</label>--}}
                {{--                    <div class="col-lg-4 col-md-9 col-sm-12">--}}
                {{--                        <select required name="gender" class="form-control form-control-lg" id="exampleSelectl">--}}
                {{--                            @if($data->gender == 'male')--}}
                {{--                                <option selected value="male">{{trans('admin.male')}}</option>--}}
                {{--                            @else--}}
                {{--                                <option value="male">{{trans('admin.male')}}</option>--}}
                {{--                            @endif--}}
                {{--                            @if($data->gender == 'female')--}}
                {{--                                <option selected value="female">{{trans('admin.female')}}</option>--}}
                {{--                            @else--}}
                {{--                                <option value="female">{{trans('admin.female')}}</option>--}}
                {{--                            @endif--}}
                {{--                        </select>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--                <div class="form-group row">--}}
                {{--                    <label class="col-form-label text-right col-lg-3 col-sm-12">{{trans('admin.country')}}</label>--}}
                {{--                    <div class="col-lg-4 col-md-9 col-sm-12">--}}
                {{--                        @php $country = App\Models\Country::where('deleted','0')->get(); @endphp--}}
                {{--                        <select id="country" name="country" required class="form-control custom-select">--}}
                {{--                            <option >{{trans('s_admin.choose_country')}}</option>--}}
                {{--                            @foreach($country as $row)--}}
                {{--                                @if($data->country == $row->id)--}}
                {{--                                    <option value="{{$row->id}}" selected>{{$row->name}}</option>--}}
                {{--                                @else--}}
                {{--                                    <option value="{{$row->id}}">{{$row->name}}</option>--}}
                {{--                                @endif--}}
                {{--                            @endforeach--}}
                {{--                        </select>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--                <div class="form-group row">--}}
                {{--                    <label class="col-form-label text-right col-lg-3 col-sm-12">{{trans('s_admin.qualification')}}</label>--}}
                {{--                    <div class="col-lg-4 col-md-9 col-sm-12">--}}
                {{--                        @php $qualification = App\Models\Qualification::where('deleted','0')->get(); @endphp--}}
                {{--                        <select id="qualification" name="qualification" required class="form-control custom-select">--}}
                {{--                            <option>{{trans('s_admin.choose_qualification')}}</option>--}}
                {{--                            @foreach($qualification as $row)--}}
                {{--                                @if($data->qualification == $row->id)--}}
                {{--                                    <option value="{{$row->id}}" selected>{{$row->name}}</option>--}}
                {{--                                @else--}}
                {{--                                    <option value="{{$row->id}}">{{$row->name}}</option>--}}
                {{--                                @endif--}}
                {{--                            @endforeach--}}
                {{--                        </select>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--                <div class="form-group row">--}}
                {{--                    <label class="col-form-label text-right col-lg-3 col-sm-12">{{trans('s_admin.nationality')}}</label>--}}
                {{--                    <div class="col-lg-4 col-md-9 col-sm-12">--}}
                {{--                        @php $nationality = App\Models\Nationality::where('deleted','0')->get(); @endphp--}}
                {{--                        <select id="nationality" name="nationality" required class="form-control custom-select">--}}
                {{--                            <option >{{trans('s_admin.choose_nationality')}}</option>--}}
                {{--                            @foreach($nationality as $row)--}}
                {{--                                @if($data->nationality == $row->id)--}}
                {{--                                    <option value="{{$row->id}}" selected>{{$row->name}}</option>--}}
                {{--                                @else--}}
                {{--                                    <option value="{{$row->id}}">{{$row->name}}</option>--}}
                {{--                                @endif--}}
                {{--                            @endforeach--}}
                {{--                        </select>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                <div class="row">
                    <div class="col-lg-6">
{{--                        <div class="form-group row">--}}
{{--                            <label--}}
{{--                                class="col-lg-4 col-form-label text-lg-right">{{trans('admin.user_name')}}</label>--}}
{{--                            <div class="col-lg-8">--}}
{{--                                <input type="text" required value="{{$data->unique_name}}" class="form-control"--}}
{{--                                       name="unique_name">--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="form-group row">
                            <label
                                class="col-lg-4 col-form-label text-lg-right">{{trans('admin.first_name')}}</label>
                            <div class="col-lg-8">
                                <input type="text" required value="{{$data->first_name_ar}}" class="form-control"
                                       name="first_name_ar">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-lg-4 col-form-label text-lg-right">{{trans('admin.mid_name')}}</label>
                            <div class="col-lg-8">
                                <input type="text" required value="{{$data->mid_name_ar}}" class="form-control"
                                       name="mid_name_ar">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-lg-4 col-form-label text-lg-right">{{trans('admin.last_name')}}</label>
                            <div class="col-lg-8">
                                <input type="text" required value="{{$data->last_name_ar}}" class="form-control"
                                       name="last_name_ar">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-lg-4 col-form-label text-lg-right">{{trans('admin.email')}}</label>
                            <div class="col-lg-8">
                                <input type="email" value="{{$data->email}}" class="form-control" name="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('admin.phone')}}</label>
                            <div class="col-lg-6">
                                <input type="number" onkeyup="this.value=phonelimit(this.value);" required value="{{$data->phone}}" class="form-control" name="phone">
                            </div>
                            <div class="col-lg-2">
                                <input id="txt_country_code" value="{{$data->country_code}}"
                                       class="form-control" required
                                       type="text" name="country_code"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('admin.password')}}</label>
                            <div class="col-lg-8">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-lg-4 col-form-label text-lg-right">{{trans('admin.password_confirmation')}}</label>
                            <div class="col-lg-8">
                                <input type="password" class="form-control"
                                       name="password_confirmation">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('admin.gender')}}</label>
                            <div class="col-lg-8">
                                <select required name="gender" class="form-control form-control-lg"
                                        id="exampleSelectl">
                                    <option value="male"
                                            @if($data->gender == 'male') selected @endif >{{trans('admin.male')}}</option>
                                    <option value="female"
                                            @if($data->gender == 'female') selected @endif>{{trans('admin.female')}}</option>
                                </select>
                            </div>
                        </div>
                        @if( $data->epo_type != 'far_learn')
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('admin.country')}}</label>
                            <div class="col-lg-8">
                                @php $countries_now = App\Models\Country::where('deleted','0')->get(); @endphp
                                <select required name="country" id="cmb_country" class="form-control form-control-lg">
                                    <option value="" selected>{{trans('s_admin.choose_country')}}</option>
                                    @foreach($countries_now as $row)
                                        @if($data->district_id != null)
                                        @if($data->country == $row->id)
                                            <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                        @else
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endif
                                        @else
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row" @if($data->district_id == null) style="display:none;"
                             @endif  id="zones_cont">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.zones')}}</label>
                            <div class="col-lg-8">
                                @php $zones = App\Models\Zone::where('country_id',$data->country)->where('deleted','0')->get(); @endphp
                                <select required name="zone_id" id="cmb_zones" class="form-control form-control-lg">
                                    <option value="" selected>{{trans('s_admin.choose_zone')}}</option>
                                    @foreach($zones as $row)
                                        @if($data->district_id != null)
                                            @if($data->District->City->zone_id == $row->id)
                                                <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                            @else
                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                            @endif
                                        @else
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" @if($data->district_id == null) style="display:none;" @endif id="city_cont">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.city')}}</label>
                            <div class="col-lg-8">
                                @if($data->district_id != null)
                                    @php $cities = App\Models\City::where('zone_id',$data->District->City->zone_id)->where('deleted','0')->get(); @endphp
                                @else
                                    @php $cities = App\Models\City::where('deleted','0')->get(); @endphp
                                @endif
                                <select required name="city_id" id="cmb_cities" class="form-control form-control-lg">
                                    <option value="" selected>{{trans('s_admin.choose_city')}}</option>
                                    @foreach($cities as $row)
                                        @if($data->district_id != null)
                                        @if($data->District->city_id == $row->id)
                                            <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                        @else
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endif
                                        @else
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row" @if($data->district_id == null) style="display:none;" @endif id="districts_cont">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.district_S')}}</label>
                            <div class="col-lg-8">
                                @if($data->district_id != null)
                                    @php $district = App\Models\District::where('city_id',$data->District->city_id)->where('deleted','0')->get(); @endphp
                                @else
                                    @php $district = App\Models\District::where('deleted','0')->get(); @endphp
                                @endif
                                    <select required name="district_id" id="cmb_districts"
                                        class="form-control form-control-lg">
                                    <option value="" selected>{{trans('s_admin.choose_district')}}</option>
                                    @foreach($district as $row)
                                        @if($data->district_id == $row->id)
                                            <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                        @else
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @else
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label text-lg-right">{{trans('admin.country')}}</label>
                                <div class="col-lg-8">
                                    @php $countries_now = App\Models\Country::where('deleted','0')->get(); @endphp
                                    <select required name="country" id="cmb_country" class="form-control form-control-lg">
                                        <option value="" selected>{{trans('s_admin.choose_country')}}</option>
                                        @foreach($countries_now as $row)
                                            @if($data->country != null)
                                                @if($data->country == $row->id)
                                                    <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                                @else
                                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                                @endif
                                            @else
                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                            @endif
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
                                <input type="number" step="any" value="{{$data->save_quran_num}}" min="0" max="30"
                                       required class="form-control" name="save_quran_num">
                            </div>
                            <label class="col-xl-2 col-lg-2 col-form-label">{{trans('s_admin.gzaa')}}</label>
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.what_limit_save')}}</label>
                            <div class="col-lg-8">
                                @php $save_limits = App\Models\Save_limit::where('deleted','0')->get(); @endphp
                                <select required name="save_quran_limit" class="form-control form-control-lg">
                                    <option value="">{{trans('s_admin.choose_limit')}}</option>
                                    @foreach($save_limits as $row)
                                        @if($data->save_quran_limit == $row->id)
                                            <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                        @else
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.ident_num')}}</label>
                            <div class="col-lg-8">
                                <input type="number" required value="{{$data->ident_num}}" class="form-control"
                                       name="ident_num">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-lg-4 col-form-label text-lg-right">{{trans('admin.date_of_birth')}}</label>
                            <div class="col-lg-8">
                                <input id="txt_date" type="text"
                                       value="{{Carbon\Carbon::parse($data->date_of_birth)->format('d-m-Y')}}" required
                                       name="date_of_birth" class="form-control hijri-date-input">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.qualification')}}</label>
                            <div class="col-lg-8">
                                @php $qualifications = \App\Models\Qualification::where('deleted','0')->get(); @endphp
                                <select id="txt_qualification" name="qualification" required
                                        class="form-control custom-select">
                                    @foreach($qualifications as $row)
                                        @if($data->qualification == $row->id)
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
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.nationality')}}</label>
                            <div class="col-lg-8">
                                @php $nationalities = \App\Models\Nationality::where('deleted','0')->get(); @endphp
                                <select id="txt_nationality" name="nationality" required
                                        class="form-control custom-select">
                                    @foreach($nationalities as $row)
                                        @if($data->nationality == $row->id)
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
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('admin.main_lang')}}</label>
                            <div class="col-lg-8">
                                <select id="txt_lang" class="form-control custom-select" required name="main_lang">
                                    <option>{{trans('s_admin.choose_language')}}</option>
                                    <option value="en" @if($data->main_lang == 'en') selected @endif > English</option>
                                    <option value="ar" @if($data->main_lang == 'ar') selected @endif >العربية</option>
                                </select>
                            </div>
                        </div>
                        @if( $data->epo_type != 'far_learn')
                            <div class="form-group row">
                                <label
                                    class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.level')}}</label>
                                <div class="col-lg-8">
                                    {{ Form::select('level_id',App\Models\Level::where('type','mogmaa_dorr')->where('deleted','0')->pluck('name_ar','id'), $data->level_id
                                        ,["class"=>"form-control form-control-lg","placeholder"=>trans('s_admin.choose_level'), "required" ,"id"=>"cmb_levels" ]) }}
                                </div>
                            </div>
                            <div class="form-group row" id="subject_cont"
                                 @if($data->subject_id == null) style="display:none;" @endif>
                                <label
                                    class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.subject')}}</label>
                                <div class="col-lg-8">
                                    {{ Form::select('subject_id',App\Models\Subject::where('deleted','0')->pluck('name_ar','id'), $data->subject_id
                                        ,["class"=>"form-control form-control-lg", "required" ,"id"=>"cmb_subjects" ]) }}
                                </div>
                            </div>
                            <div class="form-group row" id="subject_level_cont"
                                 @if($data->subject_level_id == null) style="display:none;" @endif >
                                <label
                                    class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.subject_level')}}</label>
                                <div class="col-lg-8">
                                    {{ Form::select('subject_level_id',App\Models\Subject_level::where('deleted','0')->pluck('name_ar','id'), $data->subject_level_id
                                        ,["class"=>"form-control form-control-lg", "required" ,"id"=>"cmb_subject_levels" ]) }}
                                </div>
                            </div>
                        @else
                            <div class="form-group row">
                                <label
                                    class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.level')}}</label>
                                <div class="col-lg-8">
                                    {{ Form::select('level_id',App\Models\Level::where('type','far_learn')->where('deleted','0')->pluck('name_ar','id'), $data->level_id
                                        ,["class"=>"form-control form-control-lg","placeholder"=>trans('s_admin.choose_level'), "required" ,"id"=>"cmb_levels" ]) }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn {{auth()->user()->button_color}} mr-2">{{trans('s_admin.edit')}}</button>
            </div>
        </form>
    </div>
@endsection
@section('scripts')

    <script src="{{ asset('js/create_episode_ajax.js') }}"></script>
    <script src="{{ asset('metronic/assets/js/pages/widgets.js') }}"></script>
    <script src="{{ asset('metronic/assets/js/pages/custom/profile/profile.js') }}"></script>

    <script src="{{url('/')}}/hijri/js/jquery-3.3.1.js"></script>
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
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>

    <script type="text/javascript">

        $(function () {
            // var code = "+966"; // Assigning value from model.
            var code = "{{$data->country_code}}";
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
            // console.log(code)
            // $("#txt_unique_name").keyup(function (event) {
            //     var txt_unique_name = $("#txt_unique_name").val('');
            //     txt_unique_name.replace(/\s/g, "") ;
            // });
        });
    </script>
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
    </script>
@endsection

