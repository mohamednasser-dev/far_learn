@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.nav_episodes_rates')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('reports.rates.epo_type')}}" class="text-muted">{{trans('s_admin.epo_gender')}}</a>
            </li>
        </ul>
    </div>
@endsection
@section('styles')
    <style>
        .checked {
            color: orange;
        }
    </style>
@endsection
@section('content')
    <div class="card card-custom example example-compact">
        <form class="form" method="get" action="{{route('reports.rates.search')}}">
            @csrf
            <div class="card-body">
                <div class="card-header">
                    {{trans('admin.search')}}
                </div>
                <div class="form-group row mt-3">
                    <div class="col-lg-3">
                        <label>{{trans('s_admin.episode_name')}}</label>
                        <div id="episodes_cont">
                            <select required name="episode_id" class="form-control select2"
                                    id="kt_select2_1" style="width: 100%">
                                <option disabled selected >{{trans('s_admin.choose_episode')}}</option>
                                @foreach($episodes as $row)
                                    @if(app()->getLocale() == 'ar')
                                        <option value="{{$row->id}}">
                                            &nbsp;{{$row->name_ar}}</option>
                                    @else
                                        <option value="{{$row->id}}">
                                            &nbsp;{{$row->name_en}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3"></div>
                    <div class="col-lg-3"></div>
                    <div class="col-lg-2">
                        <div class="col bg-light-warning px-6 py-8 rounded-xl mr-7 mb-7">
                            <span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
                                <svg
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"/>
                                            <path
                                                d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z"
                                                fill="#000000"/>
                                        </g>
                                    </svg><!--end::Svg Icon-->
                            </span>
                            <a href="#" class="text-warning font-weight-bold font-size-h6"> {{trans('s_admin.final_ratings')}} {{$total_rating}}</a>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
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
    <br>
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable_button2">
                <thead>
                <tr>
                    <th title="Field #1">#</th>
                    <th title="Field #2">{{trans('s_admin.episode_name')}}</th>
                    <th title="Field #1">{{trans('s_admin.question')}}</th>
                    <th title="Field #2">{{trans('s_admin.student_name')}}</th>
                    <th title="Field #2">{{trans('s_admin.teacher_name')}}</th>
                    <th title="Field #2">{{trans('s_admin.rating')}}</th>
                    <th title="Field #2">{{trans('s_admin.creation_date')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $key => $row)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td> @if(app()->getLocale() == 'ar' ){{$row->Episode->name_ar}} @else {{$row->Episode->name_en}} @endif </td>
                        <td> @if(app()->getLocale() == 'ar' ){{$row->Question->name_ar}} @else {{$row->Question->name_en}} @endif </td>
                        <td>{{$row->Student->user_name}}</td>
                        <td>{{$row->Teacher->user_name}}</td>
                        <td>
                            <div class="">
                                <span
                                    class="fa fa-star @if($row->rate == 1 || $row->rate == 2  || $row->rate == 3 || $row->rate == 4 || $row->rate == 5) checked @endif "></span>
                                <span
                                    class="fa fa-star @if( $row->rate == 2  || $row->rate == 3 || $row->rate == 4 || $row->rate == 5) checked @endif "></span>
                                <span
                                    class="fa fa-star @if( $row->rate == 3 || $row->rate == 4 || $row->rate == 5) checked @endif "></span>
                                <span class="fa fa-star @if($row->rate == 4 || $row->rate == 5) checked @endif "></span>
                                <span class="fa fa-star @if($row->rate == 5) checked @endif "></span>
                                <span style="display: none"> {{$row->rate}} </span>
                            </div>
                        </td>
                        <td>{{$row->created_at->format('Y-m-d')}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
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
                            '                                    <td style="text-align: right"><p>عنوان التقرير : {{ trans("s_admin.nav_episodes_rates")  }}</p>' +
                            '                                                                  <p>تاريخ التقرير : {{ Carbon\Carbon::now()->translatedFormat('l Y/m/d') }}</p>' +
                            '                                                                  <p>وقت التقرير : {{ Carbon\Carbon::now()->translatedFormat('h:i a') }}</p></td>' +
                            '                                </tr> ' +
                            '                        </tbody>' +
                            '                    </table>'
                        );
                    },
                    exportOptions: {
                        columns: [0, ':visible'],
                        stripHtml : false,
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
                        columns: [0, ':visible'],

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
