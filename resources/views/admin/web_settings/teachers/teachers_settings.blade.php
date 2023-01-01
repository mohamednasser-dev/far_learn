@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        @if(request()->segment(1) != 'mail' && request()->segment(1) != 'incoming')
            @if(request()->segment(2) == 'far_learn')
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.nav_teachers_far_learn')}}</h5>
            @elseif(request()->segment(2) == 'mogmaa')
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.nav_teachers_mogmaa')}}</h5>
            @elseif(request()->segment(2) == 'dorr')
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.nav_teachers_dorr')}}</h5>
            @elseif(request()->segment(2) == 'new_join')
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.new_teachers')}}</h5>
            @endif
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
            <ul class="breadcrumb brphonelimiteadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);" class="text-muted">{{trans('s_admin.nav_teacher_shoan_settings')}}</a>
                </li>
            </ul>
        @else
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.nav_com_mail')}}</h5>
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);" class="text-muted">{{trans('s_admin.nav_mail')}}</a>
                </li>
            </ul>
        @endif
    </div>
@endsection
@section('styles')
    <style>
        .table thead td, .table thead th {
            font-weight: bold;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css"/>
    <link href="{{url('/')}}/hijri/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
@endsection
@section('content')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                {{--                @can("add")--}}
                @if(request()->segment(1) != 'mail' && request()->segment(1) != 'incoming' && request()->segment(2) != 'new_join' && Route::current()->getName() != 'teachers.new')
                    <a data-toggle="modal" data-target="#add_new_teacher"
                       class="btn {{auth()->user()->button_color}} px-6 font-weight-bold"><i
                            class="flaticon2-plus"></i> {{trans('s_admin.add_new_teacher')}}</a>
                @endif
                {{--                @endcan--}}
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                <thead>
                <tr>
                    <th title="Field #1">#</th>
                    <th title="Field #2">{{trans('s_admin.image')}}</th>
                    <th title="Field #2" style="width: 10%">{{trans('s_admin.name')}}</th>
                    <th title="Field #2" style="width: 10%">{{trans('s_admin.phone')}}</th>
                    <th title="Field #3" style="width: 10%">{{trans('s_admin.type')}}</th>
                    <th title="Field #6">{{trans('s_admin.join_orders')}}</th>
                    <th title="Field #6">{{trans('s_admin.make_interview')}}</th>
                    <th title="Field #6">{{trans('s_admin.activation')}}</th>
                    <th title="Field #7">{{trans('s_admin.chooses')}}</th>
                    <th title="Field #7">{{trans('s_admin.show_teacher_out_web')}}</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @foreach($data as $key => $row)
                    <tr>
                        <td>{{$key + 1}}</td>
                        @if($row->image != null)
                            <td class="text-center">
                                <span style="width: 250px;">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40 symbol-sm flex-shrink-0">
                                            <img class="" src="{{$row->image}}" alt="photo">
                                        </div>
                                    </div>
                                </span>
                            </td>
                        @else
                            <td class="text-center">
                                <span style="width: 250px;">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40 symbol-light-danger flex-shrink-0">
                                            <span
                                                class="symbol-label font-size-h4 font-weight-bold">{{$row->first_name_en[0]}}</span>
                                        </div>
                                    </div>
                                </span>
                            </td>
                        @endif
                        <td class="text-center">
                            @if(app()->getLocale() == 'ar')
                                {{$row->first_name_ar}} {{$row->mid_name_ar}}
                            @else
                                {{$row->first_name_en}} {{$row->mid_name_en}}
                            @endif
                        </td>
                        <td class="text-center" style="direction: ltr;">
                            {{$row->user_phone}}
                        </td>
                        <td class="text-center" style="width: 10%">
                            @if($row->epo_type == 'far_learn')
                                {{trans('s_admin.far_learn')}}
                            @elseif($row->epo_type == 'dorr')
                                {{trans('s_admin.dorr')}}
                            @elseif($row->epo_type == 'mogmaa')
                                {{trans('s_admin.mogmaa')}}
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                @if($row->is_new == 'y')
                                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        {{trans('s_admin.new')}}
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                           href="{{route('teacher.accept',$row->id)}}">{{trans('s_admin.accept')}}</a>
                                        <a class="dropdown-item"
                                           href="{{route('teacher.reject',$row->id)}}">{{trans('s_admin.reject')}}</a>
                                    </div>
                                @elseif($row->is_new == 'accepted')
                                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        {{trans('s_admin.accepted')}}
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                           href="{{route('teacher.reject',$row->id)}}">{{trans('s_admin.reject')}}</a>
                                    </div>
                                @elseif($row->is_new == 'rejected')
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        {{trans('s_admin.rejected')}}
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                           href="{{route('teacher.accept',$row->id)}}">{{trans('s_admin.accept')}}</a>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="text-center">
                            <a href="{{route('teacher.show.interviews',$row->id)}}"
                               class="btn btn-icon btn-success btn-circle btn-sm mr-2">
                                <i class="icon-md fas fa-phone" aria-hidden='true'></i>
                            </a>
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
                        <td class="text-center" nowrap="nowrap">
                            <a href="{{route('teacher_settings.edit',$row->id)}}"
                               class="btn btn-icon btn-primary btn-circle btn-sm mr-2">
                                <i class="icon-md fas fa-pencil-alt" aria-hidden='true'></i>
                            </a>
                            <a onclick="return confirm('{{trans('s_admin.are_y_sure_delete')}}')"
                               href="{{route('teacher_settings.destroy',$row->id)}}"
                               class='btn btn-icon btn-danger btn-circle btn-sm mr-2'><i class="icon-nm fas fa-trash"
                                                                                         aria-hidden='true'></i></a>

                        </td>
                        <td class="text-center" nowrap="nowrap">
                            @if($row->member == 0)
                                <a href="{{route('teacher_settings.make_member',$row->id)}}" data-toggle="tooltip"
                                   data-theme="dark" title="{{trans('s_admin.this_teache_not_appear_web')}}"
                                   class="btn btn-icon btn-light-dark btn-circle btn-sm mr-2">
                                    <i class="icon-md far fa-user" aria-hidden='true'></i>
                                </a>
                            @else
                                <a data-toggle="tooltip" data-theme="dark"
                                   title="{{trans('s_admin.this_teache_appear_web')}}"
                                   href="{{route('teacher_settings.make_member',$row->id)}}"
                                   class="btn btn-icon btn-warning btn-circle btn-sm mr-2">
                                    <i class="icon-md fas fa-user" aria-hidden='true'></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                    <?php $i++; ?>
                @endforeach
                </tbody>
            </table>
            <!--end: Datatable-->
        </div>
    </div>
    {{--    teacher create new --}}
    <div class="modal fade" id="add_new_teacher" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="t*ue">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.add_new_teacher')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open( ['route'  => ['store_new_teacher'],'method'=>'post','files'=>true] ) }}
                    <div class="card-body">
                        {{--                        <div class="form-group row">--}}
                        {{--                            <label  class="col-lg-4 col-form-label text-lg-right">{{trans('admin.user_name')}}</label>--}}
                        {{--                            <div class="col-lg-8">--}}
                        {{--                                <input type="text" required  class="form-control" onkeyup="this.value=removeSpaces(this.value);" name="unique_name">--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('admin.first_name')}}</label>
                            <div class="col-lg-8">
                                <input type="text" value="{{old('first_name_ar')}}" required class="form-control"
                                       name="first_name_ar">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('admin.mid_name')}}</label>
                            <div class="col-lg-8">
                                <input type="text" value="{{old('mid_name_ar')}}" required class="form-control"
                                       name="mid_name_ar">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('admin.last_name')}}</label>
                            <div class="col-lg-8">
                                <input type="text" value="{{old('last_name_ar')}}" required class="form-control"
                                       name="last_name_ar">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('admin.email')}}</label>
                            <div class="col-lg-8">
                                <input type="email" value="{{old('email')}}" required class="form-control" name="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('admin.phone')}}</label>
                            <div class="col-lg-6">
                                {{--                                onkeyup="this.value=phonelimit(this.value);"--}}
                                <input type="number" value="{{old('phone')}}"
                                       onkeyup="this.value=phonelimit(this.value);" required class="form-control"
                                       name="phone">
                            </div>
                            <div class="col-lg-2">
                                <input id="txt_country_code" value="{{old('country_code')}}" class="form-control"
                                       type="text" name="country_code"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('admin.password')}}</label>
                            <div class="col-lg-8">
                                <input type="password" required class="form-control" name="password" minlength="8">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-lg-4 col-form-label text-lg-right">{{trans('admin.password_confirmation')}}</label>
                            <div class="col-lg-8">
                                <input type="password" required class="form-control" name="password_confirmation"
                                       minlength="8">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.ident_num')}}</label>
                            <div class="col-lg-8">
                                <input type="number" required value="{{old('ident_num')}}" class="form-control"
                                       name="ident_num">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-lg-4 col-form-label text-lg-right">{{trans('admin.date_of_birth')}}</label>
                            <div class="col-lg-8">
                                <input id="txt_date" value="{{old('date_of_birth')}}" type="text" required
                                       name="date_of_birth"
                                       class="form-control hijri-date-input">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('admin.main_lang')}}</label>
                            <div class="col-lg-8">
                                <select id="txt_lang" class="form-control custom-select" required name="main_lang">
                                    <option value="en" @if(old('main_lang') == 'en') selected @endif >English</option>
                                    <option value="ar" @if(old('main_lang') == 'ar') selected @endif >العربية</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('admin.gender')}}</label>
                            <div class="col-lg-8">
                                <select required name="gender" class="form-control form-control-lg" id="exampleSelectl">
                                    <option value="male" @if(request()->segment(2) == 'dorr' ) disabled
                                            @elseif(request()->segment(2) == 'mogmaa'  || old('main_lang') == 'male"') selected @endif >{{trans('admin.male')}}</option>
                                    <option value="female"
                                            @if(request()->segment(2) == 'dorr'  || old('main_lang') == 'female') selected
                                            @elseif(request()->segment(2) == 'mogmaa') disabled @endif >{{trans('admin.female')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-right col-lg-4 col-sm-12">{{trans('admin.country')}}</label>
                            <div class="col-lg-8">
                                <select id="kt_select2_1" name="country" required class="form-control custom-select" style="width: 100%" >
                                    <option>{{trans('s_admin.choose_country')}}</option>
                                    @foreach(App\Models\Country::where('deleted','0')->get() as $row)
                                            <option value="{{$row->id}}" @if(old('country') == $row->id) selected @endif >{{$row->name}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-right col-lg-4 col-sm-12">{{trans('s_admin.nationality')}}</label>
                            <div class="col-lg-8">
                                <select id="kt_select2_3" name="nationality" required class="form-control custom-select" style="width: 100%" >
                                    <option disabled selected >{{trans('s_admin.choose_nationality')}}</option>
                                    @foreach(App\Models\Nationality::where('deleted','0')->get() as $row)
                                        <option value="{{$row->id}}" @if(old('nationality') == $row->id) selected @endif >{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-form-label text-right col-lg-4 col-sm-12">{{trans('s_admin.qualification')}}</label>
                            <div class="col-lg-8">
                                <select id="kt_select2_2" name="qualification" required class="form-control custom-select" style="width: 100%" >
                                    <option disabled selected >{{trans('s_admin.choose_qualification')}}</option>
                                    @foreach(App\Models\Qualification::where('deleted','0')->get() as $row)
                                            <option value="{{$row->id}}" @if(old('qualification') == $row->id) selected @endif >{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label text-right col-lg-4 col-sm-12">{{trans('admin.job_name')}}</label>
                            <div class="col-lg-8">
                                <select id="kt_select2_4" name="job_name" required class="form-control custom-select seelect2" style="width: 100%" >
                                <option disabled selected > {{ trans('s_admin.choose_Job_name')}} </option>
                                @foreach(\App\Models\Job_name::where('deleted','0')->get() as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.cv')}}</label>
                            <div class="col-lg-8">
                                <input type="file" class="custom-file-input" name="cv" accept=".pdf"/>
                                <label class="custom-file-label"
                                       for="customFile">{{trans('s_admin.choose_file_pdf')}}</label>
                            </div>
                        </div>
                        @if(request()->segment(2) == 'far_learn')
                            <input type="hidden" name="epo_type" value="far_learn">
                        @else
                            <input type="hidden" name="epo_type" value="mogmaa_dorr">
                        @endif
                        {{--                        <div class="form-group row">--}}
                        {{--                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.epo_type')}}</label>--}}
                        {{--                            <div class="col-lg-8">--}}
                        {{--                                <select required name="epo_type" class="form-control form-control-lg"--}}
                        {{--                                        id="exampleSelectl">--}}
                        {{--                                    <option value="far_learn">{{trans('s_admin.far_learn')}}</option>--}}
                        {{--                                    <option value="mogmaa_dorr">{{trans('s_admin.mogmaa_dorr')}}</option>--}}
                        {{--                                </select>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
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
@endsection
@section('scripts')
    {{--    for date of birth--}}
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
            // console.log(code)
            // $("#txt_unique_name").keyup(function (event) {
            //     var txt_unique_name = $("#txt_unique_name").val('');
            //     txt_unique_name.replace(/\s/g, "") ;
            // });
        });

        function update_active(el) {
            if (el.checked) {
                var status = 'active';
            } else {
                var status = 'unactive';
            }
            $.post('{{ route('teacher_settings.actived') }}', {
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

        function removeSpaces(string) {
            return string.split(' ').join('');
        }
    </script>
    <script>
        function phonelimit(string) {
            var first_string = string.substring(0);
            var int_string = parseInt(first_string);
            if (int_string == 0) {
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
