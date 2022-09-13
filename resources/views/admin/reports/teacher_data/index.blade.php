@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.nav_follow_current_chanel')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="javascript:void(0);" class="text-muted">{{trans('s_admin.nav_reports_and_stat')}}</a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    <!--begin::Card-->
    <div class="card card-custom example example-compact">
        <form class="form" method="get" action="{{route('reports.teacher.data.search')}}">

            <div class="card-body">
                <div class="form-group row mt-3">
                    <div class="col-lg-3">
                        <label>{{trans('s_admin.teacher_name')}}</label>
                        <input type="text" name="teacher_name" class="form-control">
                    </div>
                    <div class="col-lg-3">
                        <label>{{trans('s_admin.phone')}}</label>
                        <input type="tel" name="phone" class="form-control">
                    </div>
                    <div class="col-lg-3">
                        <label>{{trans('s_admin.ident_num')}}</label>
                        <input type="text" name="ident_num" class="form-control">
                    </div>
                    <div class="col-lg-3">
                        <label>{{trans('s_admin.nationality')}}</label>
                        {{ Form::select('nationality',App\Models\Nationality::where('deleted','0')->pluck('name_'.app()->getLocale(),'id'),null
                                                ,["class"=>"form-control form-control-lg","placeholder"=>trans('s_admin.choose_nationality')  ]) }}

                    </div>
                </div>
                <div class="form-group row">

                    <div class="col-lg-3">
                        <label>{{trans('s_admin.study_section')}}</label>
                        {{ Form::select('qualification',App\Models\Qualification::where('deleted','0')->pluck('name_'.app()->getLocale(),'id'),null
                                                ,["class"=>"form-control form-control-lg","placeholder"=>trans('s_admin.choose_qualification')  ]) }}
                    </div>
                    <div class="col-lg-3">
                        <label>{{trans('admin.country')}}</label>
                        {{ Form::select('country',App\Models\Country::where('deleted','0')->pluck('name_'.app()->getLocale(),'id'),null
                                                ,["class"=>"form-control form-control-lg","placeholder"=>trans('s_admin.choose_country')  ]) }}
                    </div>
                    <div class="col-lg-3">
                        <label>{{trans('s_admin.with_mogamaa')}}</label>
                        {{ Form::select('college_id',App\Models\College::where('type','college')->where('deleted','0')->pluck('name_'.app()->getLocale(),'id'),null
                                                ,["class"=>"form-control form-control-lg","placeholder"=>trans('s_admin.choose_college') ,"id"=>"cmb_college" ]) }}
                    </div>
                    <div class="col-lg-3">
                        <label>{{trans('s_admin.with_dorr')}}</label>
                        {{ Form::select('dorr_id',App\Models\College::where('type','dorr')->where('deleted','0')->pluck('name_'.app()->getLocale(),'id'),null
                                                ,["class"=>"form-control form-control-lg","placeholder"=>trans('s_admin.choose_dorr')  ,"id"=>"cmb_dorr" ]) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3" id="episodes_cont" style="display:none;">
                        <label id="lbl_episodes_cont" style="display:none;">{{trans('s_admin.with_episode')}}</label>
                        {{ Form::select('episode_id',App\Models\Episode::where('deleted','0')->where('active','y')->pluck('name_'.app()->getLocale(),'id'),null
                                                 ,["class"=>"form-control form-control-lg","placeholder"=>trans('s_admin.choose_episode')  ,"id"=>"cmb_episodes" ]) }}
                    </div>
                </div>
            </div>

            <div class="form-group" style="display: none">
                <label class="col-lg-3">{{trans('s_admin.Columns_appear')}}</label>
            </div>
            <div class="form-group row" style="display: none">

{{--                <label class="checkbox col-lg-2">--}}
{{--                    <input type="checkbox" name="columns[]" value="image"--}}
{{--                           @if( in_array('image',$columns)) checked @endif>--}}
{{--                    <span></span>{{trans('s_admin.image')}}</label>--}}

                <label class="checkbox col-lg-2">
                    <input type="checkbox" name="columns[]" value="first_name"
                           @if( in_array('first_name',$columns)) checked @endif>
                    <span></span>{{trans('admin.name')}}</label>
                <label class="checkbox col-lg-2">
                    <input type="checkbox" name="columns[]" value="email"
                           @if( in_array('email',$columns)) checked @endif>
                    <span></span>{{trans('s_admin.email')}}</label>
                <label class="checkbox col-lg-2">
                    <input type="checkbox" name="columns[]" value="phone"
                           @if( in_array('phone',$columns)) checked @endif>
                    <span></span>{{trans('s_admin.phone')}}</label>

                <label class="checkbox col-lg-2">
                    <input type="checkbox" name="columns[]" value="gender"
                           @if( in_array('gender',$columns)) checked @endif>
                    <span></span>{{trans('s_admin.gender')}}</label>
                <label class="checkbox col-lg-2">
                    <input type="checkbox" name="columns[]" value="country"
                           @if( in_array('country',$columns)) checked @endif>
                    <span></span>{{trans('s_admin.country')}}</label>
                <label class="checkbox col-lg-2">
                    <input type="checkbox" name="columns[]" value="ident_num"
                           @if( in_array('ident_num',$columns)) checked @endif>
                    <span></span>{{trans('s_admin.ident_num')}}</label>
                <label class="checkbox col-lg-2">
                    <input type="checkbox" name="columns[]" value="nationality"
                           @if( in_array('nationality',$columns)) checked @endif>
                    <span></span>{{trans('s_admin.nationality')}}</label>
                <label class="checkbox col-lg-2">
                    <input type="checkbox" name="columns[]" value="qualification"
                           @if( in_array('qualification',$columns)) checked @endif>
                    <span></span>{{trans('s_admin.qualification')}}</label>
                <label class="checkbox col-lg-2">
                    <input type="checkbox" name="columns[]" value="date_of_birth"
                           @if( in_array('date_of_birth',$columns)) checked @endif>
                    <span></span>{{trans('s_admin.date_of_birth')}}</label>
                <label class="checkbox col-lg-2">
                    <input type="checkbox" name="columns[]" value="job_name"
                           @if( in_array('job_name',$columns)) checked @endif>
                    <span></span>{{trans('admin.job_name')}}</label>


            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-5"></div>
                    <div class="col-lg-7">
                        <button type="submit" class="btn btn-primary mr-2">{{trans('s_admin.search')}}</button>
                    </div>
                </div>
            </div>
        </form>
        <!--end::Form-->
    </div>
    <div class="card card-custom">
        <div class="card-body">
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable_button2">
                <thead>
                <tr>
                    <th title="Field #1" style="width: 5%">#</th>


{{--                    <th title="Field #1"--}}
{{--                        style="width: 5%;display:  @if( in_array('image',$columns)) @else none @endif">{{trans('s_admin.image')}}</th>--}}
                    <th title="Field #2"
                        style="width: 10%;display:  @if( in_array('first_name',$columns)) @else none @endif">{{trans('admin.name')}}</th>
                    <th title="Field #3"
                        style="width: 10%;display:  @if( in_array('email',$columns)) @else none @endif">{{trans('s_admin.email')}}</th>
                    <th title="Field #3"
                        style="width: 10%;display:  @if( in_array('phone',$columns)) @else none @endif">{{trans('s_admin.phone')}}</th>
                    <th title="Field #3"
                        style="width: 10%;display:  @if( in_array('gender',$columns)) @else none @endif">{{trans('s_admin.gender')}}</th>
                    <th title="Field #3"
                        style="width: 10%;display:  @if( in_array('country',$columns)) @else none @endif">{{trans('s_admin.country')}}</th>
                    <th title="Field #3"
                        style="width: 10%;display:  @if( in_array('ident_num',$columns)) @else none @endif">{{trans('s_admin.ident_num')}}</th>
                    <th title="Field #3"
                        style="width: 10%;display:  @if( in_array('nationality',$columns)) @else none @endif">{{trans('s_admin.nationality')}}</th>
                    <th title="Field #3"
                        style="width: 10%;display:  @if( in_array('qualification',$columns)) @else none @endif">{{trans('s_admin.qualification')}}</th>
                    <th title="Field #3"
                        style="width: 10%;display:  @if( in_array('date_of_birth',$columns)) @else none @endif">{{trans('s_admin.date_of_birth')}}</th>
                    <th title="Field #3"
                        style="width: 10%;display:  @if( in_array('job_name',$columns)) @else none @endif">{{trans('admin.job_name')}}</th>


                    <th title="Field #3" style="width: 10%">{{trans('s_admin.job_name_history')}}</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @foreach($data as $row)
                    <tr>
                        <td class="text-center" style="width: 10%"><?php echo $i; ?></td>
{{--                        @if($row->image != null)--}}
{{--                            <td class="text-center"--}}
{{--                                style="width: 5%;display:  @if( in_array('image',$columns)) @else none @endif">--}}
{{--                                <span style="width: 250px;">--}}
{{--                                    <div class="d-flex align-items-center">--}}
{{--                                        <div class="symbol symbol-40 symbol-sm flex-shrink-0">--}}
{{--                                            <img class="" src="{{$row->image}}"--}}
{{--                                                 alt="photo">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </span>--}}
{{--                            </td>--}}
{{--                        @else--}}
{{--                            <td class="text-center"--}}
{{--                                style="width: 5%;display:  @if( in_array('image',$columns)) @else none @endif">--}}
{{--                                <span style="width: 250px;">--}}
{{--                                    <div class="d-flex align-items-center">--}}
{{--                                        <div class="symbol symbol-40 symbol-light-danger flex-shrink-0">--}}
{{--                                            <span class="symbol-label font-size-h4 font-weight-bold">--}}
{{--                                                @if(app()->getLocale() == 'ar')--}}
{{--                                                    {{$row->first_name_en[0]}}--}}
{{--                                                @else--}}
{{--                                                    {{$row->first_name_en[0]}}--}}
{{--                                                @endif--}}
{{--                                            </span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </span>--}}
{{--                            </td>--}}
{{--                        @endif--}}
                        <td class="text-center"
                            style="width: 10%;display:  @if( in_array('first_name',$columns)) @else none @endif">
                            {{$row->first_name_ar}} &nbsp; {{$row->mid_name_ar}} &nbsp; {{$row->last_name_ar}}
                        </td>
                        <td class="text-center"
                            style="width: 10%;display:  @if( in_array('email',$columns)) @else none @endif">{{$row->email}}</td>
                        <td class="text-center"
                            style="width: 10%;display:  @if( in_array('phone',$columns)) @else none @endif">{{$row->phone}}</td>
                        <td class="text-center"
                            style="width: 10%;display:  @if( in_array('gender',$columns)) @else none @endif">{{trans('admin.'.$row->gender)}}</td>
                        <td class="text-center"
                            style="width: 10%;display:  @if( in_array('country',$columns)) @else none @endif">
                            @if($row->country != null)
                                @if(app()->getLocale() == 'ar')
                                    {{$row->Country->name_ar}}
                                @else
                                    {{$row->Country->name_en}}
                                @endif
                            @endif</td>
                        <td class="text-center"
                            style="width: 10%;display:  @if( in_array('ident_num',$columns)) @else none @endif">{{$row->ident_num}}</td>
                        <td class="text-center"
                            style="width: 10%;display:  @if( in_array('nationality',$columns)) @else none @endif">
                            @if($row->nationality != null)
                                @if(app()->getLocale() == 'ar')
                                    {{$row->Nationality->name_ar}}
                                @else
                                    {{$row->Nationality->name_en}}
                                @endif
                            @endif</td>
                        <td class="text-center"
                            style="width: 10%;display:  @if( in_array('qualification',$columns)) @else none @endif">{{$row->qualification}}</td>
                        <td class="text-center"
                            style="width: 10%;display:  @if( in_array('date_of_birth',$columns)) @else none @endif">{{$row->date_of_birth}}</td>
                        <td class="text-center"
                            style="width: 10%;display:  @if( in_array('job_name',$columns)) @else none @endif">
                            @if($row->job_name != null)
                                @if(app()->getLocale() == 'ar')
                                    {{$row->Job->name_ar}}
                                @else
                                    {{$row->Job->name_en}}
                                @endif
                            @endif
                        </td>


                        <td class="text-center" style="width: 10%">
                            <a href="{{route('teacher.job_name.history', $row->id)}}"
                               class="btn btn-icon btn-primary btn-circle btn-sm mr-2">
                                <i class="icon-nm fas fa-hourglass-half" aria-hidden='true'></i>
                            </a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                @endforeach
                </tbody>
            </table>
            <!--end: Datatable-->
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/basic_report_ajax.js') }}"></script>
    <script src="{{ asset('js/create_episode_ajax.js') }}"></script>

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
                            '                                    <td style="text-align: right"><p>عنوان التقرير : {{trans('s_admin.nav_follow_current_chanel')}}  </p>' +
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
@endsection
