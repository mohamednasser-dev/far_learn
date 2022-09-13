@extends('student.student_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.search_cont_chanel')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    </div>
@endsection
@section('styles')
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    {{--    <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>--}}
@endsection
@section('content')
    <section>
        <div class="w-100 pt-120 pb-260 position-relative">
            <div class="container">
                <div class="post-detail-wrap w-100">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card card-custom gutter-b">
                                <div class="card card-custom bg-success">
                                    <div class="card-header border-0">
                                        <div class="card-title">
                                            <h3 class="card-label text-white">{{trans('s_admin.search_methods')}}</h3>
                                        </div>
                                    </div>
                                </div>
                                {{ Form::open( ['route'  => ['search.episodes'],'method'=>'get' , 'class'=>'form'] ) }}
                                <div class="card-body px-5">
                                    <div class="d-flex justify-content-between flex-column pt-4 h-100">
                                        <!--begin::Container-->
                                        <div class="pb-5">
                                            <!--begin::Compose-->
                                            <div class="px-4 mt-4 mb-10">
                                                <button type="submit"
                                                        class="btn btn-block btn-primary py-4 px-6 text-center">
                                                    {{trans('s_admin.search')}}
                                                </button>
                                            </div>
                                            <!--end::Compose-->
                                            <!--begin::Navigations-->
                                            <div
                                                class="navi navi-hover navi-active navi-link-rounded navi-bold navi-icon-center navi-light-icon">
                                                <div class="card-body pt-15">
                                                    <div class="form-group">
                                                        <h4 style="font-weight: bold;">{{trans('s_admin.teacher_name')}}</h4>
                                                        <input type="text" name="teacher_name" class="form-control form-control-lg"
                                                               value="{{Request::get('teacher_name')}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <h4 style="font-weight: bold;">{{trans('s_admin.level')}}</h4>
                                                        <div class="radio-list">
                                                            @php $levels = \App\Models\Level::where('type','far_learn')->where('deleted','0')->get(); @endphp
                                                            @foreach($levels as $row)
                                                                <label class="radio">
                                                                    <input type="radio"
                                                                           @if(Request::get('level_id') == $row->id ) checked="checked"
                                                                           @endif
                                                                           value="{{$row->id}}" name="level_id">
                                                                    <span></span>
                                                                    @if(app()->getLocale() == 'ar')
                                                                        {{$row->name_ar}}
                                                                    @else
                                                                        {{$row->name_en}}
                                                                    @endif
                                                                </label>
                                                            @endforeach
                                                            <label class="radio">
                                                                <input type="radio"
                                                                       @if(Request::get('level_id') == "on"  || Request::get('gender') == null) checked="checked"
                                                                       @endif   name="level_id">
                                                                <span></span>{{trans('s_admin.all')}}</label>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <h4 style="font-weight: bold;">{{trans('s_admin.gender')}}</h4>
                                                        <div class="radio-list">
                                                            <label class="radio">
                                                                <input type="radio" value="male"
                                                                       @if(Request::get('gender') == "male" ) checked="checked"
                                                                       @endif name="gender">
                                                                <span></span>{{trans('s_admin.male_only')}}</label>
                                                            <label class="radio">
                                                                <input type="radio" value="female"
                                                                       @if(Request::get('gender') == "female" ) checked="checked"
                                                                       @endif name="gender">
                                                                <span></span>{{trans('s_admin.female_only')}}</label>
{{--                                                            <label class="radio">--}}
{{--                                                                <input type="radio" value="children"--}}
{{--                                                                       @if(Request::get('gender') == "children" ) checked="checked"--}}
{{--                                                                       @endif name="gender">--}}
{{--                                                                <span></span>{{trans('s_admin.children_only')}}</label>--}}
                                                            <label class="radio">
                                                                <input type="radio"
                                                                       @if(Request::get('gender') == 'on' || Request::get('gender') == null) checked="checked"
                                                                       @endif name="gender">
                                                                <span></span>{{trans('s_admin.all')}}</label>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <h4 style="font-weight: bold;">{{trans('s_admin.teacher_talk')}}</h4>
                                                        <div class="radio-list">
                                                            <label class="radio">
                                                                <input type="radio" value="ar"
                                                                       @if(Request::get('language') == "ar"  || Request::get('language') == null ) checked="checked"
                                                                       @endif  name="language">
                                                                <span></span>{{trans('s_admin.arabic')}}
                                                            </label>
                                                            <label class="radio">
                                                                <input type="radio" value="en"
                                                                       @if(Request::get('language') == "en" ) checked="checked"
                                                                       @endif name="language">
                                                                <span></span>{{trans('s_admin.english')}}
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    {{--                                                    <div class="form-group">--}}
                                                    {{--                                                        <h4 style="font-weight: bold;">{{trans('s_admin.tall_line')}}</h4>--}}
                                                    {{--                                                        <div class="radio-list">--}}
                                                    {{--                                                            <label class="radio">--}}
                                                    {{--                                                                <input type="radio" checked name="place">--}}
                                                    {{--                                                                <span></span> {{trans('s_admin.not_want_place')}}--}}
                                                    {{--                                                            </label>--}}
                                                    {{--                                                            <label class="radio">--}}
                                                    {{--                                                                <input type="radio" name="place">--}}
                                                    {{--                                                                <span></span>{{trans('s_admin.want_to_determind')}}--}}
                                                    {{--                                                            </label>--}}
                                                    {{--                                                        </div>--}}
                                                    {{--                                                    </div>--}}
                                                    {{--                                                    <hr>--}}
                                                    <div class="form-group">
                                                        <h4 style="font-weight: bold;">{{trans('s_admin.study_cost')}}</h4>
                                                        <div class="radio-list">
                                                            <label class="radio">
                                                                <input type="radio" value="free"
                                                                       @if(Request::get('cost') == "free" ) checked="checked"
                                                                       @endif  name="cost">
                                                                <span></span>{{trans('s_admin.free_epo')}}
                                                            </label>
                                                            <label class="radio">
                                                                <input type="radio" value="cost"
                                                                       @if(Request::get('cost') == "cost" ) checked="checked"
                                                                       @endif name="cost">
                                                                <span></span>{{trans('s_admin.epo_with_cost')}}
                                                            </label>
                                                            <label class="radio">
                                                                <input type="radio"
                                                                       @if(Request::get('cost') == 'on' || Request::get('cost') == null  ) checked="checked"
                                                                       @endif name="cost">
                                                                <span></span>{{trans('s_admin.all_epo')}}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card card-custom bg-primary">
                                <div class="card-header border-0">
                                    <div class="card-title">
                                <span class="card-icon">
                                    <i class="flaticon2-search-1 text-white"></i>
                                </span>
                                        <h3 class="card-label text-white">{{trans('s_admin.search_result')}}</h3>
                                    </div>
                                </div>
                            </div>
                            <br>
                            @foreach($data as $row)
                                <div class="card card-custom gutter-b">
                                    <div class="card-body">
                                        <!--begin::Top-->
                                        <div class="row">

                                            <!--begin::Pic-->
                                            <div class="flex-shrink-0 col-lg-3">
                                                <div class="symbol symbol-50 symbol-lg-120 mt-10">
                                                    @if($row->Teacher)
                                                        @if($row->Teacher->image == null)
                                                            <img alt="Pic"
                                                                 src="{{ asset('uploads/teachers/default_avatar.jpg') }}">
                                                        @else
                                                            <img alt="Pic" src="{{url($row->Teacher->image)}}">
                                                        @endif
                                                    @else
                                                        <img alt="Pic"
                                                             src="{{ asset('uploads/teachers/default_avatar.jpg') }}">
                                                    @endif
                                                </div>
                                            </div>
                                            <!--end::Pic-->
                                            <!--begin: Info-->
                                            <div class="col-lg-9">

                                                <!--begin::Title-->
                                                <div
                                                    class="d-flex align-items-center justify-content-between flex-wrap mt-2">
                                                    <!--begin::User-->
                                                    <div class="mr-3">
                                                        <!--begin::Name-->
                                                        @if($row->Teacher)
                                                            <a href="{{route('student.episode.teacher_info',$row->teacher_id)}}"
                                                               class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">
                                                                @if( app()->getLocale() == 'ar' )
                                                                    {{$row->Teacher->first_name_ar}}  {{$row->Teacher->mid_name_ar}}
                                                                @else
                                                                    {{$row->Teacher->first_name_en}} {{$row->Teacher->mid_name_en}}
                                                                @endif
                                                                <i class="flaticon2-correct text-success icon-md ml-2"></i></a>
                                                    @endif
                                                    <!--end::Name-->
                                                        <!--begin::Contacts-->

                                                        <!--end::Contacts-->
                                                    </div>
                                                    <!--begin::User-->
                                                    <!--begin::Actions-->
                                                    <div class="my-lg-0 my-1">
                                                        <h4>{{trans('s_admin.teacher_eposide')}}</h4>
                                                    </div>
                                                    <!--end::Actions-->
                                                </div>
                                                <!--end::Title-->
                                                <!--begin::Content-->

                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-hover table-checkable"
                                                           id="kt_datatable1">
                                                        <thead class="bg-success">
                                                        <tr>
                                                            <th scope="col"
                                                                style="font-size: 12px;">{{trans('s_admin.episode_name')}}</th>
                                                            @if($row->type == 'mogmaa' || $row->type == 'dorr')
                                                                <th scope="col"
                                                                    style="font-size: 12px;">{{trans('s_admin.mogmaa_name')}}</th>
                                                            @endif
                                                            <th scope="col"
                                                                style="font-size: 12px;">{{trans('s_admin.gender')}}</th>
                                                            <th scope="col"
                                                                style="font-size: 12px;">{{trans('s_admin.want_num')}}</th>
                                                            <th scope="col"
                                                                style="font-size: 12px;">{{trans('s_admin.student_number')}}</th>
                                                            <th scope="col"
                                                                style="font-size: 12px;">{{trans('s_admin.monthly_cost')}}</th>
                                                            <th scope="col"
                                                                style="font-size: 12px;">{{trans('s_admin.details')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        <tr>
                                                            <th scope="row">
                                                                @if( app()->getLocale() == 'ar' )
                                                                    {{$row->name_ar}}
                                                                @else
                                                                    {{$row->name_en}}
                                                                @endif
                                                            </th>
                                                            @if($row->type == 'mogmaa' || $row->type == 'dorr')
                                                                <td>
                                                                    @if( app()->getLocale() == 'ar' )
                                                                        {{$row->Mogmaa->name_ar}}
                                                                    @else
                                                                        {{$row->Mogmaa->name_en}}
                                                                    @endif
                                                                </td>
                                                            @endif
                                                            <td>
                                                                @if( $row->gender == 'female' )
                                                                    {{trans('s_admin.female_only')}}
                                                                @elseif($row->gender == 'male')
                                                                    {{trans('s_admin.male_only')}}
                                                                @else
                                                                    {{trans('s_admin.children_only')}}
                                                                @endif
                                                            </td>
                                                            <td>{{$row->student_number}}</td>
                                                            <td>{{count($row->Students)}}</td>
                                                            <td>
                                                                @if($row->cost == 'free')
                                                                    {{trans('s_admin.free')}}
                                                                @else
                                                                    {{$row->cost}}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a href="{{route('search.show',$row->id)}}"
                                                                   class="btn btn-dark mr-2" style="width: 90px;">
                                                                    {{trans('s_admin.details')}}
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!--end::Content-->
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Top-->
                                        <!--begin::Separator-->
                                        <div class="separator separator-solid my-7"></div>
                                        <!--end::Separator-->
                                        <!--begin::Bottom-->
                                        <div class="d-flex align-items-center flex-wrap">
                                            <!--begin: Item-->
                                            @if($row->Teacher)
                                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
												<span class="mr-4">
													<i class="flaticon-avatar icon-2x text-muted font-weight-bold"></i>
												</span>
                                                    <div class="d-flex flex-column text-dark-75">
                                            <span
                                                class="font-weight-bolder font-size-sm">{{trans('admin.gender')}}</span>
                                                        <span class="text-dark-50 font-weight-bold">
                                            @if( $row->Teacher->gender == 'male' )
                                                                {{trans('admin.male')}}
                                                            @else
                                                                {{trans('admin.female')}}
                                                            @endif
                                        </span>
                                                    </div>
                                                </div>
                                            @endif
                                        <!--end: Item-->
                                            <hr>
                                            <!--begin: Item-->

                                            @if($row->Teacher)
                                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                    <span class="mr-4">
                                        <i class="flaticon-technology-2 icon-2x text-muted font-weight-bold"></i>
                                    </span>
                                                    <div class="d-flex flex-column flex-lg-fill">
                                            <span
                                                class="text-dark-75 font-weight-bolder font-size-sm">{{trans('s_admin.his_episodes_number')}}</span>
                                                        <span
                                                            class="text-dark-50 font-weight-bold">{{count($row->Teacher->Episodes)}} {{trans('s_admin.epo')}} </span>
                                                    </div>
                                                </div>
                                        @endif
                                        <!--end: Item-->
                                            <!--begin: Item-->
                                            <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                    <span class="mr-4">
                                        <i class="flaticon2-rhombus icon-2x text-muted font-weight-bold"></i>
                                    </span>
                                                <div class="d-flex flex-column">
                                                    @if($row->level_id)
                                                        <span
                                                            class="text-dark-75 font-weight-bolder font-size-sm">{{trans('s_admin.subject_type')}}</span>
                                                        <span class="text-dark-50 font-weight-bold">
                                                    @if(app()->getLocale() == 'ar')
                                                                {{$row->Level->name_ar}}
                                                            @else
                                                                {{$row->Level->name_ar}}
                                                            @endif
                                                </span>
                                                    @else
                                                        <span
                                                            class="text-dark-75 font-weight-bolder font-size-sm">{{trans('s_admin.hight_line')}}</span>
                                                        <span class="text-dark-50 font-weight-bold">N/A</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Bottom-->
                                    </div>
                                </div>
                            @endforeach
                            {{ $data->appends(request()->input())->links()}}
                        </div>
                    </div>
                </div><!-- Post Detail Wrap -->
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{ asset('metronic/assets/js/pages/crud/forms/widgets/nouislider.js') }}"></script>
    <script src="{{ asset('metronic/assets/js/pages/crud/datatables/basic/scrollable.js') }}"></script>
@endsection
