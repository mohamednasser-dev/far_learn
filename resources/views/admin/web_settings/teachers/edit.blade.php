@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.edit')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                @if($data->is_new == 'y')
                    <a href="{{route('teacher.new_join')}}" class="text-muted">{{trans('s_admin.new_teachers')}}</a>
                @elseif($data->epo_type == 'far_learn')
                    <a href="{{url('/teacher_settings/far_learn')}}" class="text-muted">{{trans('s_admin.nav_teachers_far_learn')}}</a>
                @elseif($data->epo_type == 'mogmaa')
                    <a href="{{url('/teacher_settings/mogmaa')}}" class="text-muted">{{trans('s_admin.nav_teachers_mogmaa')}}</a>
                @elseif($data->epo_type == 'dorr')
                    <a href="{{url('/teacher_settings/dorr')}}" class="text-muted">{{trans('s_admin.nav_teachers_dorr')}}</a>
                @else
                    <a href="{{route('teacher.new_join')}}" class="text-muted">{{trans('s_admin.new_teachers')}}</a>
                @endif
            </li>
            <li class="breadcrumb-item">
                <a href="javascript:void(0);" class="text-muted">{{trans('s_admin.nav_teacher_shoan_settings')}}</a>
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
            <h3 class="card-title">{{trans('s_admin.edit_teacher')}}</h3>
        </div>
        <form class="form" action="{{route('teacher_settings.update',$data->id )}}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">{{trans('admin.first_name')}}</label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <input type="text" value="{{$data->first_name_ar}}" required class="form-control"
                               name="first_name_ar">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">{{trans('admin.mid_name')}}</label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <input type="text" value="{{$data->mid_name_ar}}" required class="form-control"
                               name="mid_name_ar">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">{{trans('admin.last_name')}}</label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <input type="text" value="{{$data->last_name_ar}}" required class="form-control"
                               name="last_name_ar">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">{{trans('admin.email')}}</label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <input type="email" value="{{$data->email}}" required class="form-control" name="email">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">{{trans('admin.phone')}}</label>
                    <div class="col-lg-3 col-md-2 col-sm-2">
                        <input type="number" onkeyup="this.value=phonelimit(this.value);" required value="{{$data->phone}}" class="form-control" name="phone">
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-1">
                        <input id="txt_country_code" value="{{$data->country_code}}"
                               class="form-control" required
                               type="text" name="country_code"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">{{trans('admin.password')}}</label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>
                <div class="form-group row">
                    <label
                        class="col-form-label text-right col-lg-3 col-sm-12">{{trans('admin.password_confirmation')}}</label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <input type="password" class="form-control" name="password_confirmation">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12"
                           style="padding-top: 40px;">{{trans('s_admin.bio')}}</label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <p class="form-control-plaintext text-muted">{{trans('s_admin.arabic')}}</p>
                        <textarea name="bio_ar" class="form-control" id="exampleTextarea"
                                  rows="3"> {{$data->bio_ar}} </textarea>
                    </div>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <p class="form-control-plaintext text-muted">{{trans('s_admin.english')}}</p>
                        <textarea name="bio_en" class="form-control" id="exampleTextarea"
                                  rows="3"> {{$data->bio_en}} </textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">{{trans('s_admin.i_pan')}}</label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <input type="tel" class="form-control" name="i_pan" value="{{$data->i_pan}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">{{trans('s_admin.ident_num')}}</label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <input type="number" required class="form-control" name="ident_num"
                               value="{{$data->ident_num}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">{{trans('admin.lang')}}</label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <select name="main_lang" class="form-control form-control-lg" value="{{$data->main_lang}}">
                            <option>{{trans('s_admin.choose_language')}}</option>
                            <option value="en" @if($data->main_lang == 'en') selected @endif >English</option>
                            <option value="ar" @if($data->main_lang == 'ar') selected @endif >العربية</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">{{trans('admin.date_of_birth')}}</label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <input id="txt_date" type="date" required
                               value="{{Carbon\Carbon::parse($data->date_of_birth)->format('Y-m-d')}}"
                               name="date_of_birth" class="form-control hijri-date-input">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">{{trans('admin.gender')}}</label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <select required name="gender" class="form-control form-control-lg" id="exampleSelectl">
                            @if($data->gender == 'male')
                                <option selected value="male">{{trans('admin.male')}}</option>
                            @else
                                <option value="male">{{trans('admin.male')}}</option>
                            @endif
                            @if($data->gender == 'female')
                                <option selected value="female">{{trans('admin.female')}}</option>
                            @else
                                <option value="female">{{trans('admin.female')}}</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">{{trans('s_admin.epo_type')}}</label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <select required name="epo_type" class="form-control form-control-lg"
                                id="exampleSelectl">
                            <option @if($data->epo_type == 'far_learn') selected
                                    @endif value="far_learn">{{trans('s_admin.far_learn')}}</option>
                            <option @if($data->epo_type == 'dorr' || $data->epo_type == 'mogmaa') selected
                                    @endif value="mogmaa_dorr">{{trans('s_admin.mogmaa_dorr')}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">{{trans('admin.country')}}</label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        @php $country = App\Models\Country::where('deleted','0')->get(); @endphp
                        <select id="country" name="country" required class="form-control custom-select">
                            <option>{{trans('s_admin.choose_country')}}</option>
                            @foreach($country as $row)
                                @if($data->country == $row->id)
                                    <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                @else
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label
                        class="col-form-label text-right col-lg-3 col-sm-12">{{trans('s_admin.qualification')}}</label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        @php $qualification = App\Models\Qualification::where('deleted','0')->get(); @endphp
                        <select id="qualification" name="qualification" required class="form-control custom-select">
                            <option>{{trans('s_admin.choose_qualification')}}</option>
                            @foreach($qualification as $row)
                                @if($data->qualification == $row->id)
                                    <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                @else
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">{{trans('s_admin.nationality')}}</label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        @php $nationality = App\Models\Nationality::where('deleted','0')->get(); @endphp
                        <select id="nationality" name="nationality" required class="form-control custom-select">
                            <option>{{trans('s_admin.choose_nationality')}}</option>
                            @foreach($nationality as $row)
                                @if($data->nationality == $row->id)
                                    <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                @else
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">{{trans('admin.job_name')}}</label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        @php $job_names = \App\Models\Job_name::where('deleted','0')->get(); @endphp
                        <select id="job_name" name="job_name" required class="form-control custom-select">
                            {{--                            <option >{{trans('s_admin.choose_Job_name')}}</option>--}}
                            @foreach($job_names as $row)
                                @if($data->job_name == $row->id)
                                    <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                @else
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success mr-2">{{trans('s_admin.edit')}}</button>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/create_episode_ajax.js') }}"></script>
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

