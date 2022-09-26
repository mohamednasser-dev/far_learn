@extends('front.layouts.app')

@section('content')
    <!-- .wpo-breadcumb-area start -->
    <div class="wpo-breadcumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wpo-breadcumb-wrap">
                        <h2>{{trans('admin.terms')}}</h2>
                        <ul>
                            <li><a href="{{route('main_page')}}">{{trans('admin.home')}}</a></li>
                            <li><span>{{trans('admin.terms')}}</span></li>
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
            <div class="wpo-about-wrap">
                <div class="row">
                    <div class="col-lg-12 col-md-12 colsm-12">
                        <div class="wpo-about-text">
                            <div class="wpo-section-title">
                                <h2>{{trans('admin.terms')}}</h2>
                            </div>
                            <p> {!! $settings_share->terms  !!} </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
