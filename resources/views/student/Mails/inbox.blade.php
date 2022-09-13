<div class="flex-row-fluid col-lg-8" id="kt_inbox_view">
    <!--begin::Card-->
    <div class="card card-custom card-stretch">

        <div class="card-body p-0">

            <!--begin::Messages-->
            <div class="mb-3">
                {{--                start::foreach--}}
                @foreach($data as $row)
                    @if($row->getSender)
                    <div class="cursor-pointer shadow-xs toggle-off" data-inbox="message">
                        <!--begin::Message Heading-->
                        <div
                            class="d-flex card-spacer-x py-6 flex-column flex-md-row flex-lg-column flex-xxl-row justify-content-between">
                            <div class="d-flex align-items-center">
																<span class="symbol symbol-50 mr-4"
                                                                      data-toggle="expand">
																	<span class="symbol-label"
                                                                          style="background-image: url('{{$row->getSender->image}}')"></span>
																</span>
                                <div class="d-flex flex-column flex-grow-1 flex-wrap mr-2">
                                    <div class="d-flex" data-toggle="expand">
                                        <a href="#"
                                           class="font-size-lg font-weight-bolder text-dark-75 text-hover-primary mr-2">
                                            {{$row->getSender->name}}

                                        </a>
                                        <div class="font-weight-bold text-muted">
                                            <span class="label label-success label-dot mr-2"></span>
                                            {{Carbon\Carbon::parse($row->created_at)->diffForHumans()}}

                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <div class="toggle-off-item">
																			<span
                                                                                class="font-weight-bold text-muted cursor-pointer"
                                                                                data-toggle="dropdown">to     @if($row->type=="single")
                                                                                    {{$row->getReciever ?$row->getReciever->name : "تم حذف المستخدم"}}
                                                                                @elseif($row->type=="all_teachers")
                                                                                    {{trans('s_admin.all_teachers')}}
                                                                                @else
                                                                                    {{trans('s_admin.all_students')}}
                                                                                @endif
																			<i class="flaticon2-down icon-xs ml-1 text-dark-50"></i></span>
                                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-left p-5">
                                                <table>
                                                    <tr>
                                                        <td class="text-muted w-75px py-2">From</td>
                                                        <td>{{$row->getSender->name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted py-2">Date:</td>
                                                        <td>{{\Carbon\Carbon::parse($row->created_at)->translatedFormat('M d Y h:i')}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted py-2">Subject:</td>
                                                        <td>{{$row->subject}}</td>
                                                    </tr>

                                                </table>
                                            </div>
                                        </div>
                                        <div class="text-muted font-weight-bold toggle-on-item" data-toggle="expand">
                                            {{--                                        subject       --}}
                                            {{$row->subject}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="d-flex my-2 my-xxl-0 align-items-md-center align-items-lg-start align-items-xxl-center flex-column flex-md-row flex-lg-column flex-xxl-row">
                                <div class="font-weight-bold text-muted mx-2" data-toggle="expand">{{\Carbon\Carbon::parse($row->created_at)->translatedFormat('d M Y h:i')}}
                                </div>

                            </div>
                        </div>
                        <!--end::Message Heading-->
                        <div class="card-spacer-x py-3 toggle-off-item">
                            {!! $row->message !!}
                        </div>
                        <div class="card-spacer-x py-3 toggle-off-item">
                            <a href="{{route("student.inbox.reply",[$row->id])}}" class="btn btn-outline-success">التفاصيل</a>
                        </div>
                    </div>
                    @endif
                @endforeach
                {{--                end::foreach--}}
            </div>
            <!--end::Messages-->
            <!--begin::Reply-->

            <!--end::Reply-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Card-->
</div>
