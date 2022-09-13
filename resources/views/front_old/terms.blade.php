@extends('front.layouts.temp')
@section('content')
    <section>
        <div class="w-100">
            @include('admin.layouts.errors')
            @include('admin.layouts.messages')
        </div>
    </section>
    {{--    <div class="w-100 pt-80 black-layer pb-70 opc65 position-relative">--}}
    {{--        <div class="fixed-bg" style="background-image: url(public/metronic/assets/images/page-title-bg.jpg);"></div>--}}
    {{--        <div class="container">--}}
    {{--            <div class="page-title-wrap text-center w-100">--}}
    {{--                <div class="page-title-inner d-inline-block">--}}
    {{--                    <h1 class="mb-0">{{trans('admin.terms')}}</h1>--}}
    {{--                    <ol class="breadcrumb mb-0">--}}
    {{--                        <li class="breadcrumb-item"><a href="{{route('main_page')}}" title="Home"> {{trans('admin.home')}} </a></li>--}}
    {{--                        <li class="breadcrumb-item active">{{trans('admin.terms')}}</li>--}}
    {{--                    </ol>--}}
    {{--                </div>--}}
    {{--            </div><!-- Page Title Wrap -->--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <div class="w-100 pt-120 pb-100 position-relative">
        <div class="container">
            <div class="about-wrap4 w-100">
                <div class="row align-items-center">
                    <div class="col-md-12 col-sm-12 col-lg-12">
                        <div class="about-inner4 w-100">
                            <h2 class="mb-0">{{trans('admin.terms')}}</h2>
                            <p class="mb-0">
                                @if(app()->getLocale() == 'ar')
                                    {!! $settings_share->terms_ar  !!}
                                @else
                                    {!! $settings_share->terms_en  !!}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div><!-- About Wrap 4 -->
        </div>
    </div>
@endsection
@section('scripts')

@endsection
