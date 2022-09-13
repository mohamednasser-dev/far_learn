@extends('admin_temp')
@section('styles')

@endsection
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.nav_mail')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    </div>
@endsection
@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Inbox-->
            <div class="row">
                <!--begin::Aside-->
                <div class="flex-row-auto col-lg-4" id="kt_inbox_aside">
                    <!--begin::Card-->
                    <div class="card card-custom card-stretch">
                        <!--begin::Body-->
                        <div class="card-body px-5">
                            <!--begin::Compose-->
                            <div class="px-4 mt-4 mb-10">
                                <a href="javascript:void(0);"
                                   class="btn btn-block btn-primary font-weight-bold text-uppercase py-4 px-6 text-center"
                                   data-toggle="modal"
                                   data-target="#kt_inbox_compose">{{trans('s_admin.create_message')}}</a>
                            </div>
                            <!--end::Compose-->
                            <!--begin::Navigations-->
                            <div
                                class="navi navi-hover navi-active navi-link-rounded navi-bold navi-icon-center navi-light-icon">
                                <!--begin::Item-->
                                <div class="navi-item my-2">
                                    <a href="{{route('inbox.in')}}"
                                       class="navi-link @if(Route::current()->getName() == 'inbox.in' ) active @endif">
                                        <span class="navi-icon mr-4">
                                            <span class="svg-icon svg-icon-lg">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-heart.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                     height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <path
                                                            d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,13 C19,13.5522847 18.5522847,14 18,14 L6,14 C5.44771525,14 5,13.5522847 5,13 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M13.8,4 C13.1562,4 12.4033,4.72985286 12,5.2 C11.5967,4.72985286 10.8438,4 10.2,4 C9.0604,4 8.4,4.88887193 8.4,6.02016349 C8.4,7.27338783 9.6,8.6 12,10 C14.4,8.6 15.6,7.3 15.6,6.1 C15.6,4.96870845 14.9396,4 13.8,4 Z"
                                                            fill="#000000" opacity="0.3"></path>
                                                        <path
                                                            d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z"
                                                            fill="#000000"></path>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </span>
                                        <span
                                            class="navi-text font-weight-bolder font-size-lg">{{trans('s_admin.nav_com_mail')}}</span>

                                    </a>
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="navi-item my-2">
                                    <a href="{{route('inbox.out')}}"
                                       class="navi-link @if(Route::current()->getName() == 'inbox.out' ) active @endif">
															<span class="navi-icon mr-4">
																<span class="svg-icon svg-icon-lg">
																	<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Sending.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg"
                                                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                         width="24px" height="24px" viewBox="0 0 24 24"
                                                                         version="1.1">
																		<g stroke="none" stroke-width="1" fill="none"
                                                                           fill-rule="evenodd">
																			<rect x="0" y="0" width="24"
                                                                                  height="24"></rect>
																			<path
                                                                                d="M8,13.1668961 L20.4470385,11.9999863 L8,10.8330764 L8,5.77181995 C8,5.70108058 8.01501031,5.63114635 8.04403925,5.56663761 C8.15735832,5.31481744 8.45336217,5.20254012 8.70518234,5.31585919 L22.545552,11.5440255 C22.6569791,11.5941677 22.7461882,11.6833768 22.7963304,11.794804 C22.9096495,12.0466241 22.7973722,12.342628 22.545552,12.455947 L8.70518234,18.6841134 C8.64067359,18.7131423 8.57073936,18.7281526 8.5,18.7281526 C8.22385763,18.7281526 8,18.504295 8,18.2281526 L8,13.1668961 Z"
                                                                                fill="#000000"></path>
																			<path
                                                                                d="M4,16 L5,16 C5.55228475,16 6,16.4477153 6,17 C6,17.5522847 5.55228475,18 5,18 L4,18 C3.44771525,18 3,17.5522847 3,17 C3,16.4477153 3.44771525,16 4,16 Z M1,11 L5,11 C5.55228475,11 6,11.4477153 6,12 C6,12.5522847 5.55228475,13 5,13 L1,13 C0.44771525,13 6.76353751e-17,12.5522847 0,12 C-6.76353751e-17,11.4477153 0.44771525,11 1,11 Z M4,6 L5,6 C5.55228475,6 6,6.44771525 6,7 C6,7.55228475 5.55228475,8 5,8 L4,8 C3.44771525,8 3,7.55228475 3,7 C3,6.44771525 3.44771525,6 4,6 Z"
                                                                                fill="#000000" opacity="0.3"></path>
																		</g>
																	</svg>
                                                                    <!--end::Svg Icon-->
																</span>
															</span>
                                        <span
                                            class="navi-text font-weight-bolder font-size-lg">{{trans('s_admin.nav_out_mail')}}</span>
                                    </a>
                                </div>
                                <!--end::Item-->
                                <!--begin::Separator-->
                                <div class="navi-item my-10"></div>
                                <!--end::Separator-->
                            </div>
                            <!--end::Navigations-->
                        </div>

                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Aside-->
                @if(Route::current()->getName() == 'inbox.in')
                    @include('admin.Mails.inbox')
                @elseif(Route::current()->getName() == 'inbox.out')
                    @include('admin.Mails.outbox')
                @else
                    @include('admin.Mails.reply')
                @endif
            </div>
            <!--end::Inbox-->
        </div>
        <!--end::Container-->
    </div>

    <div class="modal modal-sticky modal-sticky-lg modal-sticky-bottom-right" id="kt_inbox_compose" role="dialog"
         data-backdrop="false" style="direction: ltr">
        <div class="modal-dialog" role="document">
            <div class="modal-content" @if(session('lang') == 'ar') style="direction: rtl" @endif>
                <!--begin::Form-->
                <form id="kt_inbox_compose_form" action="{{url('send_inbox')}}" method="post">
                @csrf
                <!--begin::Header-->
                    <div class="d-flex align-items-center justify-content-between py-5 pl-8 pr-5 border-bottom">
                        <h5 class="font-weight-bold m-0">{{trans('s_admin.create_message')}}</h5>
                        <div class="d-flex ml-2">

                            <span class="btn btn-clean btn-sm btn-icon" data-dismiss="modal">
															<i class="ki ki-close icon-1x"></i>
														</span>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="d-block">
                        <!--begin::To-->
                        <div class="d-flex align-items-center border-bottom inbox-to px-8 min-h-45px">
                            <div class="text-dark-50  w-75px">{{trans('s_admin.to')}}:</div>
                            {{--                            <div class="d-flex align-items-center flex-grow-1 w-75px">--}}
                            {{--                                <select class="form-control" id="kt_select2_1" name="receiver_id"--}}
                            {{--                                        required style="width: max-content">--}}
                            {{--                                    <option value="teachers">{{trans('s_admin.nav_teachers')}}</option>--}}
                            {{--                                    <option value="students">{{trans('s_admin.students')}}</option>--}}
                            {{--                                    <option value="moqmaa">{{trans('s_admin.mogmaas')}}</option>--}}
                            {{--                                    <option value="dorr">{{trans('s_admin.dorr')}}</option>--}}
                            {{--                                    <option value="far_learn">{{trans('s_admin.far_learn')}}</option>--}}
                            {{--                                </select>--}}
                            {{--                            </div>--}}
                            <div class="d-flex align-items-center flex-grow-1 w-75px">

                                <select class="form-control" id="kt_select2_1" name="receiver_id"
                                        required style="width: max-content">
                                    <option value="all_teacher"> <span style="color: green">ارسال لكل المعلمين</span>
                                    </option>
                                    <option value="all_student"> <span style="color: green">ارسال لكل الطلاب</span>
                                    </option>

                                    <optgroup label="{{trans('s_admin.teacher')}}">

                                        @foreach(\App\Models\Teacher::all() as $teacher)
                                            <option
                                                value="teacher,{{$teacher->id}}">{{$teacher->first_name_ar}} {{$teacher->mid_name_ar}}  {{$teacher->last_name_ar}}</option>
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="{{trans('s_admin.student')}}">

                                        @foreach(\App\Models\Student::all() as $student)
                                            <option
                                                value="student,{{$student->id}}}">{{$student->first_name_ar}} {{$student->mid_name_ar}} {{$student->last_name_ar}}</option>
                                        @endforeach
                                    </optgroup>

                                    <optgroup label="{{trans('s_admin.admins')}}">
                                        @foreach(\App\Models\User::where('id','!=',\Illuminate\Support\Facades\Auth::id())->get() as $user)
                                            <option
                                                value="admin,{{$user->id}}">{{$user->name}} </option>
                                        @endforeach
                                    </optgroup>
                                </select>


                            </div>
                        </div>
                        <div class="border-bottom">
                            <input class="form-control border-0 px-8 min-h-45px" name="subject"
                                   placeholder="{{trans('admin.subject')}}" required/>
                            <input type="hidden" name="message" id="messagess"
                                   required/>
                        </div>
                        <div id="kt_inbox_reply_editor" class="message-p border-0 cke_rtl" style="height: 250px">
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between py-5 pl-8 pr-5 border-top">
                        <!--begin::Actions-->
                        <div class="d-flex align-items-center mr-3">
                            <!--begin::Send-->
                            <div class="btn-group mr-4">
                                <button id="send" type="button"
                                        class="btn btn-primary font-weight-bold px-6">
                                    <i class="fa fa-check"></i>
                                    {{trans('admin.send')}}</button>
                            </div>
                            <!--end::Send-->
                        </div>
                        <!--end::Actions-->
                    </div>
                    <!--end::Footer-->
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('#send').click(function () {
                var message = $('#kt_inbox_reply_editor div:nth-child(1)').html();
                $('#messagess').val(message);
                $("#kt_inbox_compose_form").submit(); // Submit the form
            });
        });
    </script>
    <script src="{{ asset('metronic/assets/js/pages/custom/inbox/inbox.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#kt_inbox_reply_editor div:nth-child(1)').css("direction", "rtl");
        });
    </script>
    @if(session('lang')=='ar')
        <script>
            $(document).ready(function () {
                $('#kt_inbox_reply_editor div:nth-child(1)').css("text-align", "right");
            });
        </script>
    @endif
    <script src="{{ asset('metronic/assets/js/pages/crud/forms/widgets/select2.js')}}"></script>
    <script src="{{ asset('metronic/assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js')}}"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    {{--    <script src="{{ asset('metronic/assets/js/pages/crud/forms/editors/ckeditor-classic.js')}}"></script>--}}
    <script>

        var KTCkeditor = function () {
            // Private functions
            var demos = function () {
                ClassicEditor
                    .create(document.querySelector('#kt-ckeditor-1'), {
                        @if(session('lang')=='ar')
                        language: 'ar'
                        @endif
                    })
                    .then(editor => {
                        console.log(editor);
                    })
                    .catch(error => {
                        console.error(error);
                    });

            }

            return {
                // public functions
                init: function () {
                    demos();
                }
            };
        }();

        // Initialization
        jQuery(document).ready(function () {
            KTCkeditor.init();
        });
    </script>


@endsection
