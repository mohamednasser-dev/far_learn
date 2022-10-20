@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.Academic_semester')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('Academic_years.index')}}" class="text-muted">{{trans('s_admin.academic_years')}}</a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
            </div>
            <div class="card-toolbar">
{{--                @can('add')--}}
                <a data-toggle="modal" data-target="#exampleModalLong" class="btn {{auth()->user()->button_color}} px-6 font-weight-bold"><i class="flaticon2-plus"></i> {{trans('s_admin.add')}}</a>
{{--           @endcan--}}
            </div>
        </div>
        <div class="card-body">

            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                <thead>
                <tr>
                    <th title="Field #1">#</th>
                    <th title="Field #1">{{trans('s_admin.name')}}</th>
                    <th title="Field #1">{{trans('s_admin.from')}}</th>
                    <th title="Field #1">{{trans('s_admin.to')}}</th>
                    <th title="Field #7">{{trans('s_admin.chooses')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $key => $row)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$row->name}}</td>
                        <td>{{$row->from}}</td>
                        <td>{{$row->to}}</td>

                        <td class="text-right">
                            <a class="btn btn-icon btn-primary btn-circle btn-sm mr-2"
                               data-editid="{{$row->id}}" data-name="{{$row->name}}"  data-from="{{$row->from}}" data-to="{{$row->to}}"id="edit"
                               alt="default" data-toggle="modal" data-target="#edit_model">
                                <i class="icon-nm fas fa-pencil-alt" aria-hidden='true'></i>
                            </a>
                            <form method="get" id='delete-form-{{ $row->id }}' action="{{url('Academic_semester/'.$row->id.'/delete')}}" style='display: none;'>
                            {{csrf_field()}}
                            <!-- {{method_field('delete')}} -->
                            </form>
                            <button onclick="if(confirm('{{trans('admin.deleteConfirmation')}}'))
                                {
                                event.preventDefault();
                                document.getElementById('delete-form-{{ $row->id }}').submit();
                                }else {
                                event.preventDefault();
                                }"
                                    class='btn btn-icon btn-danger btn-circle btn-sm mr-2' href=" "><i
                                    class="icon-nm fas fa-trash" aria-hidden='true'>
                                </i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!--end: Datatable-->
        </div>
    </div>
    <!--end::Card-->-
    <!-- Modal-->
    <div class="modal fade" id="exampleModalLong" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="t*ue">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.add')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open( ['route' =>'Academic_semester.store','method'=>'post', 'files'=>'true'] ) }}
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.name')}}</label>
                            <div class="col-lg-8">
                                <input type="text" required class="form-control"  name="name">
                                <input type="hidden" required class="form-control"  value="{{$year_id}}" name="academic_year_id">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.from')}}</label>
                            <div class="col-lg-8">
                                <input type="date" required class="form-control"  name="from">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.to')}}</label>
                            <div class="col-lg-8">
                                <input type="date" required class="form-control"  name="to">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{trans('s_admin.cancel')}}
                        </button>
                        <button type="submit" class="btn btn-primary font-weight-bold">{{trans('s_admin.save')}}</button>
                    </div>
                    {{ Form::close() }}
                </div>

            </div>
        </div>
    </div>
    {{--    edit model--}}
    <div class="modal fade" id="edit_model" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="t*ue">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.edit')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open( ['route' =>'Academic_semester.update_new','method'=>'post', 'files'=>'true'] ) }}
                    {{ csrf_field() }}
                    <input type="hidden" required class="form-control" id="txt_id" name="id">
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.name')}}</label>
                            <div class="col-lg-8">
                                <input type="text" required class="form-control" id="name" name="name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.from')}}</label>
                            <div class="col-lg-8">
                                <input type="date" required class="form-control" id="from"  name="from">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.to')}}</label>
                            <div class="col-lg-8">
                                <input type="date" required class="form-control" id="to"  name="to">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary font-weight-bold">{{trans('s_admin.edit')}}</button>
                    </div>
                    {{ Form::close() }}
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var id;
        $(document).on('click', '#edit', function () {
            id = $(this).data('editid');
            name = $(this).data('name');
            to = $(this).data('to');
            from = $(this).data('from');
            $('#txt_id').val(id);
            $('#from').val(from);
            $('#to').val(to);
            $('#name').val(name);
        });
    </script>
@endsection
