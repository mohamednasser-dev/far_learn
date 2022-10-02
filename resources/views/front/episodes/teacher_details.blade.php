@extends('front.layouts.app')

@section('content')
    <!-- .wpo-breadcumb-area start -->
    <div class="wpo-breadcumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wpo-breadcumb-wrap">
                        <h2>{{trans('s_admin.teacher_info')}}</h2>
                        <ul>
                            <li><a href="{{route('main_page')}}">{{trans('admin.home')}}</a></li>
                            <li><span>{{trans('s_admin.teacher_info')}}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .wpo-breadcumb-area end -->

    <!-- start wpo-contact-form-map -->
    <div class="wpo-about-area-3 section-padding">
        <div class="container">
            <div class="team-detail-wrap w-100">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-4">
                        <div class="team-detail-img w-100">
                            @if($data->image == null)
                                <img class="img-fluid w-100" src="{{ asset('uploads/teachers/default_avatar.jpg') }}" alt="Team Detail Image">
                            @else
                                <img class="img-fluid w-100" src="{{url($data->image)}}" alt="Team Detail Image">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-8">
                        <div class="team-detail-inner w-100">
                            <div class="team-detail-info d-flex flex-wrap justify-content-between w-100 position-relative pat-bg gray-layer2 opc85 back-blend-multiply gray-bg4" >
                                <div class="team-detail-info-inner">
                                    <h2 class="mb-0">{{$data->name}}</h2>

                                </div>
                                <div class="team-detail-info-inner">
                                    <ul class="team-detail-info-list mb-0 list-unstyled">
                                        <li><span style="color: darkcyan;">{{trans('s_admin.phone')}}  </span><h4 class="mb-0">{{$data->phone}}</h4></li>
                                        <li><span style="color: darkcyan;">{{trans('s_admin.email')}}  </span><a href="javascript:void(0);" title=""><h4 class="mb-0"> {{$data->email}}</h4></a></li>
                                        <li><span style="color: darkcyan;"> @if($data->gender == 'male'){{trans('s_admin.his_episodes_number')}} @else {{trans('s_admin.his_episodes_number')}} @endif  </span><h4 class="mb-0">{{count($data->Episodes) + count($data->Episode)}}</h4></li>
                                        <li><span style="color: darkcyan;">{{trans('s_admin.rating')}}  </span><a href="javascript:void(0);" title="">
                                                <h4 class="mb-0"> {{$data->rate}} <span style="color: orange;" class="fa fa-star checked"></span></h4></a>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="team-detail-experties w-100">
                                <div class="row">
                                    <div class="col-md-5 col-sm-6 col-lg-5">
                                        <h3 class="mb-0">{{trans('s_admin.details')}}</h3>
                                    </div>
                                    <div class="col-md-7 col-sm-6 col-lg-7">
                                        <ul class="experties-list mb-0 list-unstyled">
                                            @if($data->job_name != null)  <li><a href="javascript:void(0);" title="">{{$data->Job->name}}</a></li> @endif
                                            @if($data->country != null)  <li><a href="javascript:void(0);" title="">{{$data->Country->name}}</a></li> @endif
                                            @if($data->nationality != null)  <li><a href="javascript:void(0);" title="">{{$data->Nationality->name}}</a></li> @endif
                                            @if($data->qualification != null)  <li><a href="javascript:void(0);" title="">{{$data->Qualification->name}}</a></li> @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="team-detail-desc w-100">
                                <h2 class="mb-0"> {{trans('s_admin.about_teacher')}} </h2>
                                <p class="mb-0"> @if(app()->getLocale() == 'ar') {{$data->bio_ar}} @else {{$data->bio_en}} @endif </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Team Detail Wrap -->
        </div>
    </div>
@endsection
