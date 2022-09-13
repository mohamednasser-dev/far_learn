@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.nav_episodes_rates')}}</h5>
    </div>
@endsection
@section('content')
    @if(auth()->user()->role_id == 8 || auth()->user()->role_id == 2 )
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card card-custom wave wave-success">
                <div class="card-body">
                    <div class="d-flex align-items-center p-5">
                        <div class="mr-6">
                        <span class="svg-icon svg-icon-success svg-icon-4x">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <polygon fill="#000000" opacity="0.3" points="5 3 19 3 23 8 1 8"></polygon>
                                    <polygon fill="#000000" points="23 8 12 20 1 8"></polygon>
                                </g>
                            </svg>
                        </span>
                        </div>
                        <div class="d-flex flex-column">
                            <a href="{{route('reports.rates','mqraa')}}" class="text-dark text-hover-primary font-weight-bold font-size-h3 mb-3">
                                {{trans('s_admin.episode_mqraa')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <br>
    @endif
    @if(settings()->show_mogmaa_dorr == '1')
        @if(auth()->user()->role_id == 3 || auth()->user()->role_id == 6 || auth()->user()->role_id == 2 )
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card card-custom wave wave-primary mb-8 mb-lg-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center p-5">
                            <div class="mr-6">
                                <span class="svg-icon svg-icon-primary svg-icon-4x">
                                                                <!--begin::Svg Icon | path:assets/media/svg/icons/General/Half-star.svg-->
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                                        <path d="M12,4.25932872 C12.1488635,4.25921584 12.3000368,4.29247316 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 L12,4.25932872 Z" fill="#000000" opacity="0.3"></path>
                                                                        <path d="M12,4.25932872 L12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.277344,4.464261 11.6315987,4.25960807 12,4.25932872 Z" fill="#000000"></path>
                                                                    </g>
                                                                </svg>
                                    <!--end::Svg Icon-->
                                                            </span>
                            </div>
                            <div class="d-flex flex-column">
                                <a href="{{route('reports.rates','mogmaa')}}" class="text-dark text-hover-primary font-weight-bold font-size-h3 mb-3">
                                    {{trans('s_admin.colleges')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
        <br>
        @endif
        @if(auth()->user()->role_id == 5 || auth()->user()->role_id == 7 || auth()->user()->role_id == 2 )
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card card-custom wave wave-danger mb-8 mb-lg-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center p-5">
                            <div class="mr-6">
                                <span class="svg-icon svg-icon-danger svg-icon-4x">
                                                                <!--begin::Svg Icon | path:assets/media/svg/icons/General/Half-star.svg-->
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                                        <path d="M12,4.25932872 C12.1488635,4.25921584 12.3000368,4.29247316 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 L12,4.25932872 Z" fill="#000000" opacity="0.3"></path>
                                                                        <path d="M12,4.25932872 L12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.277344,4.464261 11.6315987,4.25960807 12,4.25932872 Z" fill="#000000"></path>
                                                                    </g>
                                                                </svg>
                                    <!--end::Svg Icon-->
                                                            </span>
                            </div>
                            <div class="d-flex flex-column">
                                <a href="{{route('reports.rates', 'dorr' )}}" class="text-dark text-hover-primary font-weight-bold font-size-h3 mb-3">
                                    {{trans('s_admin.dorrs')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
        @endif
    @endif
@endsection
@section('scripts')
@endsection
