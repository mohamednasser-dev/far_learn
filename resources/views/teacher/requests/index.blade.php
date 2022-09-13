@extends('teacher.teacher_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.absense_permission')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    </div>
@endsection
@section('content')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-body">
            <div class="card-header">
                <a data-toggle="modal" data-target="#exampleModalLong"
                   class="btn btn-success px-6 font-weight-bold"><i
                        class="flaticon2-plus"></i> {{trans('s_admin.add_absence_request')}}</a>
                <div class="modal fade" id="exampleModalLong" data-backdrop="static" tabindex="-1" role="dialog"
                     aria-labelledby="staticBackdrop" aria-hidden="t*ue">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"
                                    id="exampleModalLabel">{{trans('s_admin.add_absence_request')}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i aria-hidden="true" class="ki ki-close"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="px-8 py-8" action="{{route('teacher_request.absence.store')}}"
                                      method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label
                                            for="exampleDropdownFormPassword1">{{trans('s_admin.date')}}</label>
                                        <input type="date" required class="form-control" name="request_date">
                                    </div>
                                    <div class="form-group">
                                        <label
                                            for="exampleDropdownFormPassword1">{{trans('s_admin.excuse')}}</label>
                                        <input type="text" required class="form-control" name="note">
                                    </div>
                                    <button type="submit" class="btn btn-primary">{{trans('s_admin.add')}}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--begin: Datatable-->
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-checkable" id="kt_datatable1">
                    <thead>
                    <tr>
                        <th title="Field #1">#</th>
                        <th title="Field #1">{{trans('s_admin.excuse')}}</th>
                        <th title="Field #2">{{trans('s_admin.request_status')}}</th>
                        <th title="Field #2">{{trans('s_admin.date')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $key => $row)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$row->note}}</td>
                            <td>
                                @if($row->status == 'default')
                                    <span style="font-weight: bold;"
                                          class="label label-outline-warning label-pill label-inline mr-2"> {{trans('s_admin.default_request')}}</span>
                                @elseif($row->status == 'accepted')
                                    <span style="font-weight: bold;"
                                          class="label label-outline-success label-pill label-inline mr-2"> {{trans('s_admin.accepted')}}</span>
                                @elseif($row->status == 'rejected')
                                    <span style="font-weight: bold;"
                                          class="label label-outline-danger label-pill label-inline mr-2"> {{trans('s_admin.rejected')}}</span>
                                @endif
                            </td>
                            <td> {{$row->request_date }}</td>
                        </tr>
                        @php $key += 1 ; @endphp
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{--    restart epo model--}}
    <div class="modal fade" id="restart_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.restart_epo')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">{{trans('s_admin.restart_epo_ask')}}</div>
                <div class="modal-footer">
                    <form action="{{route('t_episode.epo.restart')}}" method="post">
                        @csrf
                        <input type="hidden" name="section_id" id="txt_section_id">
                        <button type="button" class="btn btn-light-primary font-weight-bold"
                                data-dismiss="modal">{{trans('s_admin.cancel')}}</button>
                        <button type="submit"
                                class="btn btn-primary font-weight-bold">{{trans('s_admin.ok')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="restart_again_modal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalSizeSm"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.restart_epo')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">{{trans('s_admin.restart_epo_ask_again')}}</div>
                <div class="modal-footer">
                    <form action="{{route('t_episode.epo.restart_again')}}" method="post">
                        @csrf
                        <input type="hidden" name="section_id" id="txt_section_again_id">
                        <button type="button" class="btn btn-light-primary font-weight-bold"
                                data-dismiss="modal">{{trans('s_admin.cancel')}}</button>
                        <button type="submit"
                                class="btn btn-primary font-weight-bold">{{trans('s_admin.ok')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('metronic/assets/js/pages/crud/datatables/basic/scrollable.js') }}"></script>
    <script>
        $(document).ready(function () {
            var section;
            $(document).on('click', '#end_btn', function () {
                section = $(this).data('section');
                $("#txt_section_id").val(section);
            });
            $(document).on('click', '#end_again_btn', function () {
                section = $(this).data('section');
                $("#txt_section_again_id").val(section);
            });
        });
    </script>
@endsection
