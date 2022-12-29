<div class="flex-row-fluid col-lg-8" id="kt_inbox_view">
    <!--begin::Card-->
    <div class="card card-custom card-stretch">
        <div class="card-body p-0">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Inbox-->
                <div class="d-flex flex-row">
                    <div class="flex-row-fluid ml-lg-8 d-block" id="kt_inbox_view">
                        <div class="px-4 mt-4 mb-10">
                            <button type="button" data-toggle="modal" data-toggle="modal"
                                    data-target="#kt_modal_4"
                                    class="btn btn-primary font-weight-bolder">
            <span class="svg-icon svg-icon-md">
              <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                   height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <rect x="0" y="0" width="24" height="24"/>
                  <circle fill="#000000" cx="9" cy="15" r="6"/>
                  <path
                      d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                      fill="#000000" opacity="0.3"/>
                </g>
              </svg>
                <!--end::Svg Icon-->
            </span> ارسال رد
                            </button>

                        </div>

                        <!--begin::Messages-->
                        <div class="mb-3">
                            <div class="cursor-pointer shadow-xs toggle-on" data-inbox="message">
                                <!--begin::Message Heading-->
                                <div
                                    class="d-flex card-spacer-x py-6 flex-column flex-md-row flex-lg-column flex-xxl-row justify-content-between">
                                    <div class="d-flex align-items-center">
																<span class="symbol symbol-50 mr-4">
																	<span class="symbol-label"
                                                                          style="background-image: url('{{$data->getSender->image}}')"></span>
																</span>
                                        <div class="d-flex flex-column flex-grow-1 flex-wrap mr-2">
                                            <div class="d-flex">
                                                <a href="#"
                                                   class="font-size-lg font-weight-bolder text-dark-75 text-hover-primary mr-2">{{$data->getSender->name}}</a>
                                                <div class="font-weight-bold text-muted">
                                                            <span
                                                                class="label label-success label-dot mr-2"></span> {{Carbon\Carbon::parse($data->created_at)->diffForHumans()}}
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <div class="toggle-off-item">
																			<span
                                                                                class="font-weight-bold text-muted cursor-pointer"
                                                                                data-toggle="dropdown">to
                                                                                @if($data->type=="single")
                                                                                    {{$data->getReciever?$data->getReciever->name :"تم حذف المستخدم"}}
                                                                                @elseif($data->type=="all_teachers")
                                                                                    {{trans('s_admin.all_teachers')}}
                                                                                @else
                                                                                    {{trans('s_admin.all_students')}}
                                                                                @endif
																			<i class="flaticon2-down icon-xs ml-1 text-dark-50"></i></span>
                                                    <div
                                                        class="dropdown-menu dropdown-menu-lg dropdown-menu-left p-5">
                                                        <table>
                                                            <tr>
                                                                <td class="text-muted min-w-75px py-2">From</td>
                                                                <td>{{$data->getSender->name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted py-2">Date:</td>
                                                                <td>{{\Carbon\Carbon::parse($data->created_at)->translatedFormat('M d Y h:i')}}</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="text-muted font-weight-bold toggle-on-item"
                                                     data-inbox="toggle">
                                                    {{--                                                            {!! substr($Users->message , 0 , 50) !!}....--}}
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="d-flex my-2 my-xxl-0 align-items-md-center align-items-lg-start align-items-xxl-center flex-column flex-md-row flex-lg-column flex-xxl-row">
                                        <div
                                            class="font-weight-bold text-muted mx-2">{{\Carbon\Carbon::parse($data->created_at)->translatedFormat('M d Y h:i')}}</div>
                                    </div>
                                </div>
                                <!--end::Message Heading-->
                                <div class="card-spacer-x py-3 toggle-off-item">
                                    {!! $data->message  !!}

                                </div>


                            </div>
                            <div style="padding-right: 50px">
                                @foreach($data->childreninboxes as $user)
                                    <div class="cursor-pointer shadow-xs toggle-off" data-inbox="message">
                                        <!--begin::Message Heading-->
                                        <div
                                            class="d-flex card-spacer-x py-6 flex-column flex-md-row flex-lg-column flex-xxl-row justify-content-between">
                                            <div class="d-flex align-items-center">
																<span class="symbol symbol-50 mr-4">
																	<span class="symbol-label"
                                                                          style="background-image: url('{{$user->getSender->image}}')"></span>
																</span>
                                                <div class="d-flex flex-column flex-grow-1 flex-wrap mr-2">
                                                    <div class="d-flex">
                                                        <a href="#"
                                                           class="font-size-lg font-weight-bolder text-dark-75 text-hover-primary mr-2">{{$user->getSender->name}}</a>
                                                        <div class="font-weight-bold text-muted">
                                                            <span
                                                                class="label label-success label-dot mr-2"></span> {{Carbon\Carbon::parse($user->created_at)->diffForHumans()}}
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <div class="toggle-off-item">
																			<span
                                                                                class="font-weight-bold text-muted cursor-pointer"
                                                                                data-toggle="dropdown">to
                                                                                 @if($user->type=="single")
                                                                                    {{$user->getReciever?$user->getReciever->name :"تم حذف المستخدم"}}
                                                                                @elseif($user->type=="all_teachers")
                                                                                    {{trans('s_admin.all_teachers')}}
                                                                                @else
                                                                                    {{trans('s_admin.all_students')}}
                                                                                @endif

																			<i class="flaticon2-down icon-xs ml-1 text-dark-50"></i></span>
                                                            <div
                                                                class="dropdown-menu dropdown-menu-lg dropdown-menu-left p-5">
                                                                <table>
                                                                    <tr>
                                                                        <td class="text-muted min-w-75px py-2">
                                                                            From
                                                                        </td>
                                                                        <td>{{$user->getSender->name}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted py-2">Date:</td>
                                                                        <td>{{\Carbon\Carbon::parse($user->created_at)->translatedFormat('M d Y h:i')}}</td>
                                                                    </tr>


                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="text-muted font-weight-bold toggle-on-item"
                                                             data-inbox="toggle">
                                                            {{--                                                                    {{ substr( html_entity_decode($user->message) , 0 , 50) }}....--}}

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex my-2 my-xxl-0 align-items-md-center align-items-lg-start align-items-xxl-center flex-column flex-md-row flex-lg-column flex-xxl-row">
                                                <div
                                                    class="font-weight-bold text-muted mx-2">{{\Carbon\Carbon::parse($user->created_at)->translatedFormat('M d Y h:i')}}</div>
                                            </div>
                                        </div>
                                        <!--end::Message Heading-->

                                        <div class="card-spacer-x py-3 toggle-on-item">
                                            {!! html_entity_decode($user->message)  !!}
                                        </div>


                                    </div>
                                @endforeach
                            </div>

                        </div>
                        <!--end::Messages-->
                    </div>
                </div>
                <!--end::Inbox-->
            </div>
            <!--end::Container-->
        </div>
        <br>
    </div>
</div>
<div class="modal fade" id="kt_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    ارسال رد</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form class="px-10" novalidate="novalidate" id="kt_form" method="post"
                      action="{{route('teacher.send.reply')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>{{__('admin.subject')}} </label>
                        <input class="form-control border-0 px-8 min-h-45px" name="subject" value="{{$data->subject}}" readonly
                               placeholder="{{trans('admin.subject')}}" required/>
                        <label>{{__('admin.message')}} </label>
                        <textarea name="message" id="kt-ckeditor-1" required >
                        </textarea>


                        <input type="hidden" class="form-control form-control-solid" name="inbox_id" required
                               value="{{$data->id}}">

                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{__('admin.close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('admin.send')}}</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
