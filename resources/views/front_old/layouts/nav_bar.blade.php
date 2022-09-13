<li class="menu-item active">
    <a href="{{url('/')}}" title="">
        <i class="fa fa-home"></i>
    </a>
</li>
{{--        <li class="menu-item-has-children"><a href="javascript:void(0);" title="" style="color: #222;">--}}
{{--                <i class="fa fa-align-justify"></i></a>--}}
{{--            <ul class="mb-0 list-unstyled" style="width: 1100px; @if(session('lang') == 'ar') margin-right: -450px; @else margin-left: -400px;@endif">--}}
{{--                <div class="row" style="width: 1500px;">--}}
{{--                    <div class="col-md-03">--}}
{{--                        <li class="menu-item">--}}
{{--                            <a href="javascript:void(0);" title="">--}}
{{--                                <img style="width: 100px;" src="{{url('/')}}/quran/assets/images/sidbar/icon-01.png" alt="Software"><p>{{trans('admin.nav_one')}}</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-03">--}}
{{--                        <li class="menu-item">--}}
{{--                            <a href="javascript:void(0);" title="">--}}
{{--                                <img style="width: 100px;" src="{{url('/')}}/quran/assets/images/sidbar/icon-02.png" alt="Software"><p>{{trans('admin.nav_five')}}</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-03">--}}
{{--                        <li class="menu-item">--}}
{{--                            <a href="javascript:void(0);" title="">--}}
{{--                                <img style="width: 100px;" src="{{url('/')}}/quran/assets/images/sidbar/icon-03.png" alt="Software"><p>{{trans('admin.nav_four')}}</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-03">--}}
{{--                        <li class="menu-item">--}}
{{--                            <a href="javascript:void(0);" title="">--}}
{{--                                <img style="width: 100px;" src="{{url('/')}}/quran/assets/images/sidbar/icon-04.png" alt="Software"><p>{{trans('admin.nav_three')}}</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-03">--}}
{{--                        <li class="menu-item">--}}
{{--                            <a href="javascript:void(0);" title="">--}}
{{--                                <img style="width: 100px;" src="{{url('/')}}/quran/assets/images/sidbar/icon-05.png" alt="Software"><p>{{trans('admin.nav_two')}}</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-03">--}}
{{--                        <li class="menu-item">--}}
{{--                            <a href="javascript:void(0);" title="">--}}
{{--                                <img style="width: 100px;" src="{{url('/')}}/quran/assets/images/sidbar/icon-06.png" alt="Software"><p>{{trans('admin.nav_six')}}</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </ul>--}}
{{--        </li>--}}
@if($settings_share->show_search_teacher == '1')
    <li class="menu-item">
        <a href="{{route('times.show','all')}}" title="" style="width: 200px; color: #222;">
            <i class="fa fa-search"></i>
            {{trans('admin.search_teacher')}}
        </a>
    </li>
@endif
