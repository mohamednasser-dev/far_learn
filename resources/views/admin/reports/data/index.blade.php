@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.nav_students_reports')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="javascript:void(0);" class="text-muted">{{trans('s_admin.nav_reports_and_stat')}}</a>
            </li>
        </ul>
    </div>
@endsection
@section('content')

    @php
        $user  = \auth()->user();
    @endphp
    <!--begin::Card-->
    <form class="form" method="get" action="{{route('reports.basic.search')}}">
        <div class="card card-custom example example-compact">
            {{--            @csrf    not used in get forms    --}}
            <div class="card-body">
                <div class="form-group row mt-3">
                    <div class="col-lg-3">
                        <label>{{trans('s_admin.student_name')}}</label>
                        <input type="text" name="student_name" class="form-control">
                    </div>

                    <div class="col-lg-3">
                        <label>{{trans('s_admin.phone')}}</label>
                        <input type="tel" name="phone" class="form-control">
                    </div>

                    <div class="col-lg-3">
                        <label>{{trans('s_admin.ident_num')}}</label>
                        <input type="text" name="ident_num" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3">
                        <label>{{trans('s_admin.nationality')}}</label>
                        {{ Form::select('nationality',App\Models\Nationality::where('deleted','0')->pluck('name_'.app()->getLocale(),'id'),null
                                                ,["class"=>"form-control form-control-lg","placeholder"=>trans('s_admin.choose_nationality')  ]) }}
                    </div>
                    <div class="col-lg-3">
                        <label>{{trans('s_admin.study_section')}}</label>
                        {{ Form::select('qualification',App\Models\Qualification::where('deleted','0')->pluck('name_'.app()->getLocale(),'id'),null
                                                ,["class"=>"form-control form-control-lg","placeholder"=>trans('s_admin.choose_qualification')  ]) }}
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="card card-custom example example-compact">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-lg-3">
                        <label>{{trans('admin.country')}}</label>
                        {{ Form::select('country',App\Models\Country::where('deleted','0')->pluck('name_'.app()->getLocale(),'id'),null
                                                ,["id"=>"cmb_country","class"=>"form-control form-control-lg","placeholder"=>trans('s_admin.choose_country')  ]) }}
                    </div>
                    <div class="col-lg-3">
                        <label id="lbl_zones_cont" style="display:none;">{{trans('s_admin.zones')}}</label>
                        <div id="zones_cont" style="display:none;">
                            {{ Form::select('zone_id',App\Models\Zone::where('deleted','0')->pluck('name_'.app()->getLocale(),'id'),null
                            ,["class"=>"form-control form-control-lg" ,"id"=>"cmb_zones" ]) }}
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <label id="lbl_cities_cont" style="display:none;">{{trans('s_admin.cities')}}</label>
                        <div id="city_cont" style="display:none;">
                            {{ Form::select('city_id',App\Models\City::where('deleted','0')->pluck('name_'.app()->getLocale(),'id'),null
                                                    ,["class"=>"form-control form-control-lg","placeholder"=>trans('s_admin.choose_city') ,"id"=>"cmb_cities" ]) }}
                        </div>
                    </div>


                    <div class="col-lg-3">
                        <label id="lbl_districts_cont" style="display:none;">{{trans('s_admin.district_S')}}</label>
                        <div id="districts_cont" style="display:none;">
                            {{ Form::select('district_id',App\Models\District::where('deleted','0')->pluck('name_'.app()->getLocale(),'id'),null
                                                     ,["class"=>"form-control form-control-lg" ,"id"=>"cmb_districts" ]) }}
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <br>
        <div class="card card-custom example example-compact">
            <div class="card-body">
                <div class="form-group row">
                    @if( $user->role_id == 2 )
                        <div class="col-lg-3">
                            <label>{{trans('s_admin.level')}}</label>

                            {{ Form::select('level_id',App\Models\Level::where('deleted','0')->pluck('name_'.app()->getLocale(),'id'),null
                                                    ,["class"=>"form-control form-control-lg","placeholder"=>trans('s_admin.choose_level') ,"id"=>"cmb_levels" ]) }}
                        </div>
                    @elseif($user->role_id == 3 || $user->role_id == 6  || $user->role_id == 5 || $user->role_id == 7 )
                        <div class="col-lg-3">
                            <label>{{trans('s_admin.level')}}</label>

                            {{ Form::select('level_id',App\Models\Level::where('type','mogmaa_dorr')->where('deleted','0')->pluck('name_'.app()->getLocale(),'id'),null
                                                    ,["class"=>"form-control form-control-lg","placeholder"=>trans('s_admin.choose_level') ,"id"=>"cmb_levels" ]) }}
                        </div>
                    @else
                        <div class="col-lg-3">
                            <label>{{trans('s_admin.level')}}</label>
                            {{ Form::select('level_id',App\Models\Level::where('type','far_learn')->where('deleted','0')->pluck('name_'.app()->getLocale(),'id'),null
                                                    ,["class"=>"form-control form-control-lg","placeholder"=>trans('s_admin.choose_level') ,"id"=>"cmb_levels" ]) }}
                        </div>
                    @endif

                    <div class="col-lg-3">
                        <label id="lbl_subject_cont" style="display:none;">{{trans('s_admin.subject')}}</label>
                        <div id="subject_cont" style="display:none;">
                            {{ Form::select('subject_id',App\Models\Subject::where('deleted','0')->pluck('name_'.app()->getLocale(),'id'),null
                                                    ,["class"=>"form-control form-control-lg", "required" ,"id"=>"cmb_subjects" ]) }}
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <label id="lbl_subject_level_cont"
                               style="display:none;">{{trans('s_admin.subject_level')}}</label>
                        <div id="subject_level_cont" style="display:none;">
                            {{ Form::select('subject_level_id',App\Models\Subject_level::where('deleted','0')->pluck('name_'.app()->getLocale(),'id'),null
                                                     ,["class"=>"form-control form-control-lg", "required" ,"id"=>"cmb_subject_levels" ]) }}
                        </div>
                    </div>

                </div>
                <div class="form-group row">
                    @if($user->role_id == 3 || $user->role_id == 6 || $user->role_id == 2 )
                        <div class="col-lg-3">
                            <label>{{trans('s_admin.with_mogamaa')}}</label>
                            {{ Form::select('college_id',$input_data['colleges_mogmaa'] ,null
                                                    ,["class"=>"form-control form-control-lg","placeholder"=>trans('s_admin.choose_college') ,"id"=>"cmb_college" ]) }}
                        </div>
                    @endif
                    @if($user->role_id == 5 || $user->role_id == 7 || $user->role_id == 2 )
                        <div class="col-lg-3">
                            <label>{{trans('s_admin.with_dorr')}}</label>
                            {{ Form::select('dorr_id',$input_data['colleges_dorr'],null
                                                    ,["class"=>"form-control form-control-lg","placeholder"=>trans('s_admin.choose_dorr')  ,"id"=>"cmb_dorr" ]) }}
                        </div>
                    @endif
                    @if($user->role_id != 8)
                        <div class="col-lg-3">
                            <label>{{trans('s_admin.with_episode')}}</label>
                            <div id="episodes_cont" style="display:none;">
                                {{ Form::select('episode_id',App\Models\Episode::where('deleted','0')->where('active','y')->pluck('name_'.app()->getLocale(),'id'),null
                                                         ,["class"=>"form-control form-control-lg","placeholder"=>trans('s_admin.choose_episode')  ,"id"=>"cmb_episodes" ]) }}
                            </div>
                        </div>
                    @else
                        <div class="col-lg-3">
                            <label>{{trans('s_admin.with_episode')}}</label>
                            <div id="episodes_cont">
                                {{ Form::select('episode_id', App\Models\Episode::where('deleted','0')->where('active','y')->where('type', 'mqraa')->pluck('name_'.app()->getLocale(),'id'),null
                                                         ,["class"=>"form-control form-control-lg","placeholder"=>trans('s_admin.choose_episode')  ,"id"=>"cmb_episodes" ]) }}
                            </div>
                        </div>
                    @endif

                </div>
                <div class="form-group row">
                    <div class="col-lg-3">
                        <label>{{trans('s_admin.student_status')}}</label>
                        <div class="radio-inline">
                            <label class="radio radio-solid">
                                <input type="radio" name="status" checked="checked" value="active">
                                <span></span>{{trans('s_admin.active')}}</label>
                            <label class="radio radio-solid">
                                <input type="radio" name="status" value="unactive">
                                <span></span>{{trans('s_admin.unactive')}}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="card card-custom example example-compact">
            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-5"></div>
                    <div class="col-lg-7">
                        <button type="submit" class="btn btn-primary mr-2">{{trans('s_admin.search')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <br>
    <div class="card card-custom">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-checkable" id="kt_datatable_button2">
                    <thead>
                    <tr>
                        <th title="Field #1">#</th>
                        <th title="Field #2">{{trans('s_admin.full_name')}}</th>
                        <th title="Field #3">{{trans('s_admin.email')}}</th>
                        <th title="Field #3">{{trans('s_admin.phone')}}</th>
                        <th title="Field #3">{{trans('s_admin.level')}}</th>
                        <th title="Field #3">{{trans('s_admin.district_S')}}</th>
                        <th title="Field #3">{{trans('s_admin.gender')}}</th>
                        <th title="Field #3">{{trans('s_admin.country')}}</th>
                        <th title="Field #3">{{trans('s_admin.ident_num')}}</th>
                        <th title="Field #3">{{trans('s_admin.nationality')}}</th>
                        <th title="Field #3">{{trans('s_admin.qualification')}}</th>
                        <th title="Field #3">{{trans('s_admin.date_of_birth')}}</th>
                        <th title="Field #3">{{trans('s_admin.subject')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    @foreach($data as $row)
                        <tr>
                            <td class="text-center"><?php echo $i; ?></td>
                            <td class="text-center">
                                {{$row->first_name_ar}} &nbsp; {{$row->mid_name_ar}} &nbsp; {{$row->last_name_ar}}
                            </td>
                            <td class="text-center">{{$row->email}}</td>
                            <td class="text-center">{{$row->phone}}</td>
                            <td class="text-center">
                                @if($row->level_id != null)
                                    @if(app()->getLocale() == 'ar')
                                        {{$row->Level->name_ar}}
                                    @else
                                        {{$row->Level->name_en}}
                                    @endif
                                @endif
                            </td>
                            <td class="text-center">
                                @if($row->district_id != null)
                                    @if(app()->getLocale() == 'ar')
                                        {{$row->District->name_ar}}
                                    @else
                                        {{$row->District->name_en}}
                                    @endif
                                @endif
                            </td>
                            <td class="text-center">
                                {{trans('admin.'.$row->gender)}}
                            </td>
                            <td class="text-center">
                                @if($row->country != null)
                                    @if(app()->getLocale() == 'ar')
                                        {{$row->Country->name_ar}}
                                    @else
                                        {{$row->Country->name_en}}
                                    @endif
                                @endif
                            </td>
                            <td class="text-center">
                                {{$row->ident_num}}
                            </td>
                            <td class="text-center">
                                @if($row->nationality != null)
                                    @if(app()->getLocale() == 'ar')
                                        {{$row->Nationality->name_ar}}
                                    @else
                                        {{$row->Nationality->name_en}}
                                    @endif
                                @endif
                            </td>
                            <td class="text-center">
                                {{$row->qualification}}
                            </td>
                            <td class="text-center">
                                {{$row->date_of_birth}}
                            </td>
                            <td class="text-center">
                                @if($row->subject_id != null)
                                    @if(app()->getLocale() == 'ar')
                                        {{$row->Subject->name_ar}}
                                    @else
                                        {{$row->Subject->name_en}}
                                    @endif
                                @endif
                            </td>
                            {{--                        <td @if(in_array('attendance_rate',$columns))  style="display: " @else style="display: none"--}}
                            {{--                            @endif  class="text-center">--}}
                            {{--                            {{$row->attendance_rate}}--}}
                            {{--                        </td>--}}
                        </tr>
                        <?php $i++; ?>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var table4 = $('#kt_datatable_button2');
        // begin first table
        table4.DataTable({
            bLengthChange: false,
            scrollX: true,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'print',
                    text: '{{trans("s_admin.print")}}',
                    className: 'btn btn-warning mr-2',
                    title: '',
                    customize: function (win) {
                        $(win.document.body)
                            .css('direction', 'rtl').prepend(
                            ' <table> ' +
                            '                        <tbody> ' +
                            '                                <tr>' +
                            '                                    <td style="text-align: center"><p>المملكة العربية السعودية</p> <p>وزارة الموارد البشرية والتنمية الاجتماعية</p> <p>الجمعية الخيرية لتحفيظ القرآن الكريم بمحافظه عنيزة</p></td>' +
                            '                                    <td style="text-align: right"> <img src="{{ App\Models\Web_setting::first()->logo_ar  }}" width="150px" height="150px" /> </td>' +
                            '                                    <td style="text-align: right"><p>عنوان التقرير : {{ trans("s_admin.nav_students_reports")  }}</p>' +
                            '                                                                  <p>تاريخ التقرير : {{ Carbon\Carbon::now()->translatedFormat('l Y/m/d') }}</p>' +
                            '                                                                  <p>وقت التقرير : {{ Carbon\Carbon::now()->translatedFormat('h:i a') }}</p></td>' +
                            '                                </tr> ' +
                            '                        </tbody>' +
                            '                    </table>'
                        );
                    },
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
                {
                    extend: 'excel',
                    text: '{{trans("s_admin.excel")}}',
                    className: 'btn btn-dark mr-2',
                    customize: function (win) {
                        $(win.document)
                            .css('direction', 'rtl');
                    },
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                }, {
                    extend: 'colvis',
                    text: '{{trans("s_admin.Columns_appear")}}',
                    className: 'btn btn-primary mr-2',
                    customize: function (win) {
                        $(win.document)
                            .css('direction', 'rtl');
                    }
                }

            ],
            columnDefs: [],
        });
    </script>
    <script src="{{ asset('js/basic_report_ajax.js') }}"></script>
    <script src="{{ asset('js/create_episode_ajax.js') }}"></script>

@endsection


